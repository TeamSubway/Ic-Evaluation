<?php


require_once(File::build_path(array('controller', 'ControllerClients.php')));
require_once(File::build_path(array('controller', 'ControllerArtistes.php')));
require_once(File::build_path(array('controller', 'ControllerAlbums.php')));

if(isset($_GET['action']))
{
    $action = $_GET['action'];
}else{
    $action = 'readAll';
}
if(isset($_GET['controller']))
{
    $controller = htmlspecialchars($_GET['controller']);
}else{
    $controller = 'clients';
    $action = 'connect';
}
$controller_class = 'Controller' . ucfirst($controller);

if(class_exists($controller_class)){
    $allAction = get_class_methods($controller_class);

    if(in_array($action, $allAction)){
        $controller_class::$action();
    }else{
        require(File::build_path(array('view','error', 'error.php')));
    }
}else{
    require(File::build_path(array('view','error', 'error.php')));
}
?>
