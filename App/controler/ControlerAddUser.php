<?php
    //Déclarations des variables qui interagissent avec les vues
    $message = '';
    $navbar='';
    $deconnexion='';

    $navbar = ' <li class="nav-item">
                    <a class="nav-link" href="accueil">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="chocoblast">chocoblast</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="connexion">Connexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="inscription">Inscription</a>
                </li>';

    //Vérification du formulaire, du format de l'image, de la taille de l'image, de l'existance du compte et exécution de la fonction 'addUser'
    
    if (isset($_POST['submit_register'])) { //vérifie si le formulaire à été soumis 
        
        if (!empty($_POST['nom_utilisateur']) AND !empty($_POST['prenom_utilisateur']) AND !empty($_POST['mail_utilisateur']) AND !empty($_POST['password_utilisateur'])) { //vérifie si tous les champs nécessaires ont été saisis
            
            if (filter_var($_POST['mail_utilisateur'], FILTER_VALIDATE_EMAIL)) { //Vérifie le format de l'adresse mail 
                
                if ($_FILES['image_utilisateur']['tmp_name']) { //vérifie si une image à été importée
                        
                        $ext= ToolBox::get_file_extension($_FILES['image_utilisateur']['name']);

                        if ($ext == 'jpg' OR $ext == 'jpeg' OR $ext == 'png' or $ext == 'JPG' OR $ext == 'JPEG' OR $ext == 'PNG') { //vérifie le format de l'image importée
                           
                            if ($_FILES['image_utilisateur']['size'] <= (100 * 1024)) { //vérifie la taille de l'image importée
                                
                                //Définition des variables nécessaires pour déplacer l'image de profil
                                $origineImage = $_FILES['image_utilisateur']['tmp_name'];
                                $destinationImg = './Public/asset/image/'.$_FILES['image_utilisateur']['name'].'';
                                
                                //Appel de la fonction pour finaliser la création de l'utilisateur
                                creationCompte($_POST['nom_utilisateur'], $_POST['prenom_utilisateur'], $_POST['mail_utilisateur'], $_POST['password_utilisateur'], $origineImage, $destinationImg);
                            } else {
                                $message = ToolBox::definirMessage(2,''); //La taille de l'image est trop grande
                            }

                        } else {
                            $message = ToolBox::definirMessage(3,''); // Le format de l'image n'est pas bon
                        }

                } else {
                    $destinationImg='./Public/asset/image/default.png'; //Utilisation de l'iamge par defaut
                    //Appel de la fonction pour finaliser la création de l'utilisateur
                    creationCompte($_POST['nom_utilisateur'], $_POST['prenom_utilisateur'], $_POST['mail_utilisateur'], $_POST['password_utilisateur'],'' ,$destinationImg);
                }

            } else {
                $message = ToolBox::definirMessage(5,''); //Mauvais format de mail
            }

        } else {
            $message = ToolBox::definirMessage(4,''); //Tous les champs du formulaire ne sont pas remplis
        }

    }

    function creationCompte($nom, $prenom, $mail, $password, $origineImage, $destinationImg ) {
        
        //Traitement des donnnées du formulaire (toujours avant la création de la nouvelle instance)
        
        $nom = ToolBox::nettoyerDonnees($nom);
        $prenom = ToolBox::nettoyerDonnees($prenom);
        $mail = ToolBox::nettoyerDonnees($mail);
        $hashPassword = password_hash(ToolBox::nettoyerDonnees($password), PASSWORD_DEFAULT);
        $destinationImg = ToolBox::nettoyerDonnees($destinationImg);

        //Création de l'instance utilisateur (toujours après le nettoyage des données)
        $nouvelUtilisateur = new ManagerUtilisateur($nom, $prenom, $mail, $hashPassword);
        $nouvelUtilisateur->setImageUtilisateur($destinationImg);

        // Vérification de l'existance du compte et ajout de l'utilisateur si l'adresse mail n'est pas déjà utilisée

        global $message;

        if ($nouvelUtilisateur->getUserByMail()) {
            $message = ToolBox::definirMessage(1,'');; // L'adresse mail est déjà utilisée pour un autre compte utilisateur
        } else {
            move_uploaded_file($origineImage, $destinationImg);
            $nouvelUtilisateur->insertUser();
            $message = ToolBox::definirMessage(0,$prenom);; // Le compte à bien été créé
        }
    }

    include './App/vue/header.php';
    include './App/vue/view_add_user.php';
?>