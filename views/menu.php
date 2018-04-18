<?php
/**
 * Файл основного меню.
 * И данные и представление пока "вперемешку" :(
 */
?>
<a href="<?= Site::$root?>/site/index">[ <?= Voca::t('LINK_HOME')?> ]</a>
<?php if(isset($_SESSION['login']) && isset($_SESSION['id'])) { ?>
	<a href="<?= Site::$root?>/site/logout">[ <?= Voca::t('LINK_EXIT')?> ]</a>
<?php } else { ?>
    <a href="<?= Site::$root?>/site/profile">[ <?= Voca::t('LINK_SIGN_IN')?> ]</a>
    <a href="<?= Site::$root?>/site/signup">[ <?= Voca::t('LINK_SIGN_UP')?> ]</a>
<?php } ?>

<a href="<?= Site::$root?>/site/setlang?target=<?= $route[Site::$func]?>">[<?= Voca::t('CH_LANGUAGE') ?>]</a>