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
            echo '<div style="background-color: lightcoral; width: 100%">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
            echo '<div style="background-color: aquamarine; width: 100%">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
        }
    }

    public static function setFlash($type, $message)
    {
        $_SESSION[$type] = $message;
    }
}