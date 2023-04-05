<?php
    class Chocoblast {
        private ?int $id_chocoblast;
        private ?string $slogan_chocoblast;
        private ?string $date_chocoblast;
        private ?bool $statut_chocoblast;
        private ?Utilisateur $cible_chocoblast;
        private ?Utilisateur $auteur_chocoblast;

        public function __construct($slogan_chocoblast, $date_chocoblast) {
            $this->slogan_chocoblast = $slogan_chocoblast;
            $this->date_chocoblast = $date_chocoblast;
            $this->cible_chocoblast = new Utilisateur(null, null, null, null, null);
            $this->auteur_chocoblast = new Utilisateur(null, null, null, null, null);
            $this->statut_chocoblast = 1;
        }

        public function getIdChocoblast():int {
            return $this->id_chocoblast;
        }

        public function getSloganChocoblast():string {
            return $this->slogan_chocoblast;
        }

        public function getDateChocoblast():string {
            return $this->date_chocoblast;
        }
        
        public function getStatutChocoblast():bool {
            return $this->statut_chocoblast;
        }

        public function getCibleChocoblast():Utilisateur {
            return $this->cible_chocoblast;
        }

        public function getAuteurChocoblast():Utilisateur {
            return $this->auteur_chocoblast;
        }

        public function setSloganChocoblast(?int $id_chocoblast):void {
            $this->id_chocoblast = $id_chocoblast;
        }

        public function setDateChocoblast(?string $date_chocoblast):void {
            $this->date_chocoblast = $date_chocoblast;
        }

        public function setStatutChocoblast(?bool $statut_chocoblast):void {
            $this->statut_chocoblast = $statut_chocoblast;
        }

        public function setCibleChocoblast(?Utilisateur $cible_chocoblast):void {
            $this->cible_chocoblast = $cible_chocoblast;
        }
        
        public function setAuteurChocoblast(?Utilisateur $auteur_chocoblast):void {
            $this->auteur_chocoblast = $auteur_chocoblast;
        }
    }


?>