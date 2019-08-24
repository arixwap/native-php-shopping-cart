<?php

/**
 * Native PHP Database Class
 * Created By : Arix Wap (arix.wap@gmail.com) - 21 Aug 2019
 */

class DatabaseClass
{
    /**
     * Initial class variables
     */
    protected $host;
    protected $username;
    protected $password;
    protected $database;
    // -- //
    public $connection;

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
            die ("Connection Failed. ". mysqli_connect_error());
        }

        $this->connection = $connection;
    }

    /**
     * Get table data by raw query and return it as array
     */
    public function query($string)
    {
        $result = false;
        $query = $this->connection->query($string);

        // Query String is GET Table Data / INSERT UPDATE
        if (strpos(strtoupper($string), 'SELECT') !== false) {

            if ($query == true && $query->num_rows > 0) {
                $rows = [];
                while ($row = $query->fetch_assoc()) {
                    $rows[] = $row;
                }
                $result = $rows;
            }

        } else {

            if ($this->connection->error) {
                $result = $this->connection->error;
            } else {
                $result = $query;
            }

        }

        return $result;
    }

    /**
     * Get table data and return it as array
     */
    public function get($table, $select = '*', $condition = null)
    {
        //
    }

    /**
     * Insert new data into table
     */
    public function insert($table, $data)
    {
        //
    }

    /**
     * Update table in raw query string condition
     */
    public function update($table, $condition, $data)
    {
        //
    }

    /**
     * Delete table in raw query string condition
     */
    public function delete($table, $condition)
    {
        //
    }

}

?>