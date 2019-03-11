<?php
require_once File::build_path(array("model","ModelClients.php"));
require_once File::build_path(array("lib","Security.php"));
require_once File::build_path(array("lib","Session.php"));

class ControllerClients {
    protected static $object = "clients";

    public static function read(){
        $view = 'connect';
        $pagetitle = 'Connexion';
        $login = '';
        if (Session::is_connected()) {
            $login = $_SESSION['login'];
            $client = ModelClients::select($login);
            $view = 'detail';
            $pagetitle = "Profil de $login";
            require_once File::build_path(array("view","view.php"));
        }
        require_once File::build_path(array("view", "view.php"));
    }

    public static function connect() {
        $view = 'connect';
        $pagetitle = 'Connexion';
        $login = '';
        if (Session::is_connected()) {
            $login = $_SESSION['login'];
            $client = ModelClients::select($login);
            $view = 'detail';
            $pagetitle = "Profil de $login";
            require_once File::build_path(array("view","view.php"));
        }
        require_once File::build_path(array("view", "view.php"));
    }


    public static function connected() {
        if (isset($_POST['login']) && isset($_POST['pwd'])) {
            $login = $_POST['login'];
            $pwd = Security::chiffrer($_POST['pwd']);
            $data = ModelClients::check($login, 'cli_tknIns');
            if ($data[0]['cli_tknIns'] == NULL) {
                if (ModelClients::checkPassword($login, $pwd) && !isset($_SESSION['login'])) {
                    $_SESSION['login'] = $login;
                    $client = ModelClients::select($login);
                    $_SESSION['mail'] = $client->get('cli_email');
                    $_SESSION['dateInscription'] = $client->get('cli_ins');
                    $_SESSION['dateConnexion'] = $client->get('cli_cx');
                    $view = 'detail';
                    $pagetitle = "Profil de $login";
                    require_once File::build_path(array("view","view.php"));
                } else {
                    $view = 'connect';
                    $error = "Mail ou mot de passe invalide";
                    $pagetitle = 'Erreur de connexion';
                    $login = $_POST['login'];
                    $mdp = '';
                    require_once File::build_path(array("view","view.php"));
                }
            } else {
                $error = "Veuillez valider votre compte";
                $view = 'connect';
                $pagetitle = 'Erreur de connexion';
                require_once File::build_path(array("view","view.php"));
            }
        } else {
            $login = '';
            $error = "Aucune donnée entrée !";
            $view = 'connect';
            $pagetitle = 'Erreur de connexion';
            require_once File::build_path(array("view","view.php"));
        }
    }

    public static function deconnect() {
        $login = $_SESSION['login'];
        unset($_SESSION['login']);
        unset($_SESSION['mail']);
        unset($_SESSION['dateInscription']);
        unset($_SESSION['dateConnexion']);
        $pagetitle = 'Connexion';
        $view = 'connect';
        require_once File::build_path(array("view", "view.php"));
    }

    public static function create() {
        $view = 'update';
        $pagetitle = 'Inscription';
        $action = 'created';

        $login = '';
        $mail = '';
        $pwd = '';

        require_once File::build_path(array("view","view.php"));
    }

    public static function created() {
        if(isset($_POST['login']) && isset($_POST['mail']) && isset($_POST['pwd'])) {
            if (!empty($_POST['login']) && !empty($_POST['mail']) && !empty($_POST['pwd'])){
                if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                    if(!ModelClients::checkLogin($_POST['login'])) {
                        $data = array(
                            'id' => null,
                            'login' => $_POST['login'],
                            'mail' => $_POST['mail'],
                            'dateIns' => date('Y-m-d'),
                            'dateCx' => null,
                            'pwd' => Security::chiffrer($_POST['pwd']),
                            'tknIns' => Security::generateRandomHex(),
                            'tknCx' => ''
                        );
                        ModelClients::save($data);
                        $message = "Bonjour et bienvenu(e) sur notre site " . $data['login'] .
                            ", veuillez activez votre compte à l'adresse ci-jointe :
                        http:/" . Conf::getLink() . "/index.php?controller=clients&action=validate&login=" . $data['login'] . "&tknIns=" . $data['tknIns'];
                        mail($data['mail'], 'Confirmation d\'inscription', $message);
                        $view = 'connect';
                        $pagetitle = 'Connexion';
                        require_once File::build_path(array("view", "view.php"));
                    }
                    else {
                        $login = $_POST['login'];
                        $mail = $_POST['mail'];
                        $pwd = '';

                        $action = 'created';
                        $error = 'Login non conforme';
                        $view = 'update';
                        $pagetitle = 'Inscription';
                        require_once File::build_path(array("view","view.php"));
                    }
                } else {
                    $login = $_POST['login'];
                    $mail = $_POST['mail'];
                    $pwd = '';

                    $action = 'created';
                    $error = 'Email incorrect';
                    $view = 'update';
                    $pagetitle = 'Inscription';
                    require_once File::build_path(array("view","view.php"));
                }
            }else{
                $login = $_POST['login'];
                $mail = $_POST['mail'];
                $pwd = '';

                $action = 'created';
                $error = 'Données manquantes';
                $view = 'update';
                $pagetitle = 'Inscription';
                require_once File::build_path(array("view","view.php"));
            }
        } else {
            if(isset($_POST['login']))
                $login = $_POST['login'];
            else
                $login = '';

            if(isset($_POST['mail']))
                $mail = $_POST['mail'];
            else
                $mail = '';

            $pwd = '';

            $action = 'created';
            $error = 'Données manquantes';
            $view = 'update';
            $pagetitle = 'Inscription';
            require_once File::build_path(array("view","view.php"));
        }
    }



    public static function update() {
        $view = 'connect';
        $pagetitle = 'Connexion';
        $login = '';
        if (Session::is_connected()) {
            $login = $_SESSION['login'];
            $client = ModelClients::select($login);
            $mail = $client->get('cli_email');
            $pwd = '';

            $view = 'update';
            $pagetitle = 'Modification';
            $action = 'updated';
            require_once File::build_path(array("view","view.php"));
        }
        require_once File::build_path(array("view", "view.php"));
    }

    public static function updated() {
        $view = 'connect';
        $pagetitle = 'Connexion';
        $login = '';
        if (Session::is_connected()) {
            $login = $_SESSION['login'];
            $client = ModelClients::select($login);

            $email = $client->get('cli_email');
            if(isset($_POST['mail']) &&  !empty($_POST['mail']) && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
                $email = $_POST['mail'];

            $pwd = $client->get('cli_pwd');
            if(isset($_POST['pwd']) &&  !empty($_POST['pwd']))
                $pwd = Security::chiffrer($_POST['pwd']);


            $data = array(
                'cli_login' => $login,
                'cli_email' => $email,
                'cli_pwd' => $pwd,
            );
            $client->update($data);

            $_SESSION['mail'] = $email;

            $view = 'detail';
            $pagetitle = 'Profil';
            require_once File::build_path(array("view","view.php"));
        }
        require_once File::build_path(array("view", "view.php"));
    }

    public static function validate() {
        if (isset($_GET['login']) && isset($_GET['tknIns'])) {
            if($client = ModelClients::select($_GET['login'])){
                if (filter_var($client->get('cli_email'), FILTER_VALIDATE_EMAIL)) {
                    $login = $_GET['login'];
                    $mail = $client->get('cli_email');
                    $tknIns = $_GET['tknIns'];
                    $tab = ModelClients::checkTokenIns($login, $tknIns);
                    // S'il y a concordence des données, alors on met le nonce à null
                    if ($tab) {
                        $data['cli_login'] = $login;
                        $data['cli_tknIns'] = null;
                        $client->update($data);
                        $view = 'connect';
                        $pagetitle = 'Connexion';
                        require_once File::build_path(array("view","view.php"));
                    }else{
                        $error = 'Erreur dans la validation de votre compte';
                        $view = 'connect';
                        $pagetitle = 'Erreur de validation !';
                        require_once File::build_path(array("view","view.php"));
                    }
                }else{
                    $error = 'Erreur dans la validation de votre compte';
                    $view = 'connect';
                    $pagetitle = 'Erreur de validation !';
                    require_once File::build_path(array("view","view.php"));
                }
            }else{
                $error = 'Erreur dans la validation de votre compte';
                $view = 'connect';
                $pagetitle = 'Erreur de validation !';
                require_once File::build_path(array("view","view.php"));
            }
        }else{
            $error = 'Erreur dans la validation de votre compte';
            $view = 'connect';
            $pagetitle = 'Erreur de validation !';
            require_once File::build_path(array("view","view.php"));
        }
    }
}