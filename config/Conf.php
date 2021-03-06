<?php
class Conf {

    static private $databases = array(
        'hostname' => 'localhost',
        'database' => 'ic_eval',
        'login' => 'ic_eval',
        'password' => 'P@ssW0rd'
    );

    static private $link = "ic-eval.local";

    static public function getLogin() {
        return self::$databases['login'];
    }

    static public function getHostname() {
        return self::$databases['hostname'];
    }

    static public function getDatabase() {
        return self::$databases['database'];
    }

    static public function getPassword() {
        return self::$databases['password'];
    }

    static public function getLink() {
        return self::$link;
    }

    static private $debug = true;

    static public function getDebug() {
        return self::$debug;
    }
}
?>
