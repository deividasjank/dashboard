<?php

namespace Model;

use PDO;

class Database
{
    private static $instance = null;

    /**
     * Get Database connection instance
     * @return PDO
     * @throws \Exception
     */
    public static function getInstance()
    {
        $config = require (ROOT . '/config/config.php');
        if (!isset(
            $config['database']['host'],
            $config['database']['name'],
            $config['database']['user'],
            $config['database']['password'])
        ) {
            throw new \Exception('Database is not configured');
        }
        if (!isset(self::$instance)) {
            self::$instance = new PDO(
                'mysql:host=' . $config['database']['host'] . ';dbname=' . $config['database']['name'] . ';charset=utf8',
                $config['database']['user'],
                $config['database']['password'],
                [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        }

        return self::$instance;
    }
}