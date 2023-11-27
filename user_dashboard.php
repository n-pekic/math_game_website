<?php

session_start();
require_once 'functions.php';

if(!isset($_SESSION['login']) && $_SESSION['login'] !== true) {
    redirection("index.php");
} else {
    $id_user = $_SESSION['id_user'];
    $login = $_SESSION['login'];
    $role = $_SESSION['role'];
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=AR+One+Sans&family=Varela+Round&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <link rel="stylesheet"  type="text/css" href="css/style.css">
    <script src="/js/scripts.js"></script>
    <title>Speed Math Challenge v2</title>
</head>
<body>

<section id="section-one" class="d-flex align-items-center justify-content-center">
    <div>
        <img src="img/speed_math_challenge_logo_crop.png" alt="speed_math_logo" width="150">
        <h2>Speed Math Challenge v2</h2>
        <h3>Hello, <?= $_SESSION['username'] ?>!</h3>
    </div>
</section>

<section id="section-two" class="d-flex align-items-center justify-content-center">

    <?php

    switch ($role){

        case 'admin':
            echo
            '
            <div class="table-container">
                <div class="data-table container mt-5">
                <h3>All Users</h3>
                    <table id="user-table-admin" class="table table-hover display" style="width:100%"></table>
                </div> 
                
                <div class="data-table container mt-5">
                    <h3>All Highscores</h3>
                    <table id="highscore-table-admin" class="table table-hover display" style="width:100%"></table>   
                </div>
            </div>
            ';
            break;

        case 'user':
            echo
            '
            <div class="table-container"> 
                
               <!--
               <div class="data-table container mt-5">
                <h3>Your High-scores</h3>
                    <table id="highscore-table-user-personal" class="table table-hover display" style="width:100%"></table>
                </div>
                <input id="hidden-input" type="hidden" name="id_user" value="">
                -->
                
                <div class="data-table container mt-5">
                <h3>High-scores</h3>
                    <table id="highscore-table-user" class="table table-hover display" style="width:100%"></table>
                </div>
 
            </div>
            ';
            break;

        default:
            redirection('logout.php');
            break;
    }

    ?>


</section>

<section id="section-three" class="d-flex align-items-center justify-content-center">
    <div class="button-container">
        <!-- Button to trigger the info-modal -->
        <button id="button-info" type="button" class="button-modal btn my-2 w-100"  data-bs-toggle="modal" data-bs-target="#info-modal">
            How to Play
        </button>

        <!-- Log out Button-->
        <a href="logout.php" id="button-login" role="button" class="button-modal btn my-2 w-100">Log Out</a>
</section>

<!-- Info modal -->
<div class="modal fade" id="info-modal" tabindex="-1" aria-labelledby="info-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div id="info-modal-header" class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">How to Play</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>How to play the game goes here</p>
            </div>
        </div>
    </div>
</div>

<script>
    // Add this JavaScript code to prevent form resubmission on page refresh
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</body>
</html>

