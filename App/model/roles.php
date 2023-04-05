<?php
    class Roles {
        private ?int $id_role;
        private ?string $nom_role;

        function __construct($nom_role){
            $this->nom_role = $nom_role;
        }

        public function getIdRoles():?int {
            return $this->id_role;
        }

        public function getNomRoles():?string {
            return $this->nom_role;
        }

        public function setIdRole(?int $id_role):void {
            $this->id_role = $id_role;
        }
        public function setnomRole(?string $nom_role):void {
            $this->nom_role = $nom_role;
        }
    }
?>