<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../functions.php';

$data = getGameDiffLevelStats();
echo json_encode($data);

