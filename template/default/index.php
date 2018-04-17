<?php
/**
 * @var $params [] массив с параметрами POST/GET
 */
?>
<!DOCTYPE html>
<html lang="ru-Ru">
<head>
	<?php //Site::header() ?>
    <link rel="stylesheet" href="<?= Site::$root?><?= Site::$template ?>/style.css">
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <link rel="icon" type="image/png" href="<?= Site::$root?>/favicon.ico" />
	<meta charset="utf-8">
	<title><?= Voca::t('TITLE_TEST')?></title>
</head>
<body>

	<div class="container header">
		<h1 class="title"><?= Voca::t('TITLE_TEST')?></h1>
	</div>
	<div class="container menu">
		<?php Site::menu(); ?>
	</div>
	
	<div class="container content">
	
	<?php
		Alert::getFlash();
        Site::content($route, $params);
	?>
	
	</div>
    <div class="container footer">
        <?php Site::footer()?>
    </div>

</body>
</html>