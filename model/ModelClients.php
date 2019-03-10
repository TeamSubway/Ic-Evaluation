<?php
require_once(File::build_path(array('model', 'Model.php')));

class ModelClients extends Model{

    protected static $object = 'clients';
    protected static $primary='idClient';

}