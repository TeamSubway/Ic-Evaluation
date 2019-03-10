<?php
require_once(File::build_path(array('model', 'Model.php')));

class ModelArtistes extends Model{

    protected static $object = 'artistes';
    protected static $primary='idArtiste';

}