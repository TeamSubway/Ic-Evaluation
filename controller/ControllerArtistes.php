<?php
require_once File::build_path(array("model","ModelArtistes.php"));
require_once File::build_path(array("lib","Security.php"));
require_once File::build_path(array("lib","Session.php"));

class ControllerArtistes {
    protected static $object = "artistes";

public static function readAll()
{
    $view = 'list';
    $pagetitle = 'Liste Artiste';
    $list_artiste = ModelArtistes::selectAll();
    $result = array();
    //$list_genre = $list_artiste->get('art_genre');
    $rep = Model::$pdo->query("SELECT * FROM genres");
    $result = $rep->fetchALl(PDO::FETCH_CLASS);
    require_once File::build_path(array("view","view.php"));
}

    public static function read(){
        $view = 'detail';
        if(isset($_GET['id']) && $_GET['id'] != '')
        {
            $art = ModelArtistes::select($_GET['id']);

            if($art != null){
                $pagetitle = $art->get('art_nom');
            }
            else{
                $view = 'list';
                $pagetitle = 'Liste artistes';
                $alb_list = ModelArtistes::selectAll();
            }
        }
        else{
            $view = 'list';
            $pagetitle = 'Liste artistes';
            $alb_list = ModelArtistes::selectAll();
        }
        require_once File::build_path(array("view","view.php"));
    }

}