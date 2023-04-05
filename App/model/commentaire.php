<?php
    class Commentaire {
        private ?int $id_commentaire;
        private ?int $note_commentaire;
        private ?string $text_commentaire;
        private ?string $date_commentaire;
        private ?bool $statut_commentaire;
        private ?Utilisateur $auteur_chocoblast;
        private ?Chocoblast $chocoblast_commentaire;

        public function getIdCommentaire():int {
            return $this->id_commentaire;
        }

        public function getNoteCommentaire():int {
            return $this->note_commentaire;
        }

        public function getTextCommentaire():string {
            return $this->text_commentaire;
        }

        public function getDateCommentaire():string {
            return $this->date_commentaire;
        }

        public function getStatutCommentaire():bool {
            return $this->statut_commentaire;
        }

        public function getAuteurChocoblast():Utilisateur {
            return $this->auteur_chocoblast;
        }

        public function getChocoblastCommentaire():Chocoblast {
            return $this->chocoblast_commentaire;
        }

        public function setNoteCommentaire(?int $note_commentaire):void {
            $this->note_commentaire = $note_commentaire;
        }

        public function setTextCommentaire(?string $text_commentaire):void {
            $this->text_commentaire = $text_commentaire;
        }

        public function setDateCommentaire(?string $date_commentaire):void {
            $this->date_commentaire = $date_commentaire;
        }

        public function setStatutCommentaire(?bool $statut_commentaire):void {
            $this->statut_commentaire = $statut_commentaire;
        }

        public function setAuteurChocoblast(?Utilisateur $auteur_chocoblast):void {
            $this->auteur_chocoblast = $auteur_chocoblast;
        }

        public function setChocoblastCommentaire(?Chocoblast $chocoblast_commentaire):void {
            $this->chocoblast_commentaire = $chocoblast_commentaire;
        }
    }
?>