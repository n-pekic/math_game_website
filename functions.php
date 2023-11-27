<?php

require_once 'db_config.php';

/**
 * Function redirects with header() to supplied string url.
 * @param string $url
 * @return void
 */
function redirection(string $url): void
{
    header("Location:$url");
    exit();
}


/**
 * Function tries to register new user
 * @param array $register_data
 * @return bool
 */
function userRegister(array $register_data): bool
{
    $sql = "INSERT INTO users(username, user_password, role)
               VALUES(:username, :user_password, 'user')";

    $stmt = $GLOBALS['pdo']->prepare($sql);
    $stmt->bindValue(':username', $register_data['username'], PDO::PARAM_STR);
    $stmt->bindValue(':user_password', $register_data['password'], PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->rowCount() > 0;
}


/**
 * Function returns user_id, username, role if match found in database, or returns false if no match found
 * @param array $login_data
 * @return array|bool
 */
function userLogin(array $login_data): array|bool
{
    $sql = "SELECT id_user, role, username
            FROM users
            WHERE username = :username AND user_password = :password";

    $stmt = $GLOBALS['pdo']->prepare($sql);
    $stmt->bindValue(':username', $login_data['username'], PDO::PARAM_STR);
    $stmt->bindValue(':password', $login_data['password'], PDO::PARAM_STR);
    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    return $data ?? false;
}


/**
 * Function info for all registered users
 * @return array
 */
function getUsers(): array
{
    $sql = "SELECT * FROM users";
    $stmt = $GLOBALS['pdo']->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// what gets passed and written via function still not determined.
/**
 * Function writes highscore data for given user id
 * @param int $id_user
 * @return bool
 */
function addHighscore(int $id_user): bool
{
    // pass an $array with all the necessary high-score data
    // write to database, and return rowCount > 0;
    return true;
}


// id_highscore id_user correct_answers incorrect_answers avg_time game_type game_level date_time
// maybe we can always grab full high-scores and just show more or less info on front-end (type not needed then)

//Function returns simple or full high-score table data based on passed parameter
//function getHighscores($id = null): array
function getHighscores($type = null): array
{

    $sql = "SELECT h.*, u.username
                FROM highscores h
                INNER JOIN users u ON h.id_user = u.id_user";

    if($type){
        $sql = "SELECT h.*, u.username
                FROM highscores h
                INNER JOIN users u ON h.id_user = u.id_user
                WHERE game_level = 'hard'
                ORDER BY h.correct_answers DESC
                LIMIT 5";
    }


//    if($id !== null){
//        $sql .= " WHERE u.id_user = :id";
//    }

    $stmt = $GLOBALS['pdo']->prepare($sql);

//    if ($id !== null) {
//        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
//    }

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getHighscoresGuest(): array
{

    // treba videti sta ce se tacno prikazivati gostima na sajtu.
    // top 5 po tacnim odgovorima za tekuci ili prethodni mesec
    $sql = "SELECT h.*, u.username
            FROM highscores h
            INNER JOIN users u ON h.id_user = u.id_user
            WHERE (YEAR(h.date_time) = YEAR(CURRENT_DATE()) AND MONTH(h.date_time) = MONTH(CURRENT_DATE()))
            OR (YEAR(h.date_time) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) AND MONTH(h.date_time) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH))
            ORDER BY correct_answers DESC
            LIMIT 5;";

    // top 5 all time po tacnim odgovorima
    $sql2 = "SELECT h.*, u.username
                FROM highscores h
                INNER JOIN users u ON h.id_user = u.id_user
                WHERE game_level = 'hard'
                ORDER BY h.correct_answers DESC
                LIMIT 5";



    $stmt = $GLOBALS['pdo']->prepare($sql2);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

