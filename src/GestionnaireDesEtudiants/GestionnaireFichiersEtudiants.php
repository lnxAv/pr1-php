<?php 

include "GestionnaireDesEtudiants.php";
include "Etudiant.php";

class GestionnaireDesFichiersEtudiants extends GestionnaireDesEtudiants {

    protected $filePath;

    public function __construct($filePath) {
        $this->filePath = $filePath;
    }

    public function toString($student) {
      return "{$student->nom};{$student->prenom};{$student->date_naissance};{$student->email}";
    }

    public function fromString($string) { 
      list($prenom, $nom, $date_naissance, $email) = explode(';', $string);
      return new self($prenom, $nom, $date_naissance, $email);
    }
    public function test($studentTest) {
      $this->push($this->toString($studentTest));
      
    }
    public function getStudents(){}
    public function setStudents(){}
    public function putStudents(){}
    public function deleteStudents(){}
}
$gestionnaire = new GestionnaireDesFichiersEtudiants("student.txt");
$studentTest = new Etudiant('nom', 'prenom', 'date_naissance', 'email');

echo "Gestionnaire des Fichiers Etudiants object created.<br>";

$gestionnaire->test($studentTest)

?>


