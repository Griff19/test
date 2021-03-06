<?php
/**
 * @var $user User
 */

if (array_key_exists('user', $GLOBALS)) {
    $user = unserialize($GLOBALS['user']);
    unset($GLOBALS['user']);
}
?>
<div>
<h2><?= Voca::t('FILL_OUT_FORM')?></h2>
<form enctype="multipart/form-data" action="<?= Site::$root?>/user/newUser" method="post"
      onsubmit="return validForm();">
    <label for="login"> * <?= Voca::t('USR_LOGIN')?>: </label><br/>
    <input id="login" name="login" type="text" value="<?= isset($user) ? $user->login : '' ?>" size="20" maxlength="255"
        onblur="validLogin()">
    <div id="err_log" class="error"></div>
    <br/>
    <label for="password"> * <?= Voca::t('USR_PASS')?>: </label><br/>
    <input id="password" name="password" type="password" size="20" maxlength="255" onblur="validPass1()">
    <div id="err_pass1" class="error"></div>
    <br/>
    <label for="password2"> * <?= Voca::t('CONFIRM_PASS')?>: </label><br/>
    <input id="password2" name="password2" type="password" size="20" maxlength="255" onblur="validPass2()">
    <div id="err_pass" class="error"></div>
    <br/>

    <label for="snp"> * <?= Voca::t('FULL_NAME')?>:</label><br/>
    <input id="snp" name="snp" type="text" value="<?= isset($user) ? $user->snp : '' ?>" size="40" maxlength="255"
           onblur="validSnp(this.value)"><br/>
    <div id="err_snp" class="error"></div>
    <br/>
    <label for="email"> Email: </label><br/>
    <input id="email" name="email" type="text" value="<?= isset($user) ? $user->email : '' ?>" size="40" maxlength="255"
        onblur="validEmail()">
    <div id="err_email" class="error"></div>
    <br/>

    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
    <label for="user_file"><?= Voca::t('ADD_IMAGE')?>:</label><br/>
    <input id="user_file" name="user_file" type="file" accept="image/jpeg,image/gif,image/png"/><br/><br/>
    <label for="memo"><?= Voca::t('ABOUT_YOUSELF')?>:</label><br/>

    <textarea id="memo" name="memo" rows="3" cols="40"></textarea>
    <div id="err_memo" class="error"></div>
    <br/>
    <input type="submit" value="<?= Voca::t('SAVE')?>">
</form>
    <br/>
    <?= Voca::t('FIELDS_STARS')?>
</div>

<script>
    function validLogin() {
        let loginVal = login.value;
        let patt = /^[a-z0-9_-]+$/i;
        if (loginVal === "") {
            err_log.innerHTML = '<?= Voca::t('FILL_FIELD_LOGIN')?>';
            return false;
        } else if (!patt.test(loginVal)) {
            err_log.innerHTML = '<?= Voca::t('LOGIN_INVALID')?>';
            return false;
        } else {
            $.post('<?= Site::$root ?>/site/validlogin', {login: loginVal}, function(r){
                let obj = JSON.parse(r);
                if (obj.res === false) {
                    err_log.innerHTML = loginVal + ' <?= Voca::t('NAME_USED')?>';
                    return false;
                }
            })
        }
        err_log.innerHTML = "";
        return true;
    }

    function validPass1() {
        let passVal = password.value;
        if (passVal === "") {
            err_pass1.innerHTML = "<?= Voca::t('ENTER_PASS')?>";
            return false;
        } else {
            let patt = /^[a-z0-9_-]{6,}$/;
            if (!patt.test(passVal)) {
                err_pass1.innerHTML = "<?= Voca::t('PASS_TO_EASY')?>";
                return false;
            }
        }
        err_pass1.innerHTML = "";
        return true;
    }

    function validPass2() {
        let pass1 = password.value;
        let pass2 = password2.value;

        if (pass1 !== "" )
            if (pass1 !== pass2) {
                err_pass.innerHTML = "<?= Voca::t('CONFIRM_PASS_MATCH_PASS')?>";
                return false;
            }
        err_pass.innerHTML = "";
        return true;
    }

    function validEmail() {
        let emailVal = email.value;
        let patt = /^[-._a-z0-9]+@(?:[a-z0-9][-a-z0-9]+\.)+[a-z]{2,6}$/;

        if (!patt.test(emailVal) && emailVal !== "") {
            err_email.innerHTML = '<?= Voca::t('INVALID_EMAIL')?>';
            return false;
        }
        err_email.innerHTML = "";
        return true;
    }

    function validSnp() {
        let snpVal = snp.value;
        let pattern1 = /^[а-яёa-z ]+$/i;

        if (snpVal === "") {
            err_snp.innerHTML = "<?= Voca::t('FILL_SNP')?>";
            return false;
        } else if (!pattern1.test(snpVal) && snpVal !== "") {
            err_snp.innerHTML = "<?= Voca::t('CONTAIN_ONLY_LETTERS')?>";
            return false;
        }
        err_snp.innerHTML = "";
        return true;
    }

//    function validMemo() {
//        var memo = document.getElementById('memo').value;
//
//        if (memo != "") {
//            var patt = /^[а-яёa-z0-9_ -.,]$/;
//
//            if (!patt.test(memo)) {
//                document.getElementById('err_memo').innerHTML = "Поле должно содержать только буквы цифры и пробелы";
//                return false;
//            }
//        }
//        document.getElementById('err_memo').innerHTML = "";
//        return true;
//    }

    function validForm() {
        let no_error = true;

        if (!validLogin()) no_error = false;
        if (!validPass1()) no_error = false;
        if (!validPass2()) no_error = false;
        if (!validEmail()) no_error = false;
        if (!validSnp()) no_error = false;
        //if (!validMemo()) no_error = false;

        return no_error;
    }

</script>