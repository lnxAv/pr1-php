<?php
    header('Content-Type: application/json; charset=utf-8');
    require_once "../../src/GestionnaireDesEtudiants/GestionnaireFichiersEtudiants.php";
    $request_method = $_SERVER['REQUEST_METHOD'];
    $gestionnaire = new GestionnaireDesFichiersEtudiants("student.txt");
    
    switch ($request_method) {
        case 'GET':
            /*  give all if email not specified else specific students  
            *   @REQ body: { email?: string } 
            */
            $response = json_encode(array("res" => "Get request"));
        case 'POST':
            /* Ajoute un etudiant 
            * @BODY body: { nom, prenom, date_naissance, email }
            */
            $response = json_encode(array("res" => "Post request"));
            break;
        case 'PUT':
            /* Update un etudiant 
            * @BODY body: { nom, prenom, date_naissance, email }
            */
            $response = json_encode(array("res" => "Put request"));
            break;
        case "DELETE":
            /* Erase a student 
            * @BODY body: { email }
            */
            $response = json_encode(array("res" => "Delete request"));
            break;
        default:
            /* Invalid request */
            $response = json_encode(array("res" => "Invalid request"));
            // TODO: return invalid request error
            break;
    }
    echo $response;
?>