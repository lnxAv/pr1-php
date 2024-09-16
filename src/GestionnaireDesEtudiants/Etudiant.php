<?php
    class Etudiant {
        public $nom;
        public $prenom;
        public $date_naissance;
        public $email;
        
        public function __construct($nom, $prenom, $date_naissance, $email) {
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->date_naissance = $date_naissance;
            $this->email = $email;
        }
    }
?>