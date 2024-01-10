<?php
session_start();
require_once 'functions.php';

if(isset($_SESSION['login']) && $_SESSION['login'] === true) {
    redirection("user_dashboard.php");
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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


    <link rel="stylesheet"  type="text/css" href="css/style.css">
    <script src="/js/scripts.js"></script>
    <title>Speed Math Challenge V2</title>
</head>
<body>

<section id="section-one" class="d-flex align-items-center justify-content-center">
    <div>
        <img src="img/speed_math_challenge_logo_crop.png" alt="speed_math_logo" width="150">
        <h2>Speed Math Challenge V2</h2>
    </div>
</section>

<section id="section-two" class="d-flex align-items-center justify-content-center">
    <div class="button-container">
        <!-- Button to trigger high-scores-modal -->
        <button id="button-high-scores" type="button" class="button-modal btn my-2 w-100"  data-bs-toggle="modal" data-bs-target="#high-scores-modal">
            High-scores!
        </button>

        <!-- Button to trigger the info-modal -->
        <button id="button-info" type="button" class="button-modal btn my-2 w-100"  data-bs-toggle="modal" data-bs-target="#info-modal">
            How to Play?
        </button>

        <!-- Button to trigger login-modal -->
        <button id="button-login" type="button" class="button-modal btn my-2 w-100"  data-bs-toggle="modal" data-bs-target="#login-modal">
            Log in
        </button>
    </div>
</section>

<section id="section-three" class="d-flex align-items-center justify-content-center">
    <?php
    $m = 0;
    if (isset($_GET["m"]) and is_numeric($_GET['m'])) {
        $m = (int)$_GET["m"];

        if (array_key_exists($m, $messages)) {
            echo '   
                <div class="alert" id="alert-container" role="alert">
                    <div class="text-center">
                    ' . $messages[$m] . '
                    </div>
                </div>
                ';
        }
    }
    ?>
</section>

<!-- Info modal -->
<div class="modal fade" id="info-modal" tabindex="-1" aria-labelledby="info-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div id="info-modal-header" class="modal-header text-center">
                <h5 class="modal-title w-100" id="info-modal-label">How to Play?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                <h4>Izbor Operacija</h4>
                Igrač na početku igre ima mogućnost da odabere vrstu matematičkih operacija s kojima će se suočiti tokom igre. Ove operacije uključuju osnovne aritmetičke funkcije kao što su sabiranje i množenje. Igrač na taj način može prilagoditi izazov prema svojim preferencama ili se fokusirati na poboljšanje određenih matematičkih veština.
                </p>

                <img src="img/instruction_screenshots/select_mode.jpg" alt="select game mode screenshot" class="mx-auto d-block" width="300">

                <p>
                <h4>Izbor Težine Pitanja</h4>
                Tokom postavljanja parametara igre, igrač ima mogućnost da odredi koliko teška pitanje želi rešiti tokom partije. Ovaj izbor omogućava prilagodljivost igre prema nivou udobnosti i željenoj tžinu igre, što omogućava personalizovano iskustvo svakom igraču.
                </p>

                <img src="img/instruction_screenshots/select_level.jpg" alt="select game difficulty level screenshot" class="mx-auto d-block" width="300">

                <p>
                <h4>Brzo Rešavanje</h4>
                Osnovni cilj igre je brzo i precizno rešavanje matematičkih zadataka. Igrač je izložen nizu pitanja koja zahtevaju brz odgovor, stvarajući dinamično iskustvo u kojem se brzina igrača meri kroz efikasnost u rešavanju problema. Ova komponenta dodatno naglašava aspekt vremenskog pritiska tokom igre.
                </p>

                <img src="img/instruction_screenshots/game_1.jpg" alt="game play screenshot, difficulty medium" class="mx-auto d-block" width="300">

                <p>
                <h4>Odbrojavanje Vremena</h4>
                Dodavanjem elementa vremena u igru, igrač se suočava s izazovom da reši svako pitanje unutar određenog vremenskog okvira. Ovo čini igru dinamičnom i podstiče igrača da održi visok tempo rešavanja kako bi postigao što bolji rezultat. Vreme može biti faktor koji dodatno testira sposobnosti igrača.
                </p>

                <img src="img/instruction_screenshots/game_2.jpg" alt="game play screenshot, time ran out, difficulty hard" class="mx-auto d-block" width="300">

                <p>
                <h4>Bodovanje</h4>
                Igrač osvaja bodove na osnovu dva ključna faktora: brzine i tačnosti u rešavanju postavljenih matematičkih izračuna. Svaki tačan odgovor donosi određeni broj bodova, a
                postizanje što većeg broja bodova postaje glavni cilj igre. Svai netačan odgovor oduzima određeni broj poena. Ova kombinacija brzine i tačnosti podstiče igrača da usavršava svoje matematičke veštine kako bi postigao što bolji rezultat.
                </p>

                <img src="img/instruction_screenshots/game_3.jpg" alt="game play screenshot difficulty level medium" class="mx-auto d-block" width="300">

                <p>
                <h4>Pauziranje</h4>
                Igrač ima mogućnost pauziranja igre. Tokom pauze na iskačućem prozru mu se prikazuje najbrži odgovor i prosečno vreme potrebno za odgovor na pitanje.
                <img src="img/instruction_screenshots/pause.jpg" alt="paused game screenshot" class="mx-auto d-block" width="300">
                </p>
            </div>
        </div>
    </div>
</div>

<!-- High-scores modal -->
<div class="modal fade" id="high-scores-modal" tabindex="-1" aria-labelledby="high-scores-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div id="highscore-modal-header" class="modal-header text-center">
                <h5 class="modal-title w-100" id="high-scores-modal-label">Top 5 High scores</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <table id="highscore-table-guest" class="table table-hover display" style="width:100%">
                        <caption style="caption-side: bottom; text-align: center">Log in for detailed view.</caption>
                    </table>
            </div>
        </div>
    </div>
</div>

<!-- Log in modal -->
<div class="modal fade" id="login-modal" tabindex="-1" aria-labelledby="login-modal-label" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div id="login-modal-header" class="modal-header text-center">
                <h5 class="modal-title w-100" id="login-modal-label">Log in</h5>
                <button id="close-modal-login" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="login-modal-body" class="modal-body">
                <form action="login.php" method="POST" id="login-form">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
                        <small></small>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                        <small></small>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="sb-login" value="sb" class="button-modal btn mx-2">Submit</button>
                        <button type="reset" id="reset-login" class="button-modal btn mx-2">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Prevent form resubmission on page refresh
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</body>
</html>

