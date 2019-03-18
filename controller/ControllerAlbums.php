<?php
require_once File::build_path(array("model","ModelAlbums.php"));
require_once File::build_path(array("lib","Security.php"));
require_once File::build_path(array("lib","Session.php"));

class ControllerAlbums {
    protected static $object = "albums";

    public static function readAll(){
        $view = 'list';
        $pagetitle = 'Liste albums';
        $alb_list = ModelAlbums::selectAll();
        require_once File::build_path(array("view","view.php"));
    }
}