<?php 

include "GestionnaireDesEtudiants.php";

class GestionnaireDesFichiersEtudiants extends GestionnaireDesEtudiants {

    protected $filePath;

    public function __construct($filePath) {
        $this->filePath = $filePath;
    }

    public function toString($filePath) {
      return "{$this->firstName};{$this->lastName};{$this->dob};{$this->email}";
    }

    public function fromString($data) { 
      list($firstName, $lastname, $dob, $email) = explode(';', $data);
      return new self($firstName, $lastName, $dob, $email);
    }
    public function test() {
    }
    public function getStudents(){}
    public function setStudents(){}
    public function putStudents(){}
    public function deleteStudents(){}
}
?>




__construct(filePath){
  $this->filePath = filePath
}

/* private function fromString()
* @input  - a string representing a line inside the file
* @desc   - takes in a string and format it as a student
* @return - Object Student
*/

/* private function toString()
* @input  - an object Student
* @desc   - takes a object students and format it as a string
* @return - string
*/

/* public function getStudents
* @input  - input email(optional)
* @desc   - access the file,
* if email, return specific student
* else return all students
* @return - an array students or a single student
*/

/* public function setStudents
* @input  - object Student
* @desc   - add student to the file
* if exist don't add
* else add new student
* @return - true if added, else false
* /

/* public function putStudents
* @input  - object student
* @desc   - take in existing student
* if email exits update
* else don't update
* @return - true if updated, else false
*/

/* public function deleteStudentsByEmail
* @input  - email
* @desc   - take in existing email
* if email exits delete
* else don't delete
* @return - true if deleted, else false
*/