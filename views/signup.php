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
<h2><?= Voca::t('FILL_OUT_FORM')?></h2>
<form enctype="multipart/form-data" action="<?= Site::$root?>/user/newUser" method="post"
      onsubmit="return validForm();">
    <label for="login"> <?= Voca::t('USR_LOGIN')?>: </label><br/>
    <input id="login" name="login" type="text" value="<?= isset($user) ? $user->login : '' ?>" size="20" maxlength="255">
    <div id="err_log" style="color: darkred"></div>
    <br/>
    <label for="password"> <?= Voca::t('USR_PASS')?>: </label><br/>
    <input id="password" name="password" type="password" size="20" maxlength="255" onchange="validPassword(1)" onselect="validPassword(1)">
    <br/>
    <label for="password2"> <?= Voca::t('CONFIRM_PASS')?>: </label><br/>
    <input id="password2" name="password2" type="password" size="20" maxlength="255" onchange="validPassword(2)">
    <div id="err_pass" style="color: darkred"></div>
    <br/>
    <br/>
    <label for="email"> Email: </label><br/>
    <input id="email" name="email" type="text" value="<?= isset($user) ? $user->email : '' ?>" size="40" maxlength="255">
    <br/>
    <label for="snp"><?= Voca::t('FULL_NAME')?>:</label><br/>
    <input id="snp" name="snp" type="text" value="<?= isset($user) ? $user->snp : '' ?>" size="40" maxlength="255" onchange="validSnp(this.value)"><br/>
    <div id="err_snp" style="color: darkred"></div>
    <br/>
    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
    <label for="user_file"><?= Voca::t('ADD_IMAGE')?>:</label><br/>
    <input id="user_file" name="user_file" type="file" accept="image/jpeg,image/gif,image/png"/><br/><br/>
    <label for="memo"><?= Voca::t('ABOUT_YOUSELF')?>:</label><br/>
    <textarea id="memo" name="memo" rows="3"></textarea>
    <br/>
    <br/>
    <input type="submit" value="<?= Voca::t('SAVE')?>"><br/>
</form>
</div>

<script>
    function validPassword(p) {

        var pass1 = document.getElementById('password').value;
        var pass2 = document.getElementById('password2').value;

        if (pass1 == "") {
            document.getElementById('err_pass').innerHTML = "<?= Voca::t('ENTER_PASS')?>";
            return false;
        }
        if ((pass1 != "" && p == 2) || (p == 1 && pass2 != ""))
            if (pass1 != pass2) {
                document.getElementById('err_pass').innerHTML = "<?= Voca::t('CONFIRM_PASS_MATCH_PASS')?>";
                return false;
            }
        document.getElementById('err_pass').innerHTML = "";
        return true;
    }

    function validSnp(value) {
        var pattern1 = /^[а-яёa-z ]+$/i;

        //alert(pattern.test(value));
        if (!pattern1.test(value) && value != "") {
            document.getElementById('err_snp').innerHTML = "<?= Voca::t('CONTAIN_ONLY_LETTERS')?>";
            return false;
        }
        document.getElementById('err_snp').innerHTML = "";
        return true;
    }

    function validForm() {
        var no_error = true;

        var login = document.getElementById('login').value;
        var pass1 = document.getElementById('password').value;
        var pass2 = document.getElementById('password2').value;

        if (login == "") {
            document.getElementById('err_log').innerHTML = '<?= Voca::t('FILL_FIELD_LOGIN')?>';
            no_error = false;
        }
        if (pass2 == "") {
            document.getElementById('err_pass').innerHTML = "<?= Voca::t('CONFIRM_PASS')?>";
            no_error = false;
        }
        if (pass1 == "") {
            document.getElementById('err_pass').innerHTML = "<?= Voca::t('ENTER_PASS')?>";
            no_error = false;
        }
        if (pass1 == "" && pass2 == "") {
            document.getElementById('err_pass').innerHTML = "<?= Voca::t('ENTER_PASS')?>. <?= Voca::t('CONFIRM_PASS')?>";
            no_error = false;
        }

        return no_error;
    }

</script>