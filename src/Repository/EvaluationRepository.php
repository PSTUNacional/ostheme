<?php

namespace OS\Repository;

include dirname(__DIR__, 2).'/autoloader.php';

use OS\Repository\Repository;

class EvaluationRepository extends Repository
{
    public function insertEvaluation(
        int $id,
        int $rank,
        string $comment,
        string $title
    ) {
        $sql = "INSERT INTO `os_content_evaluation`
                (`content_id`, `rate`, `comment`, `title`)
                VALUES (:id, :rank, :comment, :title)";

        $prepare = $this->conn->prepare($sql);
        $prepare->execute([
            'id'        => $id,
            'rank'      => $rank,
            'comment'   => $comment,
            'title'     => $title
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

    public function getAllEvaluations()
    {
        $sql = "SELECT `content_id`, `title`, ROUND(AVG(`rate`),1) as rate, COUNT(`rate`) as 'evaluations', COUNT(NULLIF(`comment`,'')) as comments FROM `os_content_evaluation` GROUP BY `content_id` ORDER BY `content_id` DESC";
    }
}