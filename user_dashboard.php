<?php
// to continue session from previous page or start new one
// and grab neccessary data (signup / role);

session_start();
require_once 'functions.php';

// true or false (whether user has logged in)
$login = $_SESSION['login'];
$role = $_SESSION['role'];

if($login === true){
    switch ($role){
        case "user":
            echo 'user panel';
            echo '<br> user session var dump <br>:';
            var_dump($_SESSION);
            break;
        case "admin":
            echo 'admin panel';
            echo '<br> admin session var dump <br>:';
            var_dump($_SESSION);
            break;
        default:
            redirection('logout.php');
            break;
    }
}

echo '<a href="src/logout.php">Log out</a>';