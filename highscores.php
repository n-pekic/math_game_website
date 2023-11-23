<?php

require_once 'functions.php';

// will this post request method cause trouble for mobile app querry?
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirection('index.php');
    exit();
}

$highscore_data = getHighscores();
echo json_encode($highscore_data);