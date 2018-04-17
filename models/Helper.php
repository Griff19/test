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
	 *  {{className}} => 'true' - класс и его функции доступны для вызова
	 *  {{className}} => ['method' => 'POST|GET'] - класс и его функции доступны только через указанный метод
	 * ]
	 * @param $route
	 * @param $method
	 * @return bool
	 */
    public static function accessClass($route, $method)
    {
        $class = $route[0];

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
	
	/**
	 * Указываем какие методы могут работать через ajax
	 * @param $route
	 * @return bool
	 */
    public static function isAjax($route)
	{
		$isAjax = [
			'site' => ['validlogin']
		];
		
		if (array_key_exists($route[0], $isAjax)){
			if (in_array($route[1], $isAjax[$route[0]])) {
				return true;
			}
		}
		
		return false;
	}
}