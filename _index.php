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
if (!isset($route[1]) || !isset($route[2])) {
//if (!isset($route[2])) {
   header('Location: '. Site::$root. '/site/index');
}

Site::header();
Alert::getFlash();

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

Site::footer();