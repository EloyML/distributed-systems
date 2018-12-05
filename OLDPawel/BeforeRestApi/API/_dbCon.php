<?php
/**
 * Created by PhpStorm.
 * User: Pawel
 * Date: 30/04/2018
 * Time: 16:47
 */

class Database {

    private $localhost = "127.0.0.1";
    private $dbUsername = "root";
    private $dbPassword = "";
    private $dbName = "callendar";
    public $connection;

    public function getConnection()
    {
        //Connection
        $this->connection = null;

        try {

            $this->connection = new mysqli($this->localhost, $this->dbUsername, $this->dbPassword, $this->dbName);

        }
        catch (Exception $e) {

            $error = $e->errorMessage();
            echo $error;
        }

        return $this->connection;
    }

    public function closeConnection() {

        return $this->connection->close();
    }

    function __destruct()
    {
       $this->connection->close();
    }
}