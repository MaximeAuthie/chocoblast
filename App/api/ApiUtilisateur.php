<?php
include './App/model/utilisateur.php';
include './App/manager/ManagerUtilisateur.php';

class ApiUtilisateur {
    function addUser() {
        // En-tête HTTP
        header('Access-Control-Allow-Origin: *'); // La fonction est accessible depuis n'importe quel domaine (*)
        header('Access-Control-Allow-Methods: POST'); // ON est en mode envoi de données (POST)
        header('Content-type: application/json'); //

        // Json de sortie
        echo json_encode(['erreur: ' =>'Bienvenue sur Chocoblaster 9000']);
    }
}

?>