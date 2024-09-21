<?php
include "GestionnaireDesEtudiants.php";

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
      if(!$filter) $filter = 'all';
      if(!$info) $info = null;
      return $this->read($filter, $info);
    }

    public function setStudents($student){
      return $this->push($student);
    }

    public function putStudents($student){
      return $this->replace($student);
    }

    public function deleteStudents($email){
      return $this->remove($email);
    }
}
?>


