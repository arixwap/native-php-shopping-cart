<?php

class DatabaseClass
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
     *
     * Connect to MySQL Database
     *
     */
    public function __construct($host, $username, $password, $database)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        // Start Connection
        $connection = mysqli_connect($host, $username, $password, $database);
        if ( ! $connection ) {
            die ("connection failed.". mysqli_connect_error());
        }

        return $connection;
    }
}

?>