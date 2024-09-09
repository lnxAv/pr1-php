<?php
    include "GestionnaireDesEtudiants.php";

    $g = new GestionnaireFichiersEtudiants('student.txt');

    $g->test();
?>