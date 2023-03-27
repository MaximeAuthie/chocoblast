<?php
include '../model/utilisateur.php';
include '../utils/connectBdd.php';

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
            //préparation de la requête
            $req = $bdd->prepare('INSERT INTO utilisateur(nom_utilisateur, prenom_utilisateur, mail_utilisateur, password_utilisateur, image_utilisateur, statut_utilisateur, id_roles) VALUES
            (?, ?, ?, ?, ?, ?, ?)');

            //Affection des variables
            $req->bindParam(1, $this->getNomUtilisateur(), PDO::PARAM_STR); 
            $req->bindParam(2, $this->getPrenomUtilisateur(), PDO::PARAM_STR);
            $req->bindParam(3, $this->getMailUtilisateur(), PDO::PARAM_STR);
            $req->bindParam(4, $this->getpasswordUtilisateur(), PDO::PARAM_STR);
            $req->bindParam(5, $this->getImageUtilisateur(), PDO::PARAM_STR);
            $req->bindParam(6, $this->getStatutUtilisateur(), PDO::PARAM_STR);
            $req->bindParam(7, $this->getRoleUtilisateur(), PDO::PARAM_INT);

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