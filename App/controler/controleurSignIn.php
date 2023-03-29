<?php
    //import autres pages
    include '../utils/connectBdd.php';
    include '../model/utilisateur.php';
    include '../manager/ManagerUtilisateur.php';

    session_start();

    $message = '';

    if (isset($_POST['submit_sign_in'])) { //On vérifie si le formulaire a été soumis

        if (!empty($_POST['mail_utilisateur'] && !empty($_POST['password_utilisateur']))) { //On vérifie que tous les champs soient bien complets
            
            if (filter_var($_POST['mail_utilisateur'], FILTER_VALIDATE_EMAIL)) { //On vérifie le format de l'adresse mail
               
                // Netoyage des données
                $mail = nettoyerDonnees($_POST['mail_utilisateur']);
                $inputPassword = nettoyerDonnees($_POST['password_utilisateur']);

                // Création de l'instance de ManagerUtilisateur et récupération du résultat de la requête
                $newUser = new ManagerUtilisateur('','',$mail,$inputPassword);
                $userData = $newUser->getUserByMail();

                if ($userData) {
                    $returnPassword = $userData[0]["password_utilisateur"];
                    $returnFirstName = $userData[0]["prenom_utilisateur"];

                    //Si le MDP est correct, on stocke les données utilisateur dans la super globale SESSION
                    if (password_verify($inputPassword,$returnPassword)) {
                        $_SESSION['mail_utilisateur'] = $userData[0]["mail_utilisateur"];
                        $_SESSION['prenom_utilisateur'] = $userData[0]["prenom_utilisateur"];
                        $_SESSION['nom_utilisateur'] = $userData[0]["nom_utilisateur"];
                        $_SESSION['image_utilisateur'] = $userData[0]["image_utilisateur"];
                        $_SESSION['statut_utilisateur'] = $userData[0]["statut_utilisateur"];
                        $_SESSION['role_utilisateur'] = $userData[0]["id_roles"];
                        $message = definirMessage(8, $returnFirstName);
                    } else {
                        $message = definirMessage(7,''); //Adresse mail ou MDP incorrect
                   }

                } else {
                    $message = definirMessage(7,''); //Adresse mail ou MDP incorrect
                }
                
            } else {
                $message = definirMessage(5,''); //format de l'adresse mail incorrect
            }

        } else {
            $message = definirMessage(4,''); //tous les champs ne sont pas remplis
        }

    }

    //Fonction permettant de nettoyer les données

    function nettoyerDonnees($var) {
        $var = htmlentities($var);
        $var = strip_tags($var);
        $var = trim($var);
        $var = stripslashes($var);
        return $var;
    }

    //Gestion des messages

    function definirMessage($evenement, $user) {

        switch ($evenement) {
            case 0:
                return '<br><div class="alert alert-success w-50 mx-auto mt-3 text-center" role="alert">Votre compte a bien été créé</div>';
                break;
            
            case 1:
                return '<br><div class="alert alert-danger w-50 mx-auto text-center" role="alert">L\'adresse mail saisie est déjà utilisée par un autre compte</div>';
                break;

            case 2:
                return '<br><div class="alert alert-danger w-50 mx-auto text-center" role="alert">La taille de l\'image ne doit pas dépassée 100ko.</div>';
                break;

            case 3:
                return '<br><div class="alert alert-danger w-50 mx-auto text-center" role="alert">Le format de l\'image n\'est pas correct. Les formats acceptées sont .jpg, .jpeg et .png.</div>';
                break;
        
            case 4:
                return '<br><div class="alert alert-danger w-50 mx-auto text-center" role="alert">Veuillez compléter tous les champs du formulaire.</div>';
                break;

            case 5:
                return '<br><div class="alert alert-danger w-50 mx-auto text-center" role="alert">Format de l\'adresse mail incorrect.</div>';
                break;
            
            case 6:
                return '<br><div class="alert alert-danger w-50 mx-auto text-center" role="alert">Format du lien de l\'image incorrect.</div>';
                break;

            case 7:
                return '<br><div class="alert alert-danger w-50 mx-auto text-center" role="alert">Format du lien de l\'image incorrect.</div>';
                break;
        
            case 8:
                return '<br><div class="alert alert-success w-50 mx-auto mt-3 text-center" role="alert">Bienvenue '.$user.'! Vous êtes connecté.</div>';
                break;

            default:
                return '<br><div class="alert alert-danger w-50 mx-auto text-center" role="alert">Erreur inconnue. Veuillez réessayer plus tard;</div>';
                break;
        }
    }

    include '../vue/header.php';
    include '../vue/view_sign_in.php'

?>