<?php

require_once(File::build_path(array('config','Conf.php')));

class Model{

    public static $pdo;

    public static function Init(){
        try{
            $hostname = Conf::getHostname();
            $database_name = Conf::getDatabase();
            $login = Conf::getLogin();
            $password = Conf::getPassword();
            self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }  catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                return false;
            }
            die();
        }
    }



    public static function selectAll(){
        try {
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);

            $rep = Model::$pdo->query("SELECT * FROM $table_name");
            $tab_class = $rep->fetchALl(PDO::FETCH_CLASS, $class_name);
            return $tab_class;
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                return false;
            }
            die();
        }
    }

    public static function select($primary_value) {
        try {
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);
            $primary_key = static::$primary;

            $sql = "SELECT * from $table_name WHERE $primary_key=:pk";
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "pk" => $primary_value,
            );
            $req_prep->execute($values);

            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            $tab_class = $req_prep->fetchAll();

            if (empty($tab_class))
                return false;
            return $tab_class[0];
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                return false;
            }
            die();
        }
    }

    public static function delete($primary_value){
        try {
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);
            $primary_key = static::$primary;

            $sql = "DELETE FROM $table_name WHERE $primary_key=:pk";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
                "pk" => $primary_value
            );
            $req_prep->execute($values);
            return true;
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                return false;
            }
            die();
        }
    }

    public function update($data){
        try {
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);
            $primary_key = static::$primary;

            $set = "";

            foreach($data as $champ_id => $champ){
                if($primary_key == $champ_id){
                    $primary_value = $champ;
                }else{
                    $set = $set . $champ_id . "=:" . $champ_id . ",";
                    $values[$champ_id] = $champ;
                }
                $values[$champ_id] = $champ;
            }
            $set = rtrim($set, ',');

            $sql = "UPDATE $table_name SET $set WHERE $primary_key=:$primary_key";
            $req_prep = Model::$pdo->prepare($sql);

            $req_prep->execute($values);
            return true;
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                return false;
            }
            die();
        }
    }

    public static function save($data){
        try {
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);
            $primary_key = static::$primary;

            $insert = "";

            foreach($data as $champ_id => $champ){
                $insert = $insert . ":" . $champ_id . ",";
                $values[$champ_id] = $champ;
            }
            $insert = rtrim($insert, ',');

            $sql = "INSERT INTO $table_name VALUES ($insert)";

            $req_prep = Model::$pdo->prepare($sql);

            $req_prep->execute($values);
            return true;
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                return false;
            }
            die();
        }
    }
}

Model::Init();
?>
