<?php

include dirname(__DIR__, 2).'/autoloader.php';

use OS\Repository\EvaluationRepository;

$method = $_GET['method'];
$evaluation = new EvaluationRepository;

if($method == 'insert')
{
    $id = $_POST['id'];
    $rank = $_POST['rank'];
    $comment = $_POST['comment'];
    $title = $_POST['title'];

    $evaluation->insertEvaluation($id, $rank, $comment);
}

if($method == 'getRateById')
{
    $id = $_GET['id'];
    return $evaluation->getRateById($id);
}

if($method == 'getAllEvaluations')
{
    return $evaluation->getAllEvaluations();
}

if($method == 'getAllComments')
{
    $id = $_GET['id'];
    return $evaluation->getAllComments($id);
}