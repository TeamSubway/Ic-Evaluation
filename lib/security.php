<?php
class Security{

    static public function chiffrer($texte_en_clair) {
       $texte_chiffre = hash('sha256', self::getSeed() . $texte_en_clair);
       return $texte_chiffre;
     }

     private static $seed = 'h4ebRJ';

     static public function getSeed() {
        return self::$seed;
     }

    static function generateRandomHex() {
        $numbytes = 16;
        $bytes = openssl_random_pseudo_bytes($numbytes);
        $hex   = bin2hex($bytes);
        return $hex;
    }
}
?>