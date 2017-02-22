<?php

class Voca
{

    public static function arrayEn()
    {
        return [
            'TITLE_TEST' => 'Test Task',
            'LINK_HOME' => 'Home',
            'LINK_EXIT' => 'Exit',
            'CH_LANGUAGE' => 'Change language',
            'HOME_PAGE' => 'Home Page',
            'SIGN_IN' => 'Sign in',
            'ENTER_LOGIN_AND_PASSWORD' => 'Enter login and password',
            'REGISTER' => 'Register',
            'OR_YOU_CAN' => 'Or You can',
            'IN_THE_SYSTEM' => 'in the system',
            'USR_LOGIN' => 'Login',
            'USR_PASS' => 'Password',
            'CONFIRM_PASS' => 'Enter the password again'
        ];
    }

    /**
     * @return array
     */
    public static function arrayRu()
    {
        return [
            'TITLE_TEST' => 'Тестовое Задание',
            'LINK_HOME' => 'Домой',
            'LINK_EXIT' => 'Выйти',
            'CH_LANGUAGE' => 'Сменить язык',
            'HOME_PAGE' => 'Начальная страница',
            'SIGN_IN' => 'Войти в профиль',
            'ENTER_LOGIN_AND_PASSWORD' => 'Введите логин и пароль',
            'REGISTER' => 'Зарегистрироваться',
            'OR_YOU_CAN' => 'Или Вы можете',
            'IN_THE_SYSTEM' => 'в системе',
            'USR_LOGIN' => 'Логин',
            'USR_PASS' => 'Пароль',
            'CONFIRM_PASS' => 'Введите пароль еще раз'

        ];
    }

    /**
     * @param $cons
     * @return mixed
     */
    public static function t($cons)
    {
        if ($_SESSION['lang'] == 'ru')
            return self::arrayRu()[$cons];
        else
            return self::arrayEn()[$cons];;
    }

    public static function getLang()
    {
        return $_SESSION['lang'];
    }
    /**
     *
     */
    public static function setLang()
    {
        if ($_SESSION['lang'] == 'en'){
            $_SESSION['lang'] = 'ru';
            return true;
        }

        if ($_SESSION['lang'] == 'ru'){
            $_SESSION['lang'] = 'en';
            return true;
        }

    }
}




