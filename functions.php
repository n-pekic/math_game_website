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


// id_highscore id_user correct_answers incorect_answers avg_time game_type game_level date_time
// maybe we can always grab full high-scores and just show more or less info on front-end (type not needed then)
/**
 * Function returns simple or full high-score table data based on passed parameter
 * @param string $type
 * @return array
 */
function getHighscores(): array
{
    $sql = "SELECT * FROM highscores";
    $stmt = $GLOBALS['pdo']->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

