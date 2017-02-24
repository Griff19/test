<?php

/**
 * Class Helper
 * Вспомогательный класс
 */
class Helper
{
    /**
     * "Безопасная" строка
     * @param $str
     * @return string
     */
    public static function safetyStr($str)
    {
        $s = trim($str);
        $s = strip_tags($s);
        $s = htmlspecialchars($s, ENT_QUOTES);
        $s = stripslashes($s);
        return $s;
    }

    /**
     * Определяем можно ли обращаться к классу через url
     * [
     *  'className' => 'true' - класс и его функции доступны для вызова
     *  'className' => ['method' => 'POST|GET'] - класс и его функции доступны только через указанный метод
     * ]
     *
     * @return bool
     */
    public static function accessClass($class, $method)
    {
        $classes = [
            'site' => 'true',
            'user' => ['method' => 'POST'],
        ];

        if (array_key_exists($class, $classes)) {
            if ($classes[$class] == 'true')
                return true;
            else
                if (array_key_exists('method', $classes[$class])) {
                    if ($classes[$class]['method'] == $method)
                        return true;
                } else {
                    return false;
                }
        } else {
            return false;
        }
        return false;
    }
}