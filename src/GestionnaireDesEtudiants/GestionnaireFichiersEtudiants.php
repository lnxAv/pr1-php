<?php
include "GestionnaireDesEtudiants.php";

class GestionnaireDesFichiersEtudiants extends GestionnaireDesEtudiants {

    private $filePath;

    public function __construct($filePath) {
        $this->filePath = $filePath;
    }

    public function toString() {

    }

    public function fromString() {
    }

    public function test() {
  
    }
}

?>