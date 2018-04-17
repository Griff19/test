<?php
/**
 * Точка входа. Тут обрабатываются все входящие запросы
 */
session_start();

require_once __DIR__ . '/models/Site.php';
require_once __DIR__ . '/models/Db.php';
require_once __DIR__ . '/models/User.php';
require_once __DIR__ . '/models/Alert.php';
require_once __DIR__ . '/models/Helper.php';
require_once __DIR__ . '/models/Voca.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $params = $_POST;
} else {
    $params = $_GET;
}

/** Разбираем строку URL для вычленения Класса и Метода */
$pars_url = parse_url(trim($_SERVER['REQUEST_URI'], '/'));
$route = explode('/', $pars_url['path']);

if (!isset($route[Site::$class]) || !isset($route[Site::$func])) {
   header('Location: '. Site::$root. '/site/index');
}

/** Определяем нужно ли выводить шаблон */
if (Helper::isAjax($route)) {
	Site::content($route, $params);
} else
	require_once __DIR__ . Site::$template . '/index.php';