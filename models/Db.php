<?php

/**
 * Class Db
 * Класс работы с базой данных
 *
 * @property mysqli $connection
 */

class Db
{
    public $host = 'localhost';
    public $user = 'fr3121_test';
    public $pass = 'weih1234';
    public $base = 'fr3121_test';

    private $connection;

    /**
     * Db constructor.
     */
    function __construct()
    {
        try {
            $this->connect();
        } catch (Exception $e) {
            Site::error(Voca::t('SR_ERROR'), Voca::t('DB_ERROR'));
        }
    }

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