<?php

/**
 * Class Site
 * По сути выполняет роль контроллера
 */
class Site
{
    public static $root = '/test';

    /**
     *
     */
    public function header()
    {
        include_once __DIR__ . '/../views/header.php';
    }

    /**
     *
     */
    public function footer()
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
     *
     */
    public static function login()
    {
        include_once __DIR__ . '/../views/login.php';
    }

    public function logout()
    {
        User::logout();
        header('Location: '. Site::$root .'/site/index');
    }

    /**
     *
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

    public static function error($error, $message)
    {
        include_once __DIR__ . '/../views/error.php';
    }

    /**
     * @param $target
     */
    public function setlang($target)
    {
        Voca::setLang();
        header('Location: '. Site::$root .'/site/' . $target);
    }
}