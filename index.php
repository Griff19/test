<?php

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

$pars_url = parse_url(trim($_SERVER['REQUEST_URI'], '/'));
$route = explode('/', $pars_url['path']);
//var_dump($route); die;
if (!isset($route[Site::$class]) || !isset($route[Site::$func])) {
//if (!isset($route[2])) {
   header('Location: '. Site::$root. '/site/index');
}

if (Helper::isAjax($route)) {
	Site::content($route, $params);
} else
	require_once __DIR__ . Site::$root . Site::$template . '/index.php';