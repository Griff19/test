<?php

/**
 * Class Site
 * По сути выполняет роль контроллера
 */
class Site
{
    public static $root;
    public static $ajax;
	
	/**
	 * @param $route
	 * @param $params
	 */
    public static function content($route, $params)
	{
		if (Helper::accessClass($route, $_SERVER['REQUEST_METHOD'])) {
			if ($params) {
				call_user_func_array([$route[1], $route[2]], $params);
			} else {
				call_user_func([$route[1], $route[2]]);
			}
		} else {
			$_SESSION['error_url'] = $_SERVER['REQUEST_URI'];
			Site::error(Voca::t('PAGE_404'), $_SERVER['REQUEST_URI']);
		}
	}
	
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
	 * Обращаемся к методу через ajax со страницы site/signup
	 * @param $login
	 */
    public static function validlogin($login)
	{
		$db = new Db();
		if ($db->checkLogin($login))
			$res = false;
		else
			$res = true;
		
		echo json_encode(['res' => $res]);
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
