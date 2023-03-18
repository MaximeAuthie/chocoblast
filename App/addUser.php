<?php
    //import BDD
    include '../App/utils/connectBdd.php';

    //Fonction permettant de récupérer l'extension d'une image
    function get_file_extension($file) {
        return substr(strrchr($file,'.'),1);
    }

    //Vérification du formulaire, du format de l'image, de la taille de l'image, de l'existance du compte et exécution de la fonction 'addUser'
    if (isset($_POST['submit_register'])) {
        if (!empty($_POST['nom_utilisateur']) AND !empty($_POST['prenom_utilisateur']) AND !empty($_POST['mail_utilisateur']) AND !empty($_POST['password_utilisateur'])) {
            if ($_FILES['image_utilisateur']['tmp_name']) {
                $ext= get_file_extension($_FILES['image_utilisateur']['name']);
                if ($ext == 'jpg' OR $ext == 'jpeg' OR $ext == 'png' or $ext == 'JPG' OR $ext == 'JPEG' OR $ext == 'PNG') {
                    if ($_FILES['image_utilisateur']['size'] <= (100 * 1024)) {
                        move_uploaded_file($_FILES['image_utilisateur']['tmp_name'], '../Public/asset/image/'.$_FILES['image_utilisateur']['name'].'');
                        $imageLink='../Public/asset/image/'.$_FILES['image_utilisateur']['name'];
                    } else {
                        $error=2; //La taille de l'image est trop grande
                        echo 'Image trop grande';
                    }
                } else {
                    $error=3; // Le format de l'image n'est pas bon
                    echo 'Mauvais format';
                }
            } else {
                $imageLink='../Public/asset/image/default.png';
            }
            // Vérification de l'existance du compte et ajout de l'utilisateur si l'adresse mail n'est pas déjà utilisée
            if (checkAccount($bdd,$_POST['mail_utilisateur'])) {
                $error=1; // L'adresse mail est déjà utilisée pour un autre compte utilisateur
                echo 'Utilisateur créé';
            } else {
                addUser($bdd,$_POST['nom_utilisateur'], $_POST['prenom_utilisateur'], $_POST['mail_utilisateur'], $_POST['password_utilisateur'], $imageLink);
                $success='ok';
            }
        } else {
            $error=4; //Tous les champs du formulaire ne sont pas remplis
            echo 'Tous les champs ne sont pas remplis';
        }
    }

    //Gestion des messages
    if ($success != '') {
        header('Location:./vue/view_add_user.php?success='.$success.'');
    }
    if ($error != '') {
        header('Location:./vue/view_add_user.php?error='.$error.'');
    }

    function addUser($bdd, $userLastName, $userFirstName, $userMail, $userPassword, $userImage) {
        try {
            $status = 1;
            $role= 1;
            $hashPassword = password_hash($userPassword, PASSWORD_DEFAULT);
            //préparation de la requête
            $reqUpdate = $bdd->prepare('INSERT INTO utilisateur(nom_utilisateur, prenom_utilisateur, mail_utilisateur, password_utilisateur, image_utilisateur, statut_utilisateur, id_roles) VALUES
            (?, ?, ?, ?, ?, ?, ?)');

            //affection des variables
            $reqUpdate->bindParam(1, $userLastName, PDO::PARAM_STR); 
            $reqUpdate->bindParam(2, $userFirstName, PDO::PARAM_STR);
            $reqUpdate->bindParam(3, $userMail, PDO::PARAM_STR);
            $reqUpdate->bindParam(4, $hashPassword, PDO::PARAM_STR);
            $reqUpdate->bindParam(5, $userImage, PDO::PARAM_STR);
            $reqUpdate->bindParam(6, $status, PDO::PARAM_STR);
            $reqUpdate->bindParam(7, $role, PDO::PARAM_INT);

            //execution de la requête
            $reqUpdate->execute();
        }
        catch(Exception $e){
            die('Error: '.$e->getMessage());
        }
    }

    function checkAccount($bdd, $userMail) {
        try{
            //préparation de la requête
            $reqExist = $bdd->prepare('SELECT mail_utilisateur FROM utilisateur WHERE mail_utilisateur=?');

            //Affection des variables
            $reqExist->bindParam(1, $userMail, PDO::PARAM_STR);

            //Execution de la requête
            $reqExist->execute();
            $result = $reqExist->fetchAll(PDO::FETCH_ASSOC); //permet de stocker les retours de la requête dans un tableau associatif
            return $result; //retournera la variable quand la fonctionsera exécutée 
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
?>