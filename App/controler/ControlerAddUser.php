<?php
    //import autres pages
    include '../utils/connectBdd.php';
    include '../model/utilisateur.php';
    include '../manager/ManagerUtilisateur.php';

    //Fonction permettant de récupérer l'extension d'une image      
    function get_file_extension($file) {
        return substr(strrchr($file,'.'),1);
    }

 

    //Initialisation variable $message

    $message = '';

    //Vérification du formulaire, du format de l'image, de la taille de l'image, de l'existance du compte et exécution de la fonction 'addUser'
    
    if (isset($_POST['submit_register'])) { //vérifie si le formulaire à été soumis 
        
        if (!empty($_POST['nom_utilisateur']) AND !empty($_POST['prenom_utilisateur']) AND !empty($_POST['mail_utilisateur']) AND !empty($_POST['password_utilisateur'])) { //vérifie si tous les champs nécessaires ont été saisis
            
            if (filter_var($_POST['mail_utilisateur'], FILTER_VALIDATE_EMAIL)) { //Vérifie le format de l'adresse mail 
                
                if ($_FILES['image_utilisateur']['tmp_name']) { //vérifie si une image à été importée
                        
                        $ext= get_file_extension($_FILES['image_utilisateur']['name']);

                        if ($ext == 'jpg' OR $ext == 'jpeg' OR $ext == 'png' or $ext == 'JPG' OR $ext == 'JPEG' OR $ext == 'PNG') { //vérifie le format de l'image importée
                           
                            if ($_FILES['image_utilisateur']['size'] <= (100 * 1024)) { //vérifie la taille de l'image importée
                                
                                //Définition des variables nécessaires pour déplacer l'image de profil
                                $origineImage = $_FILES['image_utilisateur']['tmp_name'];
                                $destinationImg = '../../Public/asset/image/'.$_FILES['image_utilisateur']['name'].'';
                                
                                //Appel de la fonction pour finaliser la création de l'utilisateur
                                creationCompte($_POST['nom_utilisateur'], $_POST['prenom_utilisateur'], $_POST['mail_utilisateur'], $_POST['password_utilisateur'], $origineImage, $destinationImg);
                            } else {
                                $message = definirMessage(2,''); //La taille de l'image est trop grande
                            }

                        } else {
                            $message = definirMessage(3,''); // Le format de l'image n'est pas bon
                        }

                } else {
                    $destinationImg='../Public/asset/image/default.png'; //Utilisation de l'iamge par defaut
                    //Appel de la fonction pour finaliser la création de l'utilisateur
                    creationCompte($_POST['nom_utilisateur'], $_POST['prenom_utilisateur'], $_POST['mail_utilisateur'], $_POST['password_utilisateur'],'' ,$destinationImg);
                }

            } else {
                $message = definirMessage(5,''); //Mauvais format de mail
            }

        } else {
            $message = definirMessage(4,''); //Tous les champs du formulaire ne sont pas remplis
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
                return '<br><div class="alert alert-success w-50 mx-auto mt-3 text-center" role="alert">Félicitations '.$user.'. Votre compte a bien été créé</div>';
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

    function creationCompte($nom, $prenom, $mail, $password, $origineImage, $destinationImg ) {
        
        //Traitement des donnnées du formulaire (toujours avant la création de la nouvelle instance)
        
        $nom = nettoyerDonnees($nom);
        $prenom = nettoyerDonnees($prenom);
        $mail = nettoyerDonnees($mail);
        $hashPassword = password_hash(nettoyerDonnees($password), PASSWORD_DEFAULT);
        $destinationImg = nettoyerDonnees($destinationImg);

        //Création de l'instance utilisateur (toujours après le nettoyage des données)
        $newUser = new ManagerUtilisateur($nom, $prenom, $mail, $hashPassword);
        $newUser->setImageUtilisateur($destinationImg);

        // Vérification de l'existance du compte et ajout de l'utilisateur si l'adresse mail n'est pas déjà utilisée

        global $message;

        if ($newUser->getUserByMail()) {
            $message = definirMessage(1,'');; // L'adresse mail est déjà utilisée pour un autre compte utilisateur
        } else {
            move_uploaded_file($origineImage, $destinationImg);
            $newUser->insertUser();
            $message = definirMessage(0,$prenom);; // Le compte à bien été créé
        }
    }

    include '../vue/header.php';
    include '../vue/view_add_user.php';
?>