<?php
class DBManager
{
    public $dbLink;

    public $host;
    public $username;
    public $password;
    public $dbName;
    public $port;

    function __construct() {
        // Because security isn't an issue for this test application,
        // We'll just hardcode this in. In a real application situation use
        // an external file
        $this->host = 'localhost';
        $this->username = 'PHPSCRIPT'; // PHPSCRIPT // root
        $this->password = '1234'; // 1234 // password
        $this->dbName = 'cst8257';
        $this->port = 3306;

    }

    function isConnected() {
        return isset($this->dbLink);
    }

    function connect() {
        $this->dbLink = mysqli_connect(
            $this->host,
            $this->username,
            $this->password,
            $this->dbName,
            $this->port
        );

        if (!$this->dbLink) {
            echo "<p>".mysqli_connect_errno()."</p>";
            echo "<p>".mysqli_connect_error()."</p>";
            die("System is currently unavailable. Please try again later");
            //return false;
        }
        return true;
    }

    function close() {
        mysqli_close($this->dbLink);
        unset($this->dbLink);
    }

    function queryCustom($query) {
        $result = mysqli_query($this->dbLink, $query);
        return $result;
    }
    function queryAll($tableName) {
        $selectStatement = "SELECT * FROM $tableName";
        //echo $selectStatement;
        $result = mysqli_query($this->dbLink, $selectStatement);
        return $result;
    }
    function queryByID($tableName, $filterName, $filterValue) {
        $selectStatement = "SELECT *
                            FROM $tableName
                            WHERE $filterName = '$filterValue'";
        //echo $selectStatement;
        $result = mysqli_query($this->dbLink, $selectStatement);
        return $result;
    }
}