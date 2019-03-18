<?php
require_once(File::build_path(array('model', 'Model.php')));

class ModelClients extends Model{

    protected static $object = 'clients';
    protected static $primary='cli_login';

    private $cli_id;
    private $cli_login;
    private $cli_email;
    private $cli_ins;
    private $cli_cx;
    private $cli_pwd;
    private $cli_tknIns;
    private $cli_tknPwd;

    public function get($attribut) {
        return $this->$attribut;
    }

    public function set($attribut, $value) {
        $this->$attribut = $value;
    }

    public function __construct($cli_id = NULL, $cli_login = NULL, $cli_email = NULL, $cli_ins = NULL, $cli_cx = NULL, $cli_pwd = NULL, $cli_tknIns = NULL, $cli_tknPwd = NULL) {
        if (!is_null($cli_id) && !is_null($cli_login) && !is_null($cli_email) && !is_null($cli_ins) && !is_null($cli_cx) && !is_null($cli_pwd)) {
            $this->cli_id = $cli_id;
            $this->cli_login = $cli_login;
            $this->cli_email = $cli_email;
            $this->cli_ins = $cli_ins;
            $this->cli_cx = $cli_cx;
            $this->cli_pwd = $cli_pwd;
            $this->cli_tknIns = $cli_tknIns;
            $this->cli_tknPwd = $cli_tknPwd;
        }
    }

    public static function checkPassword($login, $crypt_pwd) {
        $sql = "SELECT * FROM clients WHERE cli_login=:tag_login AND cli_pwd=:tag_pwd";
        try {
            $rep = Model::$pdo->prepare($sql);
            $values = array (
                'tag_login' => $login,
                'tag_pwd' => $crypt_pwd,
            );
            $rep->execute($values);
            $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelClients');
            $tab = $rep->fetchAll();
            if (!empty($tab)) {
                return true;
            } else {
                return false;
            }
        }
        catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                return 'Une erreur est survenue lors de la vérification des données, veuillez réessayer plus tard.';
            }
            die();
        }
    }

    public static function check($login, $verif) {
        $sql = "SELECT $verif FROM clients WHERE cli_login=:tag_login";
        try {
            $rep = Model::$pdo->prepare($sql);
            $values = array (
                'tag_login' => $login,
            );
            $rep->execute($values);
            $tab =  $rep->fetchAll();
            if (!empty($tab)){
                return $tab;
            }else{
                return false;
            }
        }
        catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                return "Une erreur est survenue lors de la vérification de $verif.";
            }
            die();
        }
    }

    public static function checkTokenIns($login, $token) {
        $sql = "SELECT * FROM clients WHERE cli_login=:tag_login AND cli_tknIns =:tag_tkn";
        try {
            $rep = Model::$pdo->prepare($sql);
            $values = array(
                'tag_login' => $login,
                'tag_tkn' => $token,
            );
            $rep->execute($values);
            $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelClients');
            $tab = $rep->fetchAll();
            if (!empty($tab)) {
                return $tab[0];
            } else {
                return false;
            }
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                return 'Une erreur est survenue.';
            }
            die();
        }
    }

    public static function checkLogin($login){
        $sql = "SELECT COUNT(*) FROM `blacklist` WHERE LOWER(:login) LIKE CONCAT('%', LOWER(keyword), '%')";
        try {
            $rep = Model::$pdo->prepare($sql);
            $values = array(
                'login' => $login
            );
            $rep->execute($values);
            $tab = $rep->fetch();
            if (!empty($tab)) {
                return $tab[0] > 0;
            } else {
                return false;
            }
        }catch (PDOException $e){
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                return 'Une erreur est survenue.';
            }
            die();
        }
    }
}