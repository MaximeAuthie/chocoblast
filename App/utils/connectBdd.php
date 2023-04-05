<?php
    //Classe contenant la méthode statique permettant de se connecter à la BDD
    class BddConnect {
        
        static function connexion () {
            //Import du ficher de configuration pour récupérer les variables de connexion
            include './env.php';
            
            //Nouvel objet PDO
            return new PDO("mysql:host=$host;dbname=$database", $login, $password, 
            array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
        }
    }

?>