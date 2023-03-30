<?php
    //import autres pages
    include './App/model/utilisateur.php';
    include './App/manager/ManagerUtilisateur.php';

    session_start();

    $message = '';
    $navbar = ' <li class="nav-item"> //! Reconstruire la vue header et afficher la variable 
                    <a class="nav-link" href="accueil">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="chocoblast">chocoblast</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="connexion">Connexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="inscription">Inscription</a>
                </li>';

    if (isset($_POST['submit_sign_in'])) { //On vérifie si le formulaire a été soumis

        if (!empty($_POST['mail_utilisateur'] && !empty($_POST['password_utilisateur']))) { //On vérifie que tous les champs soient bien complets
            
            if (filter_var($_POST['mail_utilisateur'], FILTER_VALIDATE_EMAIL)) { //On vérifie le format de l'adresse mail
               
                // Netoyage des données
                $mail = ToolBox::nettoyerDonnees($_POST['mail_utilisateur']);
                $inputPassword = ToolBox::nettoyerDonnees($_POST['password_utilisateur']);

                // Création de l'instance de ManagerUtilisateur et récupération du résultat de la requête
                $nouvelUtilisateur = new ManagerUtilisateur('','',$mail,$inputPassword);
                $userData = $nouvelUtilisateur->getUserByMail();

                if ($userData) {
                    $returnPassword = $userData[0]["password_utilisateur"];
                    $returnFirstName = $userData[0]["prenom_utilisateur"];

                    //Si le MDP est correct, on stocke les données utilisateur dans la super globale SESSION
                    if (password_verify($inputPassword,$returnPassword)) { //! Ajouter ID
                        $_SESSION['mail_utilisateur'] = $userData[0]["mail_utilisateur"];
                        $_SESSION['prenom_utilisateur'] = $userData[0]["prenom_utilisateur"];
                        $_SESSION['nom_utilisateur'] = $userData[0]["nom_utilisateur"];
                        $_SESSION['image_utilisateur'] = $userData[0]["image_utilisateur"];
                        $_SESSION['statut_utilisateur'] = $userData[0]["statut_utilisateur"];
                        $_SESSION['role_utilisateur'] = $userData[0]["id_roles"];
                        $message = ToolBox::definirMessage(8, $returnFirstName);
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

    // include '../vue/header.php';
    include './App/vue/view_sign_in.php'

?>