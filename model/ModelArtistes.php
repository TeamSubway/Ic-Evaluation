<?php
require_once(File::build_path(array('model', 'Model.php')));

class ModelArtistes extends Model{

    protected static $object = 'artistes';
    protected static $primary='art_id';


    private $art_id;
    private $art_nom;
    private $art_typ;
    private $art_pays;
    private $art_genre;

    public function get($attribut)
    {
        return $this->$attribut;
    }
    public function set($attribut)
    {
        return $this->$attribut;
    }

    public function __construct($art_id = NULL,$art_nom = NULL, $art_typ = NULL,$art_pays = NULL, $art_genre = NULL)
    {
        if (!is_null($art_id) && !is_null($art_nom) && !is_null($art_typ) && !is_null($art_pays) && !is_null($art_genre) ) {
            $this->art_id = $art_id;
            $this->art_nom = $art_nom;
            $this->art_typ = $art_typ;
            $this->art_pays = $art_pays;
            $this->art_genre = $art_genre;
        }
    }




}