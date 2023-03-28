<?php
// include '../model/utilisateur.php';
// include '../utils/connectBdd.php';

class ManagerUtilisateur extends Utilisateur {

    public function getUserByMail() {
        try {
            $bdd = BddConnect::connexion();
            $mail = $this->getMailUtilisateur();
            //préparation de la requête
            $req = $bdd->prepare('SELECT id_utilisateur, nom_utilisateur, prenom_utilisateur, mail_utilisateur, password_utilisateur, image_utilisateur, statut_utilisateur, id_roles FROM utilisateur WHERE mail_utilisateur=?');

            //Affection des variables
            $req->bindParam(1, $mail, PDO::PARAM_STR);

            //Execution de la requête
            $req->execute();
            $data = $req->fetchAll(PDO::FETCH_ASSOC); //permet de stocker les retours de la requête dans un tableau associatif
            return $data; //retournera la variable quand la fonctionsera exécutée 
        } catch (Exception $e) {
            die ('Error: '.$e->getMessage());
        }
    }

    public function insertUser() {
        try {
            $bdd = BddConnect::connexion();
            $nom = $this->getNomUtilisateur();
            $prenom = $this->getPrenomUtilisateur();
            $mail = $this->getMailUtilisateur();
            $password = $this->getpasswordUtilisateur();
            $image = $this->getImageUtilisateur();
            $statut = $this->getStatutUtilisateur();
            $role = $this->getRoleUtilisateur();

            //préparation de la requête
            $req = $bdd->prepare('INSERT INTO utilisateur(nom_utilisateur, prenom_utilisateur, mail_utilisateur, password_utilisateur, image_utilisateur, statut_utilisateur, id_roles) VALUES
            (?, ?, ?, ?, ?, ?, ?)');

            //Affection des variables
            $req->bindParam(1, $nom, PDO::PARAM_STR); 
            $req->bindParam(2, $prenom, PDO::PARAM_STR);
            $req->bindParam(3, $mail, PDO::PARAM_STR);
            $req->bindParam(4, $password, PDO::PARAM_STR);
            $req->bindParam(5, $image, PDO::PARAM_STR);
            $req->bindParam(6, $statut, PDO::PARAM_STR);
            $req->bindParam(7, $role, PDO::PARAM_INT);

            //Execution de la requête
            $req->execute();
        } catch (Exception $e) {
            die ('Error: '.$e->getMessage());
        }
    }

    public function activeUser() {
        try {
            $bdd = BddConnect::connexion();
            //préparation de la requête
            $req = $bdd->prepare('UPDATE utilisateur SET +<  WHERE id_utilisateur = ?');

            //Affection des variables
            $req->bindParam(1, $this->getIdUtilisateur(), PDO::PARAM_STR); 

            //Execution de la requête
            $req->execute();
        } catch (Exception $e) {
            die ('Error: '.$e->getMessage());
        }
    }

}

?>