<?php
    class Utilisateur {
        private ?int $id_utilisateur;
        private ?string $nom_utilisateur;
        private ?string $prenom_utilisateur;
        private ?string $mail_utilisateur;
        private ?string $password_utilisateur;
        private ?string $image_utilisateur;
        private ?bool $statut_utilisateur = false;
        private ?Roles $role_utilisateur;

        public function __construct( $nom_utilisateur, $prenom_utilisateur, $mail_utilisateur, $password_utilisateur) {
            $this->nom_utilisateur = $nom_utilisateur;
            $this->prenom_utilisateur = $prenom_utilisateur;
            $this->mail_utilisateur = $mail_utilisateur;
            $this->password_utilisateur = $password_utilisateur;
            $this->role_utilisateur = new Roles(null);
            $this->role_utilisateur->setIdRole(1);
        }

        public function getIdUtilisateur():int {
            return $this->id_utilisateur;
        }

        public function getNomUtilisateur():string {
            return $this->nom_utilisateur;
        }

        public function getPrenomUtilisateur():string {
            return $this->prenom_utilisateur;
        }

        public function getMailUtilisateur():string {
            return $this->mail_utilisateur;
        }

        public function getpasswordUtilisateur():string {
            return $this->password_utilisateur;
        }

        public function getImageUtilisateur():string {
            return $this->image_utilisateur;
        }

        public function getStatutUtilisateur():bool {
            return $this->statut_utilisateur;
        }

        public function getRoleUtilisateur():Roles {
            return $this->role_utilisateur;
        }
        
        public function setNomUtilisateur(?string $nom_utilisateur):void {
            $this->nom_utilisateur = $nom_utilisateur;
        }

        public function setPrenomUtilisateur(?string $prenom_utilisateur):void {
            $this->prenom_utilisateur = $prenom_utilisateur;
        }

        public function setMailUtilisateur(?string $mail_utilisateur):void {
            $this->mail_utilisateur = $mail_utilisateur;
        }

        public function setpasswordUtilisateur(?string $password_utilisateur):void {
            $this->password_utilisateur = $password_utilisateur;
        }

        public function setImageUtilisateur(?string $image_utilisateur):void {
            $this->image_utilisateur = $image_utilisateur;
        }

        public function setStatutUtilisateur(?bool $statut_utilisateur):void {
            $this->statut_utilisateur = $statut_utilisateur;
        }

        public function setRoleUtilisateur(?Roles $role_utilisateur):void {
            $this->role_utilisateur = $role_utilisateur;
        }
    }
?>