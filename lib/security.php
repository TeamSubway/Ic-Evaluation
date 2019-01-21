<?php
class Security{

     function chiffrer($texte_en_clair) {
       $texte_chiffre = hash('sha256', self::getSeed() . $texte_en_clair);
       return $texte_chiffre;
     }

     private static $seed = 'h4ebRJ';

     static public function getSeed() {
        return self::$seed;
     }
}
?>