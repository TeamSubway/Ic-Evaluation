<?php

    session_start();
    require_once('./lib/file.php');

    require_once(File::build_path(array('lib','session.php')));
    require_once(File::build_path(array('lib','security.php')));
    require(File::build_path(array('controller', 'routeur.php')));

?>