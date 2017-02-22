Тестовое задание
================

Создать средствами PHP, MySQL, JavaScript форму входа/регистрации нового пользователя. В результате заполнения формы пользователь должен предоставить информацию о себе.

####Требования к проекту:
1. Форма должна быть выполнена способом, понятным пользователю, содержать необходимые инструкции, комментарии и т.п. (usability).
2. Должна быть возможность переключения языка интерфейса формы на другой язык.
3. Скрипт должен содержать средства верификации и валидации полей, а также защиту от некорректного ввода данных, спецсимволов, попыток взлома и т.п.
4. Валидация и верификация полей должна проводиться как на клиентской стороне (средствами JavaScript), так и на серверной стороне (средствами PHP).
5. Структура базы данных должна быть обоснованной.
6. Кроме введения текстовых данных пользователь при регистрации должен иметь возможность загрузить графический файл форматов gif, jpg, png.
7. После входа должен отображаться профайл зарегистрировавшегося пользователя.

Структура каталогов
-------------------

    css/        содержит таблицы стилей
    models/     содержит классы 
    views/      содержит представления
    
Основные требования
-------------------
Сервер должен поддерживать PHP 5.4.0

Инициализация
-------------
Перед началом работы необходимо запустить скрипт: 

    php init.php
для создания таблиц в БД и прочих подготовительных операций
    
Конфигурация
------------
Необходимо в переменной `Site::$root` указать имя корневого каталога проекта.

Для подключения к БД установите соответствующие значения переменных:

    Db->host
    Db->user
    Db->pass
    Db->base
