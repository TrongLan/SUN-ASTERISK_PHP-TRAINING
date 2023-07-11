<?php

class Database
{
    public $serverName = "localhost";
    public $username = "root";
    public $databasePassword = "Landt@0812";
    public $databaseName = "php_tiv";

    public $connection;

    /**
     * @return false|mysqli
     */
    public function getConnection()
    {
        $this->connection =
            mysqli_connect($this->serverName, $this->username, $this->databasePassword, $this->databaseName);
        if (!$this->connection) {
            throw new Exception("Connection failed: " . mysqli_connect_error());
        }

        return $this->connection;
    }

    public function closeConnection() {
        mysqli_close($this->connection);
    }

}
