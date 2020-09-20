<?php

require_once "db.php";

class Connection {

    public static function getConnection(){

        $conn = new PDO("mysql:host=".DB_HOST.";dbname=blog", DB_USER, DB_PASSWORD);

        return $conn;

    }


}