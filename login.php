<?php
session_start();
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirection('index.php');
    exit();
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $login_data['username'] = strip_tags(trim($_POST['username']));
    $login_data['password'] = strip_tags(trim($_POST['password']));
}

$user_data = checkUserLogin($login_data);

if($user_data) {
    $_SESSION['login'] = true;
    $_SESSION['id_user'] = $user_data['id_user'];
    $_SESSION['username'] = $user_data['username'];
    $_SESSION['role'] = $user_data['role'];
    redirection('user_dashboard.php');
} else {
    session_unset();
    session_destroy();
    redirection('index.php?m=2');
}


