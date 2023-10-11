<?php

namespace OS\Repository;

include get_template_directory() . '/autoloader.php';

use OS\Repository\Repository;

class EvaluationRepository extends Repository
{
    public function insertEvaluation(
        int $id,
        int $rank,
        string $comment
    ) {
        var_dump($this->conn);
        $sql = "INSERT INTO `os_content_evaluation`
                (`content_id`, `rate`, `comment`)
                VALUES (:id, :rank, :comment)";

        $prepare = $this->conn->prepare($sql);
        $prepare->execute([˜
            'id'        => $id,
            'rank'      => $rank,
            'comment'   => $comment
        ]);
        return $prepare->fetchAll(\PDO::FETCH_ASSOC) ?: [];
    }

    public function getRateById(int $id)
    {
        $sql = "SELECT AVG(rate) AS rate, COUNT(*) as total FROM os_content_evaluation WHERE content_id = :id";
        $prepare = $this->conn->prepare($sql);
        $prepare->execute([
            'id' => $id
        ]);
        return $prepare->fetch(\PDO::FETCH_ASSOC) ?: [];

    }
}
˜