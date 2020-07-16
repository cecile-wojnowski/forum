<?php

class vote
{

    private $pdo;
    private $former_vote;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    private function prepareAndFetch($query, $params)
    {
        $req = $this->pdo->prepare($query);
        $req->execute($params);
        return $req->fetch();
    }


    private function recordExists($table, $record_id)
    {
        $req = $this->pdo->prepare("SELECT * FROM $table WHERE id = ?");
        $req->execute([$record_id]);
        if ($req->rowCount() == 0) {
            throw new Exception('Impossible de voter pour un enregistrement qui n\'existe pas');
        }
    }

    /**
     * Permet de "liker" un contenu
     * @param $table
     * @param $record_id
     * @param $user_id
     * @return bool
     */
    public function like($table, $record_id, $user_id)
    {
        if ($this->vote($table, $record_id, $user_id, 1)) {
            $sql_part = "";
            if ($this->former_vote) {
                $sql_part = ", dislike_count = dislike_count - 1";
            }
            $this->pdo->query("UPDATE $table SET like_count = like_count + 1 $sql_part WHERE id = $record_id");
            return true;
        } else {
            $this->pdo->query("UPDATE $table SET like_count = like_count - 1 WHERE id = $record_id");
        }
        return false;
    }

    /**
     * Permet de "disliker" un contenu
     * @param $table
     * @param $record_id
     * @param $user_id
     * @return bool
     */
    public function dislike($table, $record_id, $user_id)
    {
        if ($this->vote($table, $record_id, $user_id, -1)) {
            $sql_part = "";
            if ($this->former_vote) {
                $sql_part = ", like_count = like_count - 1";
            }
            $this->pdo->query("UPDATE $table SET dislike_count = dislike_count + 1 $sql_part WHERE id = $record_id");
            return true;
        } else {
            $this->pdo->query("UPDATE $table SET dislike_count = dislike_count - 1 WHERE id = $record_id");
        }
        return false;
    }

    public function note($table, $record_id, $user_id, $note){
        $vote = $this->vote($table, $record_id, $user_id, $note);
        $this->updateVote($table, $record_id, true);
        return $vote;
    }

    /**
     * Vote pour un article
     * @param $table
     * @param $record_id
     * @param $user_id
     * @param $score
     * @return bool
     * @throws mixed
     */
    private function vote($table, $record_id, $user_id, $score)
    {
        $this->recordExists($table, $record_id);
        $this->former_vote = $this->prepareAndFetch("SELECT id, vote FROM votes WHERE ref=? AND ref_id=? AND user_id=?", [$table, $record_id, $user_id]);
        if ($this->former_vote) {
            // Si on vote avec la même note, alors on supprime le vote (unlike, undislike)
            if ($this->former_vote->vote == $score) {
                $this->pdo->query('DELETE FROM votes WHERE id = ' . $this->former_vote->id);
                return false;
            }
            $this->pdo->prepare("UPDATE votes SET vote = ?, created_at = ? WHERE id = {$this->former_vote->id}")->execute([$score, date('Y-m-d H:i:s')]);
            return true;
        }
        return $this->pdo->prepare("INSERT INTO votes SET ref=?, ref_id=?, user_id=?, created_at=?, vote = $score")->execute([$table, $record_id, $user_id, date('Y-m-d H:i:s')]);
    }

    /**
     * Permet de mettre à jour le nombre de like/dislike pour un contenu donné
     * @param $ref string nom de la table
     * @param $ref_id integer ID de l'enregistrement
     * @return PDOStatement
     */
    public function updateLikesCount($ref, $ref_id)
    {
        $votes = $this->prepareAndFetch("SELECT COUNT(id) as count, vote FROM votes WHERE ref = ? AND ref_id = ? GROUP BY vote ", [$ref, $ref_id]);
        $counts = [
            '-1' => 0,
            '1' => 0
        ];
        foreach ($votes as $vote) {
            $counts[$vote->vote] = $vote->count;
        }
        return $this->pdo->query("UPDATE $ref SET like_count = {$counts[1]}, dislike_count = {$counts[-1]} WHERE id = $ref_id");
    }

    /**
     * Met à jour 'score' comme moyenne des vote associé
     * @param $ref string nom de la table
     * @param $ref_id integer ID de l'enregistrement
     * @param $count boolean sauvegarde aussi le nombre de votes
     * @return Mixed
     */
    public function updateVote($ref, $ref_id, $count = false)
    {
        $vote = $this->prepareAndFetch("SELECT AVG(vote) as note, COUNT(id) as count, ref, ref_id FROM votes WHERE ref = ? AND ref_id = ?", [$ref, $ref_id]);
        if ($vote) {
            $fields = "score=" . (round($vote->note * 10) / 10);
            if ($count) {
                $fields .= " , vote_count=" . $vote->count;
            }
            return $this->pdo->exec("UPDATE {$vote->ref} SET $fields WHERE id={$vote->ref_id}");
        }
        return false;
    }

    /**
     * Permet d'ajouter une class is-liked ou is-disliked suivante un enregistrement
     * @param $vote mixed false/PDORow
     * @return null|string
     */
    public static function getClass($vote)
    {
        if ($vote) {
            return $vote->vote == 1 ? 'is-liked' : 'is-disliked';
        }
        return null;
    }

}
