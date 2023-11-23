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
 * Function tries to register new user and returns whether it was successful
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
 * Function returns user id and role if match found in database, or returns false if no match was found
 * @param array $login_data
 * @return array|bool
 */
function userLogin(array $login_data): array|bool
{
    $sql = "SELECT id_user, role 
            FROM users
            WHERE username = :username AND user_password = :password";

    $stmt = $GLOBALS['pdo']->prepare($sql);
    $stmt->bindValue(':username', $login_data['username'], PDO::PARAM_STR);
    $stmt->bindValue(':password', $login_data['password'], PDO::PARAM_STR);
    $stmt->execute();

    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user_data ?? false;
}

/**
 * Function returns simple or full high-score table data based on passed parameter
 * @param string $type
 * @return array
 */
function getHighscores(string $type): array
{
    return 'highscore data array';
}


/**
 * Function writes highscore data for given user id
 * @param int $id_user
 * @return bool
 */
function writeHighscore(int $id_user): bool
{
    $success = true;
    return $success;
}
