<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirection('index.php');
    exit();
}

if(isset($_POST['user']) && $_POST['user'] === 'guest') {
    $highscore_data = getHighscores('guest');
    echo json_encode($highscore_data);
} else {
    $highscore_data = getHighscores();
    echo json_encode($highscore_data);
}

