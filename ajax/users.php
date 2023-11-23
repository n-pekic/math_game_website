<?php
header('Content-Type: application/json; charset=utf-8');

require_once '../functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirection('index.php');
    exit();
}

$user_data = getUsers();
echo json_encode($user_data);