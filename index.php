<?php
    //connexion des utils, model, manager qui seront repris dans tous les controlers
    include './App/utils/connectBdd.php';
    include './App/utils/toolbox.php';
    include './App/model/roles.php';
    include './App/model/utilisateur.php';
    include './App/model/chocoblast.php';
    include './App/model/commentaire.php';
    include './App/manager/ManagerUtilisateur.php';
    // include './App/api/ApiUtilisateur.php';

    // Initialisation de la super globale SESSION pour toutes les pages
    session_start();

    //Création d'une nouvelle instance de l'API
    // $api = new ApiUtilisateur();

    //! Tous les liens de toutes les vues et de tous controler doivent être renseignés du point de vue du router (index.php)

    //Analyse de l'URL avec parse_url() et retourne ses composants
    $url = parse_url($_SERVER['REQUEST_URI']);
    //test soit l'url a une route sinon on renvoi à la racine
    $path = isset($url['path']) ? $url['path'] : '/';

    /*--------------------------ROUTER -----------------------------*/
    //test de la valeur $path dans l'URL et import de la ressource
    switch($path){
        case $path === "/chocoblast/accueil":
            include './App/controler/controlerHome.php';
            break ;

        case $path === "/chocoblast/chocoblast" :
            include './App/controler/controlerChocoblast.php';
            break ;

        case $path === "/chocoblast/connexion" :
            include './App/controler/controlerSignIn.php';
            break ;
       
        case $path === "/chocoblast/inscription":
            include './App/controler/controlerAddUser.php';
            break ;
        
        case $path === "/chocoblast/deconnexion":
            include './App/controler/controlerLogOut.php';
            break ;
        
        case $path === "/chocoblast/userAdd":
            $api->addUser();
            
        default:
            include './App/controler/controler404.php';
    }
?>