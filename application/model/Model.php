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
     * Destructor
     */
    public function __destruct()
    {
        $this->connection = null;
    }

}