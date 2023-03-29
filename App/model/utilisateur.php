<?php
    class Utilisateur {
        private $id_utilisateur;
        private $nom_utilisateur;
        private $prenom_utilisateur;
        private $mail_utilisateur;
        private $password_utilisateur;
        private $image_utilisateur;
        private $statut_utilisateur = false;
        private $role_utilisateur = 1;

        public function __construct( $nom_utilisateur, $prenom_utilisateur, $mail_utilisateur, $password_utilisateur) {
            $this->nom_utilisateur = $nom_utilisateur;
            $this->prenom_utilisateur = $prenom_utilisateur;
            $this->mail_utilisateur = $mail_utilisateur;
            $this->password_utilisateur = $password_utilisateur;
        }

        public function getIdUtilisateur() {
            return $this->id_utilisateur;
        }

        public function getNomUtilisateur() {
            return $this->nom_utilisateur;
        }

        public function getPrenomUtilisateur() {
            return $this->prenom_utilisateur;
        }

        public function getMailUtilisateur() {
            return $this->mail_utilisateur;
        }

        public function getpasswordUtilisateur() {
            return $this->password_utilisateur;
        }

        public function getImageUtilisateur() {
            return $this->image_utilisateur;
        }

        public function getStatutUtilisateur() {
            return $this->statut_utilisateur;
        }

        public function getRoleUtilisateur() {
            return $this->role_utilisateur;
        }
        
        public function setNomUtilisateur($nom_utilisateur) {
            $this->nom_utilisateur = $nom_utilisateur;
        }

        public function setPrenomUtilisateur($prenom_utilisateur) {
            $this->prenom_utilisateur = $prenom_utilisateur;
        }

        public function setMailUtilisateur($mail_utilisateur) {
            $this->mail_utilisateur = $mail_utilisateur;
        }

        public function setpasswordUtilisateur($password_utilisateur) {
            $this->password_utilisateur = $password_utilisateur;
        }

        public function setImageUtilisateur($image_utilisateur) {
            $this->image_utilisateur = $image_utilisateur;
        }

        public function setStatutUtilisateur($statut_utilisateur) {
            $this->statut_utilisateur = $statut_utilisateur;
        }

        public function setRoleUtilisateur($role_utilisateur) {
            $this->role_utilisateur = $role_utilisateur;
        }
    }
?>