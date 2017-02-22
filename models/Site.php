<?php

class Site
{

    public function header()
    {

        include_once __DIR__ . '/../views/header.php';
    }

    public function footer()
    {
        include_once __DIR__ . '/../views/footer.php';
    }

    public function index()
    {
        //return require_once __DIR__ . '/../views/index.php';
        include_once __DIR__ . '/../views/index.php';
    }

    public function login()
    {
        include_once __DIR__ . '/../views/login.php';
    }

    public function profile()
    {
        if ( empty($_SESSION['login']) or empty($_SESSION['id'])) {
            header('Location: /test/site/login');
        }
        else {
            $user = new User();
            $user->find($_SESSION['id']);
            $_SESSION['user'] = serialize($user);

            include_once __DIR__ . '/../views/profile.php';
        }
    }

    public function signup()
    {

        include_once __DIR__ . '/../views/signup.php';
    }

    public function setlang($target)
    {
        Voca::setLang();
        header('Location: /test/site/' . $target);
    }
}