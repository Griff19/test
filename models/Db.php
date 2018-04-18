<?php

/**
 * Class Db
 * Класс работы с базой данных
 *
 * @property PDO $connection
 * @property checkLogin
 */

class Db
{
    public $host;
    public $user;
    public $pass;
    public $base;
    
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
        
        try {
            $connect = new PDO('mysql:host='.$this->host.';dbname='.$this->base, $this->user, $this->pass);
            $this->connection = $connect;
        } catch (Exception $e){
             $this->errors = $e->getMessage();
        }

    }
	
	/**
	 * Используется для проверки уникальности логина при вводе в форме регистрации
	 * @param $login
	 * @return bool
	 */
    public function checkLogin($login)
    {
        $sql = "SELECT id FROM users WHERE login = :login";
        
		$prepare = $this->connection->prepare($sql);
		if (!$prepare) return false;
		
		$prepare->execute(['login' => $login]);
	
		$res = $prepare->fetch(PDO::FETCH_LAZY);
		
		if ($res) return true;
		else return false;
    }

    /**
     * Авторизация пользователя, проверка логина и пароля
     * @param $login
     * @param $password
     * @return array|bool
     */
    public function validUser($login, $password){
        
        $sql = "SELECT * FROM users WHERE login = :login AND pass = :pass";

        $prepare = $this->connection->prepare($sql);
        if (!$prepare){
            return false;
        }

        $prepare->execute(['login' => $login, 'pass' => $password]);

        $res = $prepare->fetch(PDO::FETCH_LAZY);

        if ($res)
            return $res;
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

        $prepare = $this->connection->prepare($sql);
        if (!$prepare) return false;
        $prepare->execute([$model->login, $model->user_token, $model->password, $model->email,
            $model->snp, $model->memo, $model->file]);
        if ($prepare->errorCode()){
            echo print_r($prepare->errorInfo());
        }
        $prepare = null;

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

        $prepare->execute([$user_token]);
        $result = $prepare->fetch(PDO::FETCH_LAZY);

        return $result;
    }
}