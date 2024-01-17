<?php
session_start();
require_once 'functions.php';

if(!isset($_SESSION['login']) && $_SESSION['login'] !== true) {
    redirection("index.php");
} else {
    $id_user = $_SESSION['id_user'];
    $login = $_SESSION['login'];
    $role = $_SESSION['role'];
    $username = $_SESSION['username'];
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
    <link href="https://fonts.googleapis.com/css2?family=AR+One+Sans&family=Jockey+One&family=Varela+Round&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet"  type="text/css" href="css/style.css">
    <script src="/js/scripts.js"></script>
    <title>Speed Math Challenge V2</title>
</head>
<body>

<section id="section-one" class="d-flex align-items-center justify-content-center">
    <div>
        <img src="img/speed_math_challenge_logo_crop.png" alt="speed_math_logo" width="150">
        <h2>Speed Math Challenge V2</h2>
        <h3>Hello, <?= $username ?>!</h3>
    </div>
</section>

<section id="section-two" class="d-flex align-items-center justify-content-center">

    <?php
    switch ($role){

        case 'admin':
            echo
            '
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="data-table container mt-5">
                            <h3>High-scores</h3>
                            <table id="highscore-table-admin" class="table table-hover display" style="width:100%"></table>   
                        </div>
                    </div>
                    <div class="col">
                        <div class="data-table container mt-5">
                            <h3>Users</h3>
                            <table id="user-table-admin" class="table table-hover display" style="width:100%"></table>
                        </div> 
                    </div>
                </div>    
                
                <div class="row justify-content-center">
                     <div class="col-lg-5">
                        <div class="data-table container mt-5">
                            <h3>Top 5 players by games played</h3>
                            <canvas id="top-players-games"></canvas>       
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="data-table container mt-5">
                            <h3>Top 5 players by points won</h3>
                            <canvas id="top-players-points"></canvas>       
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-6">
                        <div class="data-table container mt-5">
                            <h3>Games played by level</h3>
                            <canvas id="num-diff-level"></canvas>       
                        </div>
                    </div>
                     <div class="col-lg-6">
                        <div class="data-table container mt-5">
                            <h3>Games played by type</h3>
                            <canvas id="num-type"></canvas>       
                        </div>
                    </div>
                </div>
            </div>
            ';
            break;

        case 'user':
            echo
            '
            <div class="container"> 
                <div class="row">
                    <div class="col">
                        <div class="data-table container mt-5">
                            <h3>High-scores</h3>
                            <table id="highscore-table-user" class="table table-hover display" style="width:100%"></table>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-6">
                        <div class="data-table container mt-5">
                            <h3>Accuracy, games played by level</h3>
                            <canvas id="user-stats-game-level"></canvas>       
                        </div>
                    </div>
                     <div class="col-lg-6">
                        <div class="data-table container mt-5">
                            <h3>Accuracy, games played by type</h3>
                            <canvas id="user-stats-game-type"></canvas>       
                        </div>
                    </div>
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
            How to Play?
        </button>

        <!-- Log out Button-->
        <a href="logout.php" id="button-logout" role="button" class="button-modal btn my-2 w-100">Log Out</a>
</section>

<!-- Info modal -->
<div class="modal fade" id="info-modal" tabindex="-1" aria-labelledby="info-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div id="info-modal-header" class="modal-header text-center">
                <h5 class="modal-title w-100" id="info-modal-label-panel">How to Play</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>Izbor Operacija</h4>
                <p>
                Igrač na početku igre ima mogućnost da odabere vrstu matematičkih operacija s kojima će se suočiti tokom igre. Ove operacije uključuju osnovne aritmetičke funkcije kao što su sabiranje i množenje. Igrač na taj način može prilagoditi izazov prema svojim preferencama ili se fokusirati na poboljšanje određenih matematičkih veština.
                </p>

                <img src="img/instruction_screenshots/select_mode.jpg" alt="select game mode screenshot" class="mx-auto d-block" width="300">

                <h4>Izbor Težine Pitanja</h4>
                <p>
                Tokom postavljanja parametara igre, igrač ima mogućnost da odredi koliko teška pitanje želi rešiti tokom partije. Ovaj izbor omogućava prilagodljivost igre prema nivou udobnosti i željenoj tžinu igre, što omogućava personalizovano iskustvo svakom igraču.
                </p>

                <img src="img/instruction_screenshots/select_level.jpg" alt="select game difficulty level screenshot" class="mx-auto d-block" width="300">

                <h4>Brzo Rešavanje</h4>
                <p>
                Osnovni cilj igre je brzo i precizno rešavanje matematičkih zadataka. Igrač je izložen nizu pitanja koja zahtevaju brz odgovor, stvarajući dinamično iskustvo u kojem se brzina igrača meri kroz efikasnost u rešavanju problema. Ova komponenta dodatno naglašava aspekt vremenskog pritiska tokom igre.
                </p>

                <img src="img/instruction_screenshots/game_1.jpg" alt="game play screenshot, difficulty medium" class="mx-auto d-block" width="300">

                <h4>Odbrojavanje Vremena</h4>
                <p>
                Dodavanjem elementa vremena u igru, igrač se suočava s izazovom da reši svako pitanje unutar određenog vremenskog okvira. Ovo čini igru dinamičnom i podstiče igrača da održi visok tempo rešavanja kako bi postigao što bolji rezultat. Vreme može biti faktor koji dodatno testira sposobnosti igrača.
                </p>

                <img src="img/instruction_screenshots/game_2.jpg" alt="game play screenshot, time ran out, difficulty hard" class="mx-auto d-block" width="300">

                <h4>Bodovanje</h4>
                <p>
                Igrač osvaja bodove na osnovu dva ključna faktora: brzine i tačnosti u rešavanju postavljenih matematičkih izračuna. Svaki tačan odgovor donosi određeni broj bodova, a
                postizanje što većeg broja bodova postaje glavni cilj igre. Svai netačan odgovor oduzima određeni broj poena. Ova kombinacija brzine i tačnosti podstiče igrača da usavršava svoje matematičke veštine kako bi postigao što bolji rezultat.
                </p>

                <img src="img/instruction_screenshots/game_3.jpg" alt="game play screenshot difficulty level medium" class="mx-auto d-block" width="300">

                <h4>Pauziranje</h4>
                <p>
                Igrač ima mogućnost pauziranja igre. Tokom pauze na iskačućem prozru mu se prikazuje najbrži odgovor i prosečno vreme potrebno za odgovor na pitanje.
                <img src="img/instruction_screenshots/pause.jpg" alt="paused game screenshot" class="mx-auto d-block" width="300">
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</body>
</html>

