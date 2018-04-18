<?php

/**
 * Class Alert
 * Для вывода предупредительных сообщений
 */
class Alert
{
	
    public static function getFlash()
    {
        if (isset($_SESSION['error'])) {
            echo '<div class="alert-error">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
            echo '<div class="alert-success">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
        }
    }
	
	/**
	 * Задаем сообщение, которое будет выведено в области уведомлений
	 * @param $type string - тип сообщения error или success
	 * @param $message string - содержание сообщения
	 */
    public static function setFlash($type, $message)
    {
        $_SESSION[$type] = $message;
    }
}