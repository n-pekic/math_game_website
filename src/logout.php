<?php

require_once 'functions.php';

session_start();
session_unset();
session_destroy();

redirection("index.php");

exit();
