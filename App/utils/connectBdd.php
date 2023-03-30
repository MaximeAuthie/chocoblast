<?php
    //Classe contenant la méthode statique permettant de se connecter à la BDD
    class BddConnect {
        static function connexion () {
            return new PDO('mysql:host=localhost;dbname=chocoblast', 'root','', 
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
    }

?>