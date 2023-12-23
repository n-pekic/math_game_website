<?php
require_once 'config.php';

/**
 * Function tries to connect to database using PDO.
 * @param string $dsn
 * @param array $pdoOptions
 * @return PDO
 */
function connectDatabase(string $dsn, array $pdoOptions): PDO
{
    try {
        $pdo = new PDO($dsn, PARAMS['USER'], PARAMS['PASSWORD'], $pdoOptions);
    } catch (\PDOException $e) {
        var_dump($e->getCode());
        throw new \PDOException($e->getMessage());
    }

    return $pdo;
}


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
 * Function registers new user
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
 * Function checks user login and returns relevant data
 * @param array $login_data
 * @return array|bool
 */
function checkUserLogin(array $login_data): array|bool
{
    $sql = "SELECT id_user, username, password, role
            FROM users
            WHERE username = :username";

    $stmt = $GLOBALS['pdo']->prepare($sql);
    $stmt->bindValue(':username', $login_data['username'], PDO::PARAM_STR);
    $stmt->execute();

    $data = [];
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if($stmt->rowCount() >0){
        $user_password = $result['password'];

        if(password_verify($login_data['password'], $user_password)) {
            $data['id_user'] = $result['id_user'];
            $data['username'] = $result['username'];
            $data['role'] = $result['role'];
         }
    }

    return $data ?? false;
}


/**
 * Function retrieves info for all registered users
 * @return array
 */
function getUsers(): array
{
    $sql = "SELECT * FROM users";
    $stmt = $GLOBALS['pdo']->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * Function returns highscore data
 * @param $type
 * @return array
 */
function getHighscores(?string $arg = null): array
{
    if ($arg === 'guest') {
        $sql = "SELECT h.*, u.username
                FROM highscores h
                INNER JOIN users u ON h.id_user = u.id_user
                ORDER BY points DESC
                LIMIT 5";
    } elseif ($arg) {
        $sql = "SELECT h.*, u.username
                FROM highscores h
                INNER JOIN users u ON h.id_user = u.id_user
                WHERE u.username = :user_name
                ORDER BY h.points DESC, u.username";

        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':user_name', $arg, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $sql = "SELECT h.*, u.username
                FROM highscores h
                INNER JOIN users u ON h.id_user = u.id_user";
    }

    $stmt = $GLOBALS['pdo']->prepare($sql);
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

