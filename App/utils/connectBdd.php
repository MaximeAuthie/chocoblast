<?php

    class BddConnect {
        public function __construct() {
            
        }

        public function connexion () {
            return new PDO('mysql:host=localhost;dbname=chocoblast', 'root','', 
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
    }

    // $bdd = new PDO('mysql:host=localhost;dbname=chocoblast', 'root','', 
    // array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
?>