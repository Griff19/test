<?php

?>

<h2> <?= Voca::t('ENTER_LOGIN_AND_PASSWORD')?> </h2>

<p><?= Voca::t('OR_YOU_CAN')?> <a href="/test/site/signup"><?= Voca::t('REGISTER')?></a> <?= Voca::t('IN_THE_SYSTEM')?></p>

<form action="/test/user/login" method="post">
    <label> <?= Voca::t('USR_LOGIN')?>: </label><br/>
    <input name="login" type="text" size="15" maxlength="15"><br/>
    <label> <?= Voca::t('USR_PASS')?>: </label><br/>
    <input name="password" type="password" size="15" maxlength="15"><br/><br/>
    <input type="submit" value="<?= Voca::t('SIGN_IN')?>"><br/><br/>
</form>



