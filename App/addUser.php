<?php
    //import BDD
    include '../App/utils/connectBdd.php';
    include '../App/model/utilisateur.php';
    include '../App/manager/ManagerUtilisateur.php';

    //Fonction permettant de récupérer l'extension d'une image      
    function get_file_extension($file) {
        return substr(strrchr($file,'.'),1);
    }

    //Fonction permettant de nettoyer les données

    function sanitize ($var) {
        $var = htmlentities($var);
        $var = strip_tags($var);
        $var = trim($var);
        $var = stripslashes($var);
        return $var;
    }

    //Vérification du formulaire, du format de l'image, de la taille de l'image, de l'existance du compte et exécution de la fonction 'addUser'
    if (isset($_POST['submit_register'])) { //vérifie si le formulaire à été soumis 
        if (!empty($_POST['nom_utilisateur']) AND !empty($_POST['prenom_utilisateur']) AND !empty($_POST['mail_utilisateur']) AND !empty($_POST['password_utilisateur'])) { //vérifie si tous les champs nécessaires ont été saisis
            if (filter_var($_POST['mail_utilisateur'], FILTER_VALIDATE_EMAIL)) { //Vérifie le format de l'adresse mail 
                if ($_FILES['image_utilisateur']['tmp_name']) { //vérifie si une image à été importée
                        $ext= get_file_extension($_FILES['image_utilisateur']['name']);
                        if ($ext == 'jpg' OR $ext == 'jpeg' OR $ext == 'png' or $ext == 'JPG' OR $ext == 'JPEG' OR $ext == 'PNG') { //vérifie le format de l'image importée
                            if ($_FILES['image_utilisateur']['size'] <= (100 * 1024)) { //vérifie la taille de l'image importée
                                move_uploaded_file($_FILES['image_utilisateur']['tmp_name'], '../Public/asset/image/'.$_FILES['image_utilisateur']['name'].'');
                                $imageLink='../Public/asset/image/'.$_FILES['image_utilisateur']['name'];
                                //Appel de la fonction pour finaliser la création de l'utilisateur
                                createUser($_POST['nom_utilisateur'], $_POST['prenom_utilisateur'], $_POST['mail_utilisateur'], $_POST['password_utilisateur'], $imageLink);
                            } else {
                                $error = 2; //La taille de l'image est trop grande
                                sendError($error);
                            }
                        } else {
                            $error = 3; // Le format de l'image n'est pas bon
                            sendError($error);
                        }
                } else {
                    $imageLink='../Public/asset/image/default.png';
                    //Appel de la fonction pour finaliser la création de l'utilisateur
                    createUser($_POST['nom_utilisateur'], $_POST['prenom_utilisateur'], $_POST['mail_utilisateur'], $_POST['password_utilisateur'], $imageLink);
                }
            } else {
                $error = 5; //Mauvais format de mail
                sendError($error);
            }
        } else {
            $error = 4; //Tous les champs du formulaire ne sont pas remplis
            sendError($error);
        }
    }

    //Gestion des messages
    function sendError($error) {
        header('Location:./vue/view_add_user.php?error='.$error.'');
    }

    function createUser($nom, $prenom, $mail, $password, $imageLink) {
        
        //Traitement des donnnées du formulaire (toujours avant la création de la nouvelle instance)
        $nom = sanitize($nom);
        $prenom = sanitize($prenom);
        $mail = sanitize($mail);
        $hashPassword = password_hash(sanitize($password), PASSWORD_DEFAULT);
        $imageLink = sanitize($imageLink);

        //Création de l'instance utilisateur (toujours après le nettoyage des données)
        $newUser = new ManagerUtilisateur($nom, $prenom, $mail, $hashPassword);
        $newUser->setImageUtilisateur($imageLink);

        // Vérification de l'existance du compte et ajout de l'utilisateur si l'adresse mail n'est pas déjà utilisée
        if ($newUser->getUserByMail()) {
            $error=1; // L'adresse mail est déjà utilisée pour un autre compte utilisateur
            sendError($error);
        } else {
            $newUser->insertUser();
            $error='0'; // Le compte à bien été créé
            sendError($error);
        }
    }

?>