<?php

/**
 * Class User
 * Основная модель работы с пользователем
 */
class User
{
    public $id;
    public $user_token;
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
        if ($db->errors){
            header('Location: '. Site::$root .'/site/error?error='. Voca::t('SR_ERROR'). '&message=' . Voca::t('DB_ERROR'));
            //header('Refresh: 0; '. Site::$root .'/site/error?error='. Voca::t('SR_ERROR'). '&message=' . Voca::t('DB_ERROR'));
            //Site::error(Voca::t('SR_ERROR'), Voca::t('DB_ERROR'));
            //return false;
        }
        $rows = $db->select('id, login', "login = '". $this->login ."'");
        if ($rows)
            return false;
        else
            return true;
    }
    /**
     * Проверяем введенные данные
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
            $str_err .= Voca::t('ENTER_PASS').'<br/>';
        else {
            $password = $this->password;
            //if (!preg_match('/^[a-z0-9_-]{6,}$/', $password))
            //    $str_err .= Voca::t('PASS_TO_EASY'). ' <br/>';
        }

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
            $reg = '/^[^0-9]+$/i';
            if (!preg_match($reg, $this->snp))
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
     * @return bool
     */
    public static function login($login, $password)
    {

        $db = new Db();
        if ($db->errors){
            Site::error(Voca::t('SR_ERROR'), Voca::t('DB_ERROR'));
            return false;
        }
        $user = $db->validUser($login, md5($password));
        if ($user) {
            $_SESSION['login'] = $user['login'];
            $_SESSION['id'] = $user['user_token'];
            header('Location: '. Site::$root .'/site/profile');
        }
        else {
            Alert::setFlash('error', '<span style="color: darkred">'. Voca::t('ACCESS_DENI') .'</span>');
            header('Location: '. Site::$root .'/site/login');
        }
    }

    /**
     * Выход
     */
    public static function logout()
    {

        session_destroy();
        //header('Location: '. Site::$root .'/site/index');
    }

    /**
     * Загрузка картинки
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
     * Обработка данных формы регистрации view\signup.php
     */
    public function newUser()
    {
        $user = new User();
        $user->login = $_POST['login'];
        $user->user_token = md5($user->login);
        $user->password = $_POST['password'];
        $user->password2 = $_POST['password2'];
        $user->email = $_POST['email'];
        $user->snp = $_POST['snp'];
        $user->memo = $_POST['memo'];

        if ($user->validate()) {
            $user->loadfile();
            if ($user->save()) {
                Alert::setFlash('success', '<span style="color: darkgreen">'. Voca::t('USER') . ' "' . $user->snp . '" ' .Voca::t('ADDED')). '</span>';
                header('Location: ' . Site::$root . '/site/login');
                return true;
            } else {
                Alert::setFlash('error', '<span style="color: darkred">'. Voca::t('DB_ERROR') . '</span>');
                unlink(Site::$root . '/' .$user->file);
            }
        }
        //Если валидация не прошла - возвращаемся в форму
        //чтобы введенные дынные не сбросились полностью - передаем объект
        $_SESSION['user'] = serialize($user);
        header('Location: '. Site::$root .'/site/signup');
    }

    /**
     * Сохраняем модель в базу
     * @return bool
     */
    public function save()
    {
        $this->password = md5($this->password);

        $db = new Db();
        if ($db->errors){
            Site::error(Voca::t('SR_ERROR'), Voca::t('DB_ERROR'));
            return false;
        }
        if ($db->insert($this))
            return true;


        return false;
    }

    /**
     * Ижем данные в базе для заполнения модели
     * @param $user_token
     */
    public function find($user_token)
    {
        $db = new Db();

        if ($row = $db->find($user_token)) {

            $this->login = $row['login'];
            $this->email = $row['email'];
            $this->snp = $row['snp'];
            $this->file = $row['link_file'];
            $this->memo = $row['memo'];
        }
    }
}