<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../functions.php';

$sort_by = $_GET['sort_by'] ?? null;

$data = topPlayers($sort_by);
echo json_encode($data);
