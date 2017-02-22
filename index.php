<?php

session_start();

require_once __DIR__ . '/models/Site.php';
require_once __DIR__ . '/models/ParseUrl.php';
require_once __DIR__ . '/models/User.php';
require_once __DIR__ . '/models/Db.php';
require_once __DIR__ . '/models/Alert.php';
require_once __DIR__ . '/models/Helper.php';
require_once __DIR__ . '/models/Voca.php';


$array_query = ParseUrl::urlKeyValue(trim($_SERVER['REQUEST_URI'], '/'));
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $params = $_POST;
} else {
    $params = $_GET;
}

$pars_url = parse_url(trim($_SERVER['REQUEST_URI'], '/'));
$route = explode('/', $pars_url['path']);

if (Helper::accessClass($route[1], $_SERVER['REQUEST_METHOD'])) {

    Site::header();
    Alert::getFlash();
    if ($params) {
        call_user_func_array([$route[1], $route[2]], $params);
    } else {
        call_user_func([$route[1], $route[2]]);
    }
    Site::footer();
} else
    header('Location: ' . Site::$root . '/site/_404');