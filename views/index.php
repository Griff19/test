<div>
    <h2> <?= Voca::t('HOME_PAGE')?> </h2>
    <?php if ( empty($_SESSION['login']) or empty($_SESSION['id']) ) { ?>
    <p>
        <?= Voca::t('FOR_LOOK_INFORMATION'). ' '?>
        <a href="<?= Site::$root?>/site/signup"><?= Voca::t('SIGN_UP')?></a>
    </p>
    <p>
        <?= Voca::t('WELCOME') . ' '?>
        <a href="<?= Site::$root?>/site/profile"><?= Voca::t('SIGN_IN')?></a>
    </p>
    <?php } else {
        $user = new User();
        $user->find($_SESSION['id']);
    ?>
    <p>
        <?= Voca::t('LOGIN_AS')?> "<?= $user->snp ?>"
        <a href="<?= Site::$root?>/site/profile"><?= Voca::t('SIGN_IN')?></a>
    </p>
    <?php } ?>
    
</div>
<br/>