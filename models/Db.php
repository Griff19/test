<?php


class Db
{
    public $host = '127.0.0.1';
    public $user = 'root';
    public $pass = '';
    public $base = 'test';

    private $connection;

    /**
     * @return bool|mysqli
     */
    public function connect(){
        $connect = new mysqli($this->host, $this->user, $this->pass, $this->base);
        $connect->set_charset("utf8");

        if ($connect->connect_errno) {
            return false;
        }
        else {
            $this->connection = $connect;
            return $connect;
        }
    }

    /**
     * @param $fields
     * @param $condition
     * @return array
     */
    public function select($fields, $condition)
    {
        $sql = "SELECT ". $fields ." FROM users WHERE " . $condition;
        $res = $this->connection->query($sql);

        $arr = [];
        while ($row = $res->fetch_assoc()) {
            $arr[] = $row;
        }
        return $arr;
    }
    /**
     * @return array|bool
     */
    public function selectAll()
    {
        $sql = 'SELECT * FROM users';
        if (!$res = $this->connection->query($sql)){
            return false;
        }
        else {
            $arr = [];
            while ($user = $res->fetch_assoc()) {
                $arr[] = $user['username'];
            }
            return $arr;
        }
    }

    /**
     * @param $login
     * @param $password
     * @return bool
     */
    public function validUser($login, $password){
        $sql = "SELECT * FROM users WHERE login = '" . $login . "' AND pass = '" . $password . "'";
        if (!$res = $this->connection->query($sql)){
            return false;
        }
        else {
            $row = $res->fetch_assoc();
            return $row;
        }
    }

    /**
     * @param $labels
     * @param $values
     * @return bool
     */
    public function insert($labels, $values)
    {
        $sql = "INSERT INTO users (". $labels .") 
                VALUES (". $values .")";
        if ($this->connection->query($sql))
            return true;
        return false;
    }

    /**
     * @param $id
     * @return bool
     */
    public function find($id)
    {
        $sql = "SELECT * FROM users WHERE id = " . $id;

        if ($res = $this->connection->query($sql))
            $row = $res->fetch_assoc();
        else
            return false;

        return $row;
    }
}