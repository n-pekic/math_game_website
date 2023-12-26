<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../functions.php';

$filter = $_GET['filter'] ?? null;
$id = $_GET['id'] ?? null;

$data = userGameStats($id, $filter);
echo json_encode($data);