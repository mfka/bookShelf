<?php

class Database {

    static public $conn = null;
    static private $db_host = "localhost";
    static private $db_user = "root";
    static private $db_pass = "coderslab";
    static private $db_name = "Books_db";

    #laczy z baza daynch;

    static public function getConnection() {
        self::$conn = new mysqli(self::$db_host, self::$db_user, self::$db_pass, self::$db_name);


        if (self::$conn->connect_error) {
            die('Wystąpił Błąd');
        } else {
            self::$conn->query('SET NAMES utf8');
            self::$conn->query('SET CHARACTER_SET utf8_unicode_ci');
            return self::$conn;
        }
    }

    #zamyka polaczenie z baza danych;

    static public function closeConnection() {
        self::$conn->close();
        self::$conn = Null;
        return true;
    }

}
