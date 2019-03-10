<?php
require_once File::build_path(array("model","ModelClients.php"));
require_once File::build_path(array("lib","Security.php"));
require_once File::build_path(array("lib","Session.php"));

class ControllerClients {
    protected static $object = "clients";

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
            if (ModelClients::check($login, 'cli_tknIns')) {
                if (ModelClients::checkPassword($login, $pwd) && !isset($_SESSION['login'])) {
                    $_SESSION['login'] = $login;
                    $client = ModelClients::select($login);
                    $_SESSION['mail'] = $client->get('mail');
                    $_SESSION['dateInscription'] = $client->get('dateInscription');
                    $_SESSION['dateConnexion'] = $client->get('dateConnexion');
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
                    // Mail (à voir) : METTRE L'ADRESSE DE VOTRE SITE EN LOCAL
                    $message = "Bonjour et bienvenu(e) sur notre site ".$data['login'].
                        ", veuillez activez votre compte à l'adresse ci-jointe :
                http://ic-eval.local:8080/index.php?controller=clients&action=validate&mail=" . $data['login']."&tknIns=".$data['tknIns'];
                    mail($data['mail'], 'Confirmation d\'inscription', $message);
                    $view = 'connect';
                    $pagetitle = 'Connexion';
                    require_once File::build_path(array("view","view.php"));
                } else {
                    $login = $_POST['login'];
                    $mail = $_POST['mail'];
                    $pwd = '';

                    $action = 'created';
                    $error = 'Email incorrect';
                    $view = 'update';
                    $pagetitle = 'Inscrition';
                    require_once File::build_path(array("view","view.php"));
                }
            }else{
                $login = $_POST['login'];
                $mail = $_POST['mail'];
                $pwd = '';

                $action = 'created';
                $error = 'Données manquantes';
                $view = 'update';
                $pagetitle = 'Inscrition';
                require_once File::build_path(array("view","view.php"));
            }
        } else {
            $login = $_POST['login'];
            $mail = $_POST['mail'];
            $pwd = '';

            $action = 'created';
            $error = 'Données manquantes';
            $view = 'update';
            $pagetitle = 'Inscrition';
            require_once File::build_path(array("view","view.php"));
        }
    }
    public static function validate() {
        if (isset($_GET['login']) && isset($_GET['tknIns'])) {
            if($client = ModelClients::select($_GET['login'])){
                if (filter_var($client->get('mail'), FILTER_VALIDATE_EMAIL)) {
                    $login = $_GET['login'];
                    $mail = $client->get('mail');
                    $tknIns = $_GET['tknIns'];
                    $tab = ModelClients::checkTokenIns($login, $tknIns);
                    // S'il y a concordence des données, alors on met le nonce à null
                    if ($tab) {
                        $data['login'] = $client;
                        $data['tknIns'] = null;
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