<?php

class Database
{

    static protected $db_conn = null;
    static private $db_host = "localhost";
    static private $db_user = "root";
    static private $db_pass = "coderslab";
    static private $db_name = "Books_db";
    static private $charset = 'utf8';
    static private $db_opt = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    );

    static public function getConnection()
    {
        try {
            $conn = new PDO('mysql:host=' . self::$db_host . ';dbname=' . self::$db_name . ';charset=' . self::$charset, self::$db_user, self::$db_pass, self::$db_opt);
            return self::$db_conn = $conn;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }


// Close connection
    static public function closeConnection($conn)
    {
        $conn = null;
    }

}
