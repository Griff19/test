<?php

/**
 * Class Voca
 * Для перевода текстов сайта
 */
class Voca
{
    /**
     * @return array
     */
    public static function arrayEn()
    {
        return [
            'TITLE_TEST' => 'Test Task',
            'LINK_HOME' => 'Home',
            'LINK_EXIT' => 'Exit',
            'CH_LANGUAGE' => 'Сменить язык',
            'HOME_PAGE' => 'Home Page',
            'SIGN_IN' => 'Sign in',
            'ENTER_LOGIN_AND_PASSWORD' => 'Enter login and password',
            'REGISTER' => 'Register',
            'OR_YOU_CAN' => 'Or You can',
            'IN_THE_SYSTEM' => 'in the system',
            'USR_LOGIN' => 'Login',
            'USR_PASS' => 'Password',
            'CONFIRM_PASS' => 'Confirm the password',
            'FILL_OUT_FORM' => 'Please fill out the form',
            'FULL_NAME' => 'Full Name',
            'ADD_IMAGE' => 'Add an image',
            'ABOUT_YOUSELF' => 'Add something about yourself',
            'SAVE' => 'Submit',
            'FILL_FIELD_LOGIN' => 'Fill in the "Login"',
            'LOGIN_EXIST' => 'This login already exists',
            'PAGE_PROFILE' => 'Profile Page',
            'YOUR_LOGIN' => 'Your Login',
            'YOUR_PASS' => 'Your Password',
            'ADD_INFO' => 'Additional Information',
            'ACCESS_DENI' => 'Wrong Login or Password',
            'CONFIRM_PASS_MATCH_PASS' => 'Confirm password must match the password',
            'CONTAIN_ONLY_LETTERS' => 'Full Name must contain only letters',
            'INVALID_EMAIL' => 'Invalid "Email"',
            'ENTER_PASS' => 'Enter password',
            'PAGE_404' => '404 The requested page is not found',
            'USER' => 'User',
            'ADDED' => 'added successfully',
            'SR_ERROR' => '503 Server error',
            'DB_ERROR' => 'Error connecting to database. Contact your administrator.',
            'PASS_TO_EASY' => 'The password is too simple, it is recommended to complicate it...',
            'LOGIN_INVALID' => 'Invalid Login',
            'FILL_SNP' => 'Please enter your full name',
            'FOR_LOOK_INFORMATION' => 'To view the information You need',

        ];
    }

    /**
     * @return array
     */
    public static function arrayRu()
    {
        return [
            'TITLE_TEST' => 'Тестовое Задание',
            'LINK_HOME' => 'Домой',
            'LINK_EXIT' => 'Выйти',
            'CH_LANGUAGE' => 'Change language',
            'HOME_PAGE' => 'Начальная страница',
            'SIGN_IN' => 'Войти в профиль',
            'ENTER_LOGIN_AND_PASSWORD' => 'Введите логин и пароль',
            'REGISTER' => 'Зарегистрируйтесь',
            'OR_YOU_CAN' => 'Или',
            'IN_THE_SYSTEM' => 'в системе',
            'USR_LOGIN' => 'Логин',
            'USR_PASS' => 'Пароль',
            'CONFIRM_PASS' => 'Подтвердите пароль',
            'FILL_OUT_FORM' => 'Пожалуйста заполните форму',
            'FULL_NAME' => 'Фамиля Имя Отчество',
            'ADD_IMAGE' => 'Добавьте изображение',
            'ABOUT_YOUSELF' => 'Добавьте что-нибудь о себе',
            'SAVE' => 'Сохранить',
            'FILL_FIELD_LOGIN' => 'Заполните поле "Логин"',
            'LOGIN_EXIST' => 'Такой логин уже существует',
            'PAGE_PROFILE' => 'Страница профиля',
            'YOUR_LOGIN' => 'Ваш Логин',
            'YOUR_PASS' => 'Ваш Пароль',
            'ADD_INFO' => 'Дополнительно',
            'ACCESS_DENI' => 'Не правильный Логин или Пароль',
            'CONFIRM_PASS_MATCH_PASS' => 'Подтвержение пароля должно совпадать с паролем',
            'CONTAIN_ONLY_LETTERS' => 'ФИО должно содержать только буквы',
            'INVALID_EMAIL' => 'Не правильное значение "Email"',
            'ENTER_PASS' => 'Введите пароль',
            'PAGE_404' => '404 Запрашиваемая страница не найдена',
            'USER' => 'Пользователь',
            'ADDED' => 'успешно добавлен.<br/>Используйте свой логин и пароль чтобы войти в профиль.',
            'SR_ERROR' => '503 Ошибка сервера',
            'DB_ERROR' => 'Ошибка подключения к базе данных. Обратитесь к администратору.',
            'PASS_TO_EASY' => 'Пароль слишком простой, рекомендуем усложнить его...',
            'LOGIN_INVALID' => 'Логин содержит недопустимый символ',
            'FILL_SNP' => 'Пожалуйста укажите ваше полное имя',
            'FOR_LOOK_INFORMATION' => 'Для просмотра информации Вам необходимо',
        ];
    }

    /**
     * Выводим надписи на нужном языке
     * @param $cons
     * @return mixed
     */
    public static function t($cons)
    {
        if ($_SESSION['lang'] == 'ru')
            return self::arrayRu()[$cons];
        else
            return self::arrayEn()[$cons];
    }

    /**
     * @return mixed
     */
    public static function getLang()
    {
        return $_SESSION['lang'];
    }

    /**
     * Устанавливаем текущий язык
     */
    public static function setLang()
    {
        if ($_SESSION['lang'] == 'en'){
            $_SESSION['lang'] = 'ru';
            return true;
        }

        if ($_SESSION['lang'] == 'ru'){
            $_SESSION['lang'] = 'en';
            return true;
        }
        return false;
    }
}
//Первоначальная установка языка сразу после старта сессии
if (!array_key_exists('lang', $_SESSION))
    $_SESSION['lang'] = 'ru';
