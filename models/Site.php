<?php

/**
 * Class Site
 * По сути выполняет роль контроллера
 */
class Site
{
    public static $root;

    /**
     *
     */
    public static function header()
    {
        include_once __DIR__ . '/../views/header.php';
    }

    /**
     *
     */
    public static function footer()
    {
        include_once __DIR__ . '/../views/footer.php';
    }

    /**
     *
     */
    public static function index()
    {
        include_once __DIR__ . '/../views/index.php';
    }

    /**
     * Авторизация пользователя.
     * Уже авторизованного пользователя просто отправляем в index
     */
    public static function login()
    {
        if ( empty($_SESSION['login']) or empty($_SESSION['id']) ) {
            include_once __DIR__ . '/../views/login.php';
        } else {
            header('Location: '. Site::$root .'/site/index');
        }
    }

    public static function logout()
    {
        User::logout();
        header('Location: '. Site::$root .'/site/index');
    }

    /**
     * Вход в профиль. Если Сессия не содержит данных о пользователе то предлагаем
     * пройти авторизацию
     */
    public static function profile()
    {
        if ( empty($_SESSION['login']) or empty($_SESSION['id']) ) {
            header('Location: ' . Site::$root . '/site/login');
        }
        else {
            $user = new User();
            $user->find($_SESSION['id']);

            include_once __DIR__ . '/../views/profile.php';
        }
    }

    /**
     *
     */
    public static function signup()
    {
        include_once __DIR__ . '/../views/signup.php';
    }

    /**
     * @param string $error
     * @param string $message
     */
    public static function error($error = '', $message = '')
    {
        if (empty($error)) {
            $error = Voca::t('PAGE_404');
        }
        include_once __DIR__ . '/../views/error.php';
    }

    /**
     * @param $target
     */
    public static function setlang($target)
    {
        Voca::setLang();
        header('Location: '. Site::$root .'/site/' . $target);
    }
}
$config = require __DIR__ . '/../config/local.php';
Site::$root = $config['site']['root'];