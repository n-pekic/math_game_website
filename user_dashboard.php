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
                <p>How to play the game goes here</p>
            </div>
        </div>
    </div>
</div>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<!-- Admin chart js-->
<script>
    const diffLevel = document.getElementById('num-diff-level');
    if(diffLevel) {
        $.ajax({
            url: 'ajax/game_difficulty_stats.php',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                new Chart(diffLevel, {
                    type: 'bar',
                    data: {
                        labels: data.map(entry => entry.game_level),
                        datasets: [{
                            label: 'Total games played',
                            data: data.map(entry => entry.games_played),
                            borderWidth: 1
                        }]
                    },
                    options: {}
                });
            },
            error: function (error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    const gameType = document.getElementById('num-type');
    if(gameType) {
        $.ajax({
            url: 'ajax/game_type_stats.php',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                new Chart(gameType, {
                    type: 'bar',
                    data: {
                        labels: data.map(entry => entry.game_type),
                        datasets: [{
                            label: 'Total games played',
                            data: data.map(entry => entry.games_played),
                            borderWidth: 1,
                            backgroundColor: [
                                'rgb(149,227,149, 0.7)',
                                'rgb(149,227,149, 0.7)',
                                'rgb(149,227,149, 0.7)',
                                'rgb(149,227,149, 0.7)'
                                // 'rgb(54,162,235, 0.7)',
                                // 'rgb(255,205,86, 0.7)',
                                // 'rgb(255,99,132, 0.7)'
                            ]
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                ticks: {
                                    precision: 0
                                }
                            }
                        }
                    }
                });
            },
            error: function (error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    const topPlayersGames = document.getElementById('top-players-games');
    if(topPlayersGames) {
        $.ajax({
            url: 'ajax/top_player_stats.php',
            method: 'GET',
            dataType: 'json',
            data: {
                sort_by: 'total_games'
            },
            success: function (data) {
                new Chart(topPlayersGames, {
                    type: 'doughnut',
                    data: {
                        labels: data.map(entry => entry.username),
                        datasets: [{
                            label: 'Total games played',
                            data: data.map(entry => entry.games_played),
                            borderWidth: 1
                            // backgroundColor: [
                            //     'rgb(149,227,149, 0.7)',
                            //     'rgb(54,162,235, 0.7)',
                            //     'rgb(255,205,86, 0.7)',
                            //     'rgb(255,99,132, 0.7)'
                            // ]
                        }]
                    },
                    options: {}
                });
            },
            error: function (error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    const topPlayersPoints = document.getElementById('top-players-points');
    if(topPlayersPoints) {
        $.ajax({
            url: 'ajax/top_player_stats.php',
            method: 'GET',
            dataType: 'json',
            data: {
                sort_by: 'total_points'
            },
            success: function (data) {
                new Chart(topPlayersPoints, {
                    type: 'doughnut',
                    data: {
                        labels: data.map(entry => entry.username),
                        datasets: [{
                            label: 'Total points won',
                            data: data.map(entry => entry.points),
                            borderWidth: 1,
                            backgroundColor: [
                                'rgba(95,190,95,0.7)',
                                'rgba(238,179,54,0.7)'
                            ]
                        }]
                    },
                    options: {}
                });
            },
            error: function (error) {
                console.error('Error fetching data:', error);
            }
        });
    }
</script>

<!-- User chart js-->
<script>

    const userStatsGameLevel = document.getElementById('user-stats-game-level');
    if(userStatsGameLevel) {
        $.ajax({
            url: 'ajax/user_game_stats.php',
            method: 'GET',
            dataType: 'json',
            data: {
                filter: 'game_level',
                id: '<?= $id_user ?>'
            },
            success: function (data) {
                new Chart(userStatsGameLevel, {
                    type: 'bar',
                    data: {
                        labels: data.map(entry => entry.game_level),
                        datasets: [{
                            label: 'Games played',
                            data: data.map(entry => entry.games_played),
                            borderWidth: 1,
                            backgroundColor: 'rgba(73,217,251,0.6)'
                        },
                            {
                                label: 'Accuracy (%)',
                                //data: data.map(entry => entry.ans_accuracy),
                                data: data.map(entry => parseFloat(entry.ans_accuracy)), // Convert to float
                                borderWidth: 1,
                                backgroundColor: 'rgba(137,238,174,0.6)'
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                ticks: {
                                    precision: 0
                                }
                            }
                        }
                    }
                });
            },
            error: function (error) {
                console.error('Error fetching data:', error);
            }
        });
    }


    const userStatsGameType = document.getElementById('user-stats-game-type');
    if(userStatsGameType) {
        $.ajax({
            url: 'ajax/user_game_stats.php',
            method: 'GET',
            dataType: 'json',
            data: {
                filter: 'game_type',
                id: '<?= $id_user ?>'
            },
            success: function (data) {
                console.log(data);
                new Chart(userStatsGameType, {
                    type: 'bar',
                    data: {
                        labels: data.map(entry => entry.game_type),
                        datasets: [{
                            label: 'Games played',
                            data: data.map(entry => entry.games_played),
                            borderWidth: 1,
                            backgroundColor: 'rgba(73,217,251,0.6)'
                        },
                            {
                                label: 'Accuracy (%)',
                                //data: data.map(entry => entry.ans_accuracy),
                                data: data.map(entry => parseFloat(entry.ans_accuracy)), // Convert to float
                                borderWidth: 1,
                                backgroundColor: 'rgba(137,238,174,0.6)'
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                ticks: {
                                    precision: 0
                                }
                            }
                        }
                    }
                });
            },
            error: function (error) {
                console.error('Error fetching data:', error);
            }
        });
    }
</script>

</body>
</html>

