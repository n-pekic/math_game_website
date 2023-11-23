<?php

/* current code used for testing w/ mobile app
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['username']) && isset($_POST['password'])) {
    if ($db->dbConnect()) {
        if ($db->logIn("users", $_POST['username'], $_POST['password'])) {
            echo "Login Success";
        } else echo "Username or Password wrong";
    } else echo "Error: Database connection";
} else echo "All fields are required";
*/

// check whether this page was opened from domain.com/index.php
// check if server request method is post ?
// check if submitted action in_array of $actions[] in db_config.php ?
// other checks available in

// start session
// include functions (which includes db_config.php)
// check POST form field values and assign
// if mobile -> call userSignup function
// if web -> call userSignup function

// check if user/pass exists in database:
// select user_id, username, roleFROM users where username = :username AND user_password = :password
// return user_id and role if successful or false

session_start();
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirection('index.php');
    exit();
}

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['source']) && isset($_POST['action'])) {
    $login_data['action'] = strip_tags(trim($_POST['action']));
    $login_data['source'] = strip_tags(trim($_POST['source']));
    $login_data['username'] = strip_tags(trim($_POST['username']));
    $login_data['password'] = strip_tags(trim($_POST['password']));
}

if($login_data['source'] === 'mobile') {
    //var_dump($user_data);
    // check if false value is a better return than the error message.
    $user_data = userLogin($login_data);
    echo json_encode($user_data !== false ? $user_data : "No such username or password");
} elseif ($login_data['source'] === 'web') {
    $user_data = userLogin($login_data);
    var_dump($user_data);

    if($user_data) {
        $_SESSION['login'] = true;
        $_SESSION['id_user'] = $user_data['id_user'];
        $_SESSION['username'] = $user_data['username'];
        $_SESSION['role'] = $user_data['role'];
        redirection('user_dashboard.php');
    } else {
        // take display message code from web_prog project login_register page
        // "no such username password.", logout.php will set error message
        session_unset();
        session_destroy();
        redirection('index.php?m=2');
    }
}




