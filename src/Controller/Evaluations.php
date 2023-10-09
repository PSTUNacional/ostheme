<?php

include get_template_directory() . '/autoloader.php';

use OS\Repository\EvaluationRepository;

$method = $_GET['method'];
$evaluation = new EvaluationRepository;

if($method == 'insert')
{
    $id = $_POST['id'];
    $rank = $_POST['rank'];
    $comment = $_POST['comment'];

    $evaluation->insertEvaluation($id, $rank, $comment);
}

if($method == 'getRateById')
{
    $id = $_GET['id'];
    return $evaluation->getRateById($id);

}