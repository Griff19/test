<?php
$pars_url = parse_url(trim($_SERVER['REQUEST_URI'], '/'));
$route = explode('/', $pars_url['path']);
?>
<a href="<?= Site::$root?>/site/index">[ <?= Voca::t('LINK_HOME')?> ]</a>
<?php if(isset($_SESSION['login']) && isset($_SESSION['id'])) { ?>
	<a href="<?= Site::$root?>/site/logout">[ <?= Voca::t('LINK_EXIT')?> ]</a>
<?php } ?>
<a href="<?= Site::$root?>/site/setlang?target=<?= $route[Site::$func]?>">[<?= Voca::t('CH_LANGUAGE') ?>]</a>