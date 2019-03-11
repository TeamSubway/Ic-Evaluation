<?php
require_once(File::build_path(array('model', 'Model.php')));

class ModelAlbums extends Model{

    protected static $object = 'albums';
    protected static $primary='alb_id';

    private $alb_id;
    private $alb_art;
    private $alb_nom;
    private $alb_annee;
    private $alb_prix;

    public function get($attribut){
        return $this->$attribut;
    }

    public function set($attribut, $value){
        $this->$attribut = $value;
    }

    public function __construct($alb_id = NULL, $alb_art = NULL, $alb_nom = NULL, $alb_annee = NULL, $alb_prix = NULL)
    {
        if(!is_null($alb_id) && !is_null($alb_art) && !is_null($alb_nom) && !is_null($alb_annee) && !is_null($alb_prix)){
            $this->alb_id = $alb_id;
            $this->alb_art = $alb_art;
            $this->alb_nom = $alb_nom;
            $this->alb_annee = $alb_annee;
            $this->alb_prix = $alb_prix;
        }
    }

}