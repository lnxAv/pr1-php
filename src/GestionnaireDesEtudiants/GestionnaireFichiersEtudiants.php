<?php 

include "GestionnaireDesEtudiants.php";
include "Etudiant.php";

class GestionnaireDesFichiersEtudiants extends GestionnaireDesEtudiants {

    protected $filePath;

    public function __construct($filePath) {
        $this->filePath = $filePath;
    }

    protected function toString($student) {
      return "{$student->nom};{$student->prenom};{$student->date_naissance};{$student->email}";
    }

    protected function fromString($string) { 
      list($prenom, $nom, $date_naissance, $email) = explode(';', $string);
      return new Etudiant($prenom, $nom, $date_naissance, $email);
    }

    public function getStudents($filter = 'all', $info = null){
      return $this->read($filter, $info);
    }

    public function setStudents($student){
      return $this->push($student);
    }

    public function putStudents($oldStudent, $newStudent){
      return $this->replace($oldStudent, $newStudent);
    }

    public function deleteStudents($student){
      return $this->remove($student);
    }
}
?>


