<?php

/**
 * Class Db
 * Класс работы с базой данных
 *
 * @property mysqli $connection
 */

class Db
{
    public $host;
    public $user;
    public $pass;
    public $base;
    public $port = '3306';

    public $errors;
    public $connection;


    /**
     * Db constructor.
     */
    function __construct()
    {
        $config = require (__DIR__ . '/../config/local.php');

        $this->host = $config['db']['host'];
        $this->user = $config['db']['user'];
        $this->pass = $config['db']['pass'];
        $this->base = $config['db']['base'];
        $this->port = $config['db']['port'];

        mysqli_report(MYSQLI_REPORT_STRICT);
        try {
            $connect = new mysqli($this->host, $this->user, $this->pass, $this->base, $this->port);
            $connect->set_charset("utf-8");
        } catch (Exception $e){
             $this->errors = $e;
        }
        $this->connection = $connect;
    }

    /**
     * @return mysqli
     * @throws Exception
     */
    public function connect(){

    }

    /**
     * Используется для проверки уникальности логина при вводе
     * @param $fields
     * @param $condition
     * @return array
     */
    public function select($fields, $condition)
    {
        $sql = "SELECT ". $fields ." FROM users WHERE " . $condition;
        $res = $this->connection->query($sql);
        if (!$res)
            return false;
        $arr = [];
        while ($row = $res->fetch_assoc()) {
            $arr[] = $row;
        }
        return $arr;
    }

    /**
     * Авторизация пользователя, проверка логина и пароля
     * @param $login
     * @param $password
     * @return array|bool
     */
    public function validUser($login, $password){
        $sql = "SELECT * FROM users WHERE login = ? AND pass = ?";

        $prepare = $this->connection->prepare($sql);
        if (!$prepare){
            return false;
        }

        $prepare->bind_param('ss', $login, $password);
        $prepare->execute();

        $res = $prepare->get_result();

        $row = $res->fetch_assoc();
        if ($row)
            return $row;
        else
            return false;
    }


    /**
     * Добавление нового пользователя - результат работы формы
     * @param $model User
     * @return bool
     */
    public function insert($model)
    {
        $sql = "INSERT INTO users (login, user_token, pass, email, snp, memo, link_file) VALUES (?, ?, ?, ?, ?, ?, ?);";
        /** @var mysqli_stmt $prepare */
        $prepare = $this->connection->prepare($sql);
        if (!$prepare)
            return false;
        $prepare->bind_param('sssssss', $model->login, $model->user_token, $model->password, $model->email, $model->snp, $model->memo, $model->file);
        $prepare->execute();
        if ($prepare->errno){
            echo print_r($prepare->error);
        }
        $prepare->close();
        $this->connection->close();

        return true;
    }

    /**
     * Поиск данных о пользователе для загрузки их в модель
     * @param $user_token
     * @return array
     */
    public function find($user_token)
    {
        $sql = "SELECT * FROM users WHERE user_token = ?";
        $prepare = $this->connection->prepare($sql);
        $prepare->bind_param('s', $user_token);
        $prepare->execute();
        $result = $prepare->get_result();

        $row = $result->fetch_assoc();
        return $row;
    }
}