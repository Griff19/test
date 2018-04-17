<?php
/**
 * @var $user User
 */

?>
<div>

<h3><?= Voca::t('PAGE_PROFILE')?> "<?= $user->snp?>" </h3>
<img width="200px" src="/<?= $user->file ?>">
<p>
    <?= Voca::t('YOUR_LOGIN')?>: <?= $user->login ?><br/>
    <?= Voca::t('YOUR_MAIL')?>: <?= $user->email ?><br/>
    <?= Voca::t('ADD_INFO')?>: <?= $user->memo ?><br/>
</p>
</div>
