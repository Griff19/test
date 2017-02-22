<?php
$pars_url = parse_url(trim($_SERVER['REQUEST_URI'], '/'));
$route = explode('/', $pars_url['path']);
?>

<!DOCTYPE html>
<html lang="ru-Ru">
<head>
    <link rel="stylesheet" href="../css/main.css">
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <meta charset="utf-8">
    <title> Тестовое задание </title>

</head>
<body>

<div class="container" style="background-color: black; height: 50px">
    <h1 class="title" style="color: aliceblue;"><?= Voca::t('TITLE_TEST')?></h1>

</div>
<div class="container" style="background-color: aliceblue; height: 30px">
    <a href="<?= Site::$root?>/site/index">[ <?= Voca::t('LINK_HOME')?> ]</a>
    <?php if(isset($_SESSION['login']) && isset($_SESSION['id'])) { ?>
        <a href="<?= Site::$root?>/site/logout">[ <?= Voca::t('LINK_EXIT')?> ]</a>
    <?php } ?>
    <a href="<?= Site::$root?>/site/setlang?target=<?= $route[2]?>">[<?= Voca::t('CH_LANGUAGE') ?>]</a>
</div>

<div class="container">
