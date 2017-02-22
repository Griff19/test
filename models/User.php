<?php

/**
 * Class User
 */
class User
{
    public $id;
    public $login;
    public $password;
    private $password2;
    public $email;
    public $snp;
    public $memo;

    public $file;

    public function validLogin()
    {
        $db = new Db();
        $db->connect();
        $rows = $db->select('id, login', "login = '". $this->login ."'");
        if ($rows)
            return false;
        else
            return true;
    }
    /**
     * @return bool
     */
    public function validate()
    {
        $str_err = '';

        if(empty($this->login)) {
            $str_err .= 'Заполните поле "Логин"<br/>';
        }
        else {
            if ($this->validLogin())
                $this->login = Helper::safetyStr($this->login);
            else
                $str_err .= 'Такой логин уже используется <br/>';
        }

        if(!empty($this->memo)) {
            $this->memo = Helper::safetyStr($this->memo);
        }

        if (empty($this->password))
            $str_err .= 'Введите пароль <br/>';
        else
            $password = $this->password;

        if (empty($this->password2))
            $str_err .= 'Подтвердите пароль <br/>';
        else
            $password2 = $this->password2;

        if ($password !== $password2)
            $str_err .= 'Подтверждение пароля должно совпадать с паролем <br/>';

        if (!empty($this->email)) {
            $this->email = Helper::safetyStr($this->email);
            if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
                $str_err .= 'Неверное значение "Email"<br/>';
        }

        if ($str_err !== '') {
            Alert::setFlash('error', '<span style="color: darkred">' . $str_err . '</span>');
            return false;
        }
        return true;
    }

    /**
     * @param $login
     * @param $password
     */
    public function login($login, $password)
    {
        $db = new Db();
        $db->connect();
        $user = $db->validUser($login, md5($password));
        if ($user) {
            $_SESSION['login'] = $user['login'];
            $_SESSION['id'] = $user['id'];
            header('Location: /test/site/profile');
        }
        else {
            Alert::setFlash('error', '<span style="color: darkred">Вход не выполнен...</span>');
            header('Location: /test/site/login');
        }
    }

    /**
     *
     */
    public static function logout()
    {
        session_destroy();
        header('Location: /test/site/index');
    }

    /**
     * @return bool|string
     */
    public function loadfile()
    {
        if ($_FILES['user_file']['size'] <= 0)
            return true;

        $uploaddir = __DIR__ .'/../img/';
        $uploadfile = $uploaddir . md5(basename($_FILES['user_file']['name']));

        if (move_uploaded_file($_FILES['user_file']['tmp_name'], $uploadfile)) {
            Alert::setFlash('success', 'Файл был успешно загружен.');
            $this->file = $uploadfile;
            return $uploadfile;
        } else {
            Alert::setFlash('error', 'Ошибка загрузки файла');
            return false;
        }
    }
    /**
     * Регистрация нового пользователя
     */
    public function newUser()
    {
        $user = new User();
        $user->login = $_POST['login'];
        $user->password = $_POST['password'];
        $user->password2 = $_POST['password2'];
        $user->email = $_POST['email'];
        $user->snp = $_POST['snp'];
        $user->memo = $_POST['memo'];
        $user->loadfile();

        if ($user->validate())
            if ($user->save()) {
                Alert::setFlash('success', '<span style="color: darkgreen">Пользователь ' . $user->snp . ' успешно добавлен</span>');
                return header('Location: /test/site/login');
            }
        $_SESSION['user'] = serialize($user);
        return header('Location: /test/site/signup');
    }

    /**
     * @return bool
     */
    public function save()
    {
        $db = new Db();
        if ($db->connect())
            if ($db->insert('login, pass, email, snp, memo, link_file',
                "'" . $this->login . "'," .
                "'" . md5($this->password) . "'," .
                "'" . $this->email . "'," .
                "'" . $this->snp . "'," .
                "'" . $this->memo . "'," .
                "'" . $this->file . "'"
                ))
                return true;
        return false;
    }

    /**
     * @param $id
     */
    public function find($id)
    {
        $db = new Db();
        if ($db->connect())
            if ($row = $db->find($id)) {

                $this->login = $row['login'];
                $this->email = $row['email'];
                $this->snp = $row['snp'];
                $this->file = $row['link_file'];
                $this->memo = $row['memo'];

            }
    }

}