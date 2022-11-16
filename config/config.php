<?php
define('SITEURL', 'http://localhost/capstone');

class Dbconfig {
    protected $serverName;
    protected $userName;
    protected $passCode;
    protected $dbName;

    //NOTE - IF YOU CHANGE THIS FOR YOUR DEV MACHINE, PLEASE DO NOT COMMIT IT TO THE REPO
    //for a local connection replace userName and passCode below with your credentials
    function __construct()
    {
        $this -> serverName = 'localhost';
        $this -> userName = 'root'; // <-Replace this with your database username
        $this -> passCode = ''; // <-Replace this with your database password
        $this -> dbName = 'ccws';
    }
}
?>