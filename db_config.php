<?php

const PARAMS = [
    "HOST" => 'localhost',
    "USER" => 'root',
    "PASSWORD" => '',
    "DB" => 'agilni',
    "CHARSET" => 'utf8mb4'
];

$dsn = "mysql:host=" . PARAMS['HOST'] . ";dbname=" . PARAMS['DB'] . ";charset=" . PARAMS['CHARSET'];

$pdoOptions = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
];

$GLOBALS['pdo'] = connectDatabase($dsn, $pdoOptions);

/**Function tries to connect to database using PDO.
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