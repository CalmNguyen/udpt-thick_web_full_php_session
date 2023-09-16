<?php

class dbconn
{
    private static $instance;
    private $connection;

    private function __construct()
    {
        require __DIR__ . '/../config.inc';

        $this->connection = mysqli_connect($servername, $username, $password, $database);

        if (!$this->connection) {
            die("Kết nối cơ sở dữ liệu thất bại: " . mysqli_connect_error());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new dbconn();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function closeConnection()
    {
        mysqli_close($this->connection);
    }
}