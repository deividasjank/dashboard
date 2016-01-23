<?php

namespace Model;

abstract class Model
{
    /**
     * @var \PDO
     */
    protected $connection;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->connection = Database::getInstance();
    }

    /**
     * @param string $query
     * @param array $params
     * @return mixed
     */
    public function execute($query, $params = [])
    {
        $query = $this->connection->prepare($query);
        $query->execute($params);

        return $query->fetchAll();
    }

    /**
     * Destructor
     */
    public function __destruct()
    {
        $this->connection = null;
    }

}