<?php

/**
 * Class Voca
 * Для перевода текстов сайта
 */
class Voca
{
    /**
	 * Хранит и предоставляет строки на английском языке
     * @return array
     */
    public static function arrayEn()
    {
        return [
        	'LANG' => 'en',
			'NAME_USED' => 'is already used',
            'TITLE_TEST' => 'Test Task',
            'LINK_HOME' => 'Home',
            'LINK_EXIT' => 'Exit',
			'LINK_SIGN_IN' => 'Sign in',
			'LINK_SIGN_UP' => 'Sign up',
            'CH_LANGUAGE' => 'Сменить язык',
            'HOME_PAGE' => 'Home Page',
            'SIGN_IN' => 'Log in to the profile',
            'ENTER_LOGIN_AND_PASSWORD' => 'Enter login and password',
            'REGISTER' => 'Register',
            'OR_YOU_CAN' => 'Or You can',
            'IN_THE_SYSTEM' => 'in the system',
            'USR_LOGIN' => 'Login',
            'USR_PASS' => 'Password',
            'CONFIRM_PASS' => 'Confirm the password',
            'FILL_OUT_FORM' => "For the registration in the system<br/>please fill out the form:",
            'FULL_NAME' => 'Full Name',
            'ADD_IMAGE' => 'Add an image',
            'ABOUT_YOUSELF' => 'Add something about yourself',
            'SAVE' => 'Submit',
            'FILL_FIELD_LOGIN' => 'Fill in the "Login"',
            'LOGIN_EXIST' => 'This login already exists',
            'PAGE_PROFILE' => 'Profile Page',
            'YOUR_LOGIN' => 'Your Login',
            'YOUR_MAIL' => 'Your email',
            'ADD_INFO' => 'Additional Information',
            'ACCESS_DENI' => 'Wrong Login or Password',
            'CONFIRM_PASS_MATCH_PASS' => 'Confirm password must match the password',
            'CONTAIN_ONLY_LETTERS' => 'Full Name must contain only letters',
            'INVALID_EMAIL' => 'Invalid "Email"',
            'ENTER_PASS' => 'Enter password',
            'PAGE_404' => '404 The requested page is not found',
            'USER' => 'User',
            'ADDED' => 'added successfully.<br/>Use your username and password to access the profile.',
            'SR_ERROR' => '503 Server error',
            'DB_ERROR' => 'Error connecting to database. Contact your administrator.',
            'PASS_TO_EASY' => 'The password is too simple, it is recommended to complicate it...',
            'LOGIN_INVALID' => 'Invalid Login',
            'FILL_SNP' => 'Please enter your full name',
            'FOR_LOOK_INFORMATION' => 'To view the information You need',
			'SIGN_UP' => 'to be Registered.',
			'WELCOME' => 'If you already have a Login and Password then',
			'FILE_LOAD' => 'File successfully uploaded!',
			'FILE_ERROR' => 'Error loading file!',
			'LOGIN_AS' => 'You are authorized as',
			'FIELDS_STARS' => '* - mandatory fields.'
        ];
    }

    /**
	 * Хранит и предоставляет строки на русском языке
     * @return array
     */
    public static function arrayRu()
    {
        return [
			'LANG' => 'ru',
        	'NAME_USED' => 'уже используется',
            'TITLE_TEST' => 'Тестовое Задание',
            'LINK_HOME' => 'Домой',
            'LINK_EXIT' => 'Выйти',
			'LINK_SIGN_IN' => 'Войти',
			'LINK_SIGN_UP' => 'Регистрация',
            'CH_LANGUAGE' => 'Change language',
            'HOME_PAGE' => 'Начальная страница',
            'SIGN_IN' => 'войти в Профиль',
            'ENTER_LOGIN_AND_PASSWORD' => 'Введите логин и пароль',
            'REGISTER' => 'Зарегистрируйтесь',
            'OR_YOU_CAN' => 'Или',
            'IN_THE_SYSTEM' => 'в системе',
            'USR_LOGIN' => 'Логин',
            'USR_PASS' => 'Пароль',
            'CONFIRM_PASS' => 'Подтвердите пароль',
            'FILL_OUT_FORM' => "Для регистрации в системе<br/>пожалуйста заполните форму:",
            'FULL_NAME' => 'Фамиля Имя Отчество',
            'ADD_IMAGE' => 'Добавьте изображение',
            'ABOUT_YOUSELF' => 'Добавьте что-нибудь о себе',
            'SAVE' => 'Сохранить',
            'FILL_FIELD_LOGIN' => 'Заполните поле "Логин"',
            'LOGIN_EXIST' => 'Такой логин уже существует',
            'PAGE_PROFILE' => 'Страница профиля',
            'YOUR_LOGIN' => 'Ваш Логин',
            'YOUR_MAIL' => 'Ваш email',
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
			'SIGN_UP' => 'пройти Регистрацию.',
			'WELCOME' => 'Если у Вас уже есть Логин и Пароль тогда Вы можете',
			'FILE_LOAD' => 'Файл успешно загружен!',
			'FILE_ERROR' => 'Ошибка загрузки файла!',
			'LOGIN_AS' => 'Вы авторизованы как',
			'FIELDS_STARS' => '* - поля, обязательные к заполнению.'
        ];
    }

    /**
     * Выводим надписи на нужном языке. Текущий язык хранится в сессии.
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
