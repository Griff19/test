<?php
/**
 * @var $user User
 */

if (array_key_exists('user', $_SESSION)) {
    $user = unserialize($_SESSION['user']);
    unset($_SESSION['user']);
}
?>
<div>
<h3> Страница профиля "<?= $user->snp?>" </h3>
<img width="200px" src="/test/<?= $user->file ?>">
<p>
    Ваш логин: <?= $user->login ?><br/>
    Ваш email: <?= $user->email ?><br/>
    Дополнительно: <?= $user->memo ?><br/>
</p>
</div>
