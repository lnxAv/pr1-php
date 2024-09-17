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

    public function testWithStudent($studentTest) {
      $this->push($this->toString($studentTest));
  }

  public function test() {
      $defaultStudent = new Etudiant('Nom', 'Prenom', 'Date', 'email@example.com');
      $this->testWithStudent($defaultStudent);
  }


    public function getStudents(){}
    public function setStudents(){}
    public function putStudents(){}
    public function deleteStudents(){}
}

$gestionnaire = new GestionnaireDesFichiersEtudiants("student.txt");
$etudiantTest = new Etudiant('Dupont', 'Jean', '1990-01-01', 'jean.dupont@email.com');
$gestionnaire->testWithStudent($etudiantTest);


?>


