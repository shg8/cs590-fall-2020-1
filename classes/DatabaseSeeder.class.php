<?php

class DatabaseSeeder
{

    private $mysqli;

    public function is_mysql_set_up()
    {
        return isset($this->mysqli);
    }

    public function setup_mysql($host, $username, $password, $dbname)
    {
        if (!isset($this->mysqli)) {
            $this->mysqli = new mysqli($host, $username, $password, $dbname);
            if ($this->mysqli->connect_error) {
                die("Database setup error. Check credentials.");
            }
        }
    }

    public function table_exists($dbname)
    {
        return $this->mysqli->query("
            SELECT * 
            FROM information_schema.tables
            WHERE table_schema = '$dbname' 
                AND table_name = 'users'
            LIMIT 1;
        ")->num_rows > 0;
    }

    public function create_tables()
    {
        if ($this->mysqli->query("
            CREATE TABLE users (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR (30) NOT NULL,
            name VARCHAR (30) NULLABLE,
            password VARCHAR (128) NOT NULL
            )
        ") === false) {
            die("Failed to create table");
        }
    }

    // print this out!
    public function insert_random_users($num)
    {
        $result = array();
        for ($i = 0; $i < $num; $i++) {
            $username = $this->generateRandomString();
            $name = $this->generateRandomString();
            $pass = $this->generateRandomString();
            $passHashed = password_hash($pass);
            // no interpolation here because we don't have to worry about injection
            // all the values are generated within the function
            $sql = "INSERT INTO users (username, name, password) VALUES ('$username', '$name', '$passHashed')";
            $this->mysqli->query($sql);
            $result[] = "Username: $username | Name: $name | Password: $pass";
        }
        return $result;
    }

    // code from https://stackoverflow.com/questions/4356289/php-random-string-generator
    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

}