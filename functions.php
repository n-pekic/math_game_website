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
    $sql = "SELECT 
            u.id_user,
            u.role,
            u.username,
            COUNT(*) AS 'total games',
             (
                SELECT game_type
                FROM highscores h_sub
                WHERE h_sub.id_user = u.id_user
                GROUP BY game_type
                ORDER BY COUNT(*) DESC
                LIMIT 1
            ) AS 'favorite type',
            (
                SELECT game_level
                FROM highscores h_sub
                WHERE h_sub.id_user = u.id_user
                GROUP BY game_level
                ORDER BY COUNT(*) DESC
                LIMIT 1
            ) AS 'favorite level',
            SUM(points) AS 'total points',
            CONCAT(ROUND(AVG(correct_answers / NULLIF(correct_answers + incorrect_answers, 0)) * 100, 2), '%') AS 'accuracy'
            FROM 
                users u
            JOIN 
                highscores h ON u.id_user = h.id_user
            GROUP BY 
            u.id_user";

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
        $sql = "SELECT 
				u.username,
                h.points, 
                h.correct_answers, 
                h.incorrect_answers, 
                h.avg_time, 
                h.fastest_answer, 
                h.game_type, 
                h.game_level, 
                h.date_time , 
                u.username
                FROM highscores h
                INNER JOIN users u ON h.id_user = u.id_user
                ORDER BY points DESC
                LIMIT 5";
    } else {
        $sql = "SELECT 
                u.username, 
                h.points, 
                h.correct_answers, 
                h.incorrect_answers, 
                h.avg_time, 
                h.fastest_answer, 
                h.game_type, 
                h.game_level, 
                h.date_time
                FROM highscores h
                INNER JOIN users u ON h.id_user = u.id_user
                ORDER BY h.points DESC, u.username";
    }

    $stmt = $GLOBALS['pdo']->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}


/**
 * Function retrieves total number of games played by difficulty level
 * @return array
 */
function getGameDiffLevelStats(): array
{
    /*
   [
   {"game_level":"easy","games_played":2},
   {"game_level":"medium","games_played":5},
   {"game_level":"hard","games_played":7}
   ]
    */
    $sql = "SELECT game_level, COUNT(*) AS games_played
            FROM highscores
            GROUP BY game_level
            ORDER BY FIELD(game_level, 'easy', 'medium', 'hard')";

    $stmt = $GLOBALS['pdo']->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * Function retrieves total number of games played by type
 * @return array
 */
function getGameTypeStats(): array
{
    /*
     [
     {"game_type":"add","games_played":5},
     {"game_type":"subtract","games_played":2},
     {"game_type":"multiply","games_played":5},
     {"game_type":"modulo","games_played":2}
     ]
    */
    $sql = "SELECT game_type, COUNT(*) AS games_played
            FROM highscores
            GROUP BY game_type
            ORDER BY FIELD(game_type, 'add', 'subtract', 'multiply', 'modulo')";

    $stmt = $GLOBALS['pdo']->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * Function returns top players by summed games or points
 * @param string $sort_by
 * @return array
 */
function topPlayers(string $sort_by): array
{
    if($sort_by === 'total_games'){
        $sql = "SELECT u.username, COUNT(*) AS games_played
                FROM users u
                JOIN highscores h ON u.id_user = h.id_user
                GROUP BY u.id_user
                ORDER BY games_played DESC
                LIMIT 5";
    } else if ($sort_by === 'total_points') {
        $sql = "SELECT u.username, SUM(points) AS points
                FROM users u
                JOIN highscores h ON u.id_user = h.id_user
                GROUP BY u.id_user
                ORDER BY points DESC
                LIMIT 5";
    }

    $stmt = $GLOBALS['pdo']->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




