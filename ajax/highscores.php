<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirection('index.php');
    exit();
}

if(!empty($_POST['user']) && in_array($_POST['user'], $users)) {
    $user = $_POST['user'];
    $highscore_data = getHighscores($user);
    echo json_encode($highscore_data);
}


