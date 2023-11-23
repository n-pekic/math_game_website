<?php

require_once 'functions.php';

/*
 * maybe use something like this + $source check
 *
        $referer = $_SERVER['HTTP_REFERER'];
        $action = $_POST['action'];

        if ($action != "" and in_array($action, $actions) and strpos($referer, SITE) !== false ) {

            switch ($action) {
             case "login":
 */

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirection('index.php');
    exit();
}

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['source']) && isset($_POST['action'])) {
    $register_data['action'] = strip_tags(trim($_POST['action']));
    $register_data['source'] = strip_tags(trim($_POST['source']));
    $register_data['username'] = strip_tags(trim($_POST['username']));
    $register_data['password'] = strip_tags(trim($_POST['password']));
} else {
    echo "All fields are required.";
}

echo 'var dump post <br>';
var_dump($_POST);
echo '--------<br>';

echo 'dump register data<br>';
var_dump($register_data);
echo '--------<br>';

if(userRegister($register_data)){
    echo "Registration successful, you can now log in.";
} else {
    echo "Something went wrong, please try again.";
}



