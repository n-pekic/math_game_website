<?php
header('Content-Type: application/json; charset=utf-8');

require_once '../functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirection('index.php');
    exit();
}

if(isset($_POST['id_user'])){
    $id = $_POST['id_user'];
    $highscore_data = getHighscores($id);
    echo json_encode($highscore_data);
} elseif (isset($_POST['type'])) {
    $type = $_POST['type'];
    $highscore_data = getHighscores($type);
    echo json_encode($highscore_data);
} else {
    $highscore_data = getHighscores();
    echo json_encode($highscore_data);
}
