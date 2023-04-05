<?php

    //Déclarations des variables qui interagissent avec les vues
    $message = '';
    $navbar='';
    $deconnexion = '';

    if (isset($_SESSION['connected'])) { //! Toujours tester les variable super globale avec isset, sinon ça renvoie une erreur
        $navbar =   '<li class="nav-item">
                        <a class="nav-link" href="accueil">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="chocoblast">Chocoblast</a>
                    </li>';
    } else {
        $navbar =   '<li class="nav-item"> 
                        <a class="nav-link" href="accueil">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="chocoblast">chocoblast</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="connexion">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="inscription">Inscription</a>
                    </li>';
    }

    if (isset($_SESSION['connected'])) { //! Toujours tester les variable super globale avec isset, sinon ça renvoie une erreur
        $deconnexion = '<a href="deconnexion">
                            <button type="submit" class="btn btn-link" name="submit_log_out">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                </svg>
                                Déconnexion
                            </button>
                        </a>';
    } 
    
    //Si le formulaire de connexion est soumis
    if (isset($_POST['submit_sign_in'])) { //On vérifie si le formulaire a été soumis

        // Netoyage des données
        $mail = ToolBox::nettoyerDonnees($_POST['mail_utilisateur']);
        $inputPassword = ToolBox::nettoyerDonnees($_POST['password_utilisateur']);

        if (!empty($_POST['mail_utilisateur'] && !empty($_POST['password_utilisateur']))) { //On vérifie que tous les champs soient bien complets
            
            if (filter_var($_POST['mail_utilisateur'], FILTER_VALIDATE_EMAIL)) { //On vérifie le format de l'adresse mail
               
                // Création de l'instance de ManagerUtilisateur et récupération du résultat de la requête //! Ici setter les attribut sur l'objet $this
                $nouvelUtilisateur = new ManagerUtilisateur('','',$mail,$inputPassword);
                $userData = $nouvelUtilisateur->getUserByMail();

                if ($userData) {
                    $returnPassword = $userData[0]["password_utilisateur"];
                    $returnFirstName = $userData[0]["prenom_utilisateur"];

                    //Si le MDP est correct, on stocke les données utilisateur dans la super globale SESSION
                    if (password_verify($inputPassword,$returnPassword)) {
                        $_SESSION['connected'] = true;
                        $_SESSION['id_utilisateur'] = $userData[0]["id_utilisateur"];
                        $_SESSION['prenom_utilisateur'] = $userData[0]["prenom_utilisateur"];
                        $_SESSION['nom_utilisateur'] = $userData[0]["nom_utilisateur"];
                        $_SESSION['mail_utilisateur'] = $userData[0]["mail_utilisateur"];
                        $_SESSION['image_utilisateur'] = $userData[0]["image_utilisateur"];
                        $_SESSION['statut_utilisateur'] = $userData[0]["statut_utilisateur"];
                        $_SESSION['role_utilisateur'] = $userData[0]["id_roles"];

                        $message = ToolBox::definirMessage(8, $returnFirstName);
                        $navbar =   '<li class="nav-item">
                                        <a class="nav-link" href="accueil">Accueil</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="chocoblast">Chocoblast</a>
                                    </li>';
                                    
                    } else {
                        $message = ToolBox::definirMessage(7,''); //Adresse mail ou MDP incorrect
                   }

                } else {
                    $message = ToolBox::definirMessage(7,''); //Adresse mail ou MDP incorrect
                }
                
            } else {
                $message = ToolBox::definirMessage(5,''); //format de l'adresse mail incorrect
            }

        } else {
            $message = ToolBox::definirMessage(4,''); //tous les champs ne sont pas remplis
        }

    }

    include './App/vue/header.php';
    include './App/vue/view_sign_in.php'

?>