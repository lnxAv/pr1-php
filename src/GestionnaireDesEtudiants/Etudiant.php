<?php namespace Modules\Gestionnaire;
class Etudiant {
    public $nom;
    public $prenom;
    public $date_naissance;
    public $email;
    
    public function __construct($nom, $prenom) {
        $this->nom = $nom;
        $this->prenom = $prenom;

    }
}

$etudiant = new Etudiant("Levi", "Loseke", "1996-09-21", "levilo97@outlook.com");

echo "Nom: " . $etudiant->nom . "<br>";
echo "Prénom: " . $etudiant->prenom . "<br>";

?>