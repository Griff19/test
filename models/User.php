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

    /**
     * Проверяем уникальность логина
     * @return bool
     */
    public function validLogin()
    {
        $db = new Db();
        //$this->connect();
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
            $str_err .= Voca::t('FILL_FIELD_LOGIN'). '<br/>';
        }
        else {
            if ($this->validLogin())
                $this->login = Helper::safetyStr($this->login);
            else
                $str_err .= Voca::t('LOGIN_EXIST'). '<br/>';
        }

        if(!empty($this->memo)) {
            $this->memo = Helper::safetyStr($this->memo);
        }

        if (empty($this->password))
            $str_err .= 'Введите пароль <br/>';
        else
            $password = $this->password;

        if (empty($this->password2))
            $str_err .= Voca::t('CONFIRM_PASS'). '<br/>';
        else
            $password2 = $this->password2;

        if ($password !== $password2)
            $str_err .= Voca::t('CONFIRM_PASS_MATCH_PASS'). ' <br/>';

        if (!empty($this->email)) {
            $this->email = Helper::safetyStr($this->email);
            if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
                $str_err .= Voca::t('INVALID_EMAIL'). '<br/>';
        }

        if (!empty($this->snp)) {
            $this->snp = Helper::safetyStr($this->snp);
            if (!preg_match('/^[а-яёa-z ]+$/i', $this->snp))
                $str_err .= Voca::t('CONTAIN_ONLY_LETTERS'). '<br/>';
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
        $user = $db->validUser($login, md5($password));
        if ($user) {
            $_SESSION['login'] = $user['login'];
            $_SESSION['id'] = $user['id'];
            header('Location: '. Site::$root .'/site/profile');
        }
        else {
            Alert::setFlash('error', '<span style="color: darkred">'. Voca::t('ACCESS_DENI') .'</span>');
            header('Location: '. Site::$root .'/site/login');
        }
    }

    /**
     *
     */
    public static function logout()
    {
        session_destroy();
        //header('Location: '. Site::$root .'/site/index');
    }

    /**
     * @return bool|string
     */
    public function loadfile()
    {
        if ($_FILES['user_file']['size'] <= 0)
            return true;

        $upload_dir = __DIR__ .'/../img/';
        $file_name = md5(basename($_FILES['user_file']['name']));
        $upload_file = $upload_dir . $file_name;

        if (move_uploaded_file($_FILES['user_file']['tmp_name'], $upload_file)) {
            Alert::setFlash('success', 'Файл был успешно загружен.');
            $this->file = 'img/'. $file_name;
            return $this->file;
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

        if ($user->validate()) {
            $user->loadfile();
            if ($user->save()) {
                Alert::setFlash('success', '<span style="color: darkgreen">'. Voca::t('USER') . '"' . $user->snp . '"' .Voca::t('ADDED'));
                return header('Location: ' . Site::$root . '/site/login');
            } else {
                unlink(Site::$root . '/' .$user->file);
            }
        }
        //Если валидация не прошла - возвращаемся в форму
        $_SESSION['user'] = serialize($user);
        return header('Location: '. Site::$root .'/site/signup');
    }

    /**
     * @return bool
     */
    public function save()
    {
        $this->password = md5($this->password);

        $db = new Db();
        if ($db->connect())
            if ($db->insert($this))
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