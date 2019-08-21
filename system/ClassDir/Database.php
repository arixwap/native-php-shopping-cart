<?php

class Database
{
    /**
     * Initial class variables
     */
    protected $host;
    protected $username;
    protected $password;
    protected $database;

    /**
     * Constructor Class
     */
    public function __construct($host, $username, $password, $database)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        return $this->connectMysql();
    }

    /**
     * Connect to MySQL Database
     */
    public function connectMysql()
    {
        $connection = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if ( ! $connection ) {
            die ("connection failed.". mysqli_connect_error());
        }

        return $connection;
    }
}

?>