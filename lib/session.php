<?php
class Session {

    public static function is_connected() {
        return (isset($_SESSION['login']) && !empty($_SESSION['login']));
    }

    public static function is_user($login) {
        return (!empty($_SESSION['login']) && ($_SESSION['login'] == $login));
    }
}