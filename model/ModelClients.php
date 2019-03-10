<?php
require_once(File::build_path(array('model', 'Model.php')));

class ModelClients extends Model{

    protected static $object = 'clients';
    protected static $primary='cli_login';

    private $id;
    private $login;
    private $email;
    private $dateInscription;
    private $dateConnexion;
    private $password;
    private $tokenInscription;
    private $tokenPassword;

    public function get($attribut) {
        return $this->$attribut;
    }

    public function set($attribut, $value) {
        $this->$attribut = $value;
    }

    public function __construct($id = NULL, $login = NULL, $email = NULL, $dateInscription = NULL, $dateConnexion = NULL, $password = NULL, $tokenInscription = NULL, $tokenPassword = NULL) {
        if (!is_null($id) && !is_null($login) && !is_null($email) && !is_null($dateInscription) && !is_null($dateConnexion) && !is_null($password)) {
            $this->id = $id;
            $this->login = $login;
            $this->email = $email;
            $this->dateInscription = $dateInscription;
            $this->dateConnexion = $dateConnexion;
            $this->password = $password;
            $this->tokenInscription = $tokenInscription;
            $this->tokenPassword = $tokenPassword;
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
}