<?php
require_once(File::build_path(array('model', 'Model.php')));

class ModelAlbums extends Model{

    protected static $object = 'albums';
    protected static $primary='idAlbums';

}