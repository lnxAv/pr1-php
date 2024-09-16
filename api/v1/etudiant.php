<?php
    use Module\Gestionnaire\Etudiant;
    use Module\Gestionnaire\GestionnaireFichesEtudiants;

    $gestionnaire = new GestionnaireFichesEtudiants("student.txt");

    $request_method = $_SERVER['REQUEST_METHOD'];
    switch ($request_method) {
        case 'GET':
            /*  give all if email not specified else specific students  
            *   @REQ body: { email?: string } 
            */
            $response = "Get request";
            if(isset($_GET['email'])){
                $response = $gestionnaire->getStudents($_POST['email']);
            }else{
                $response = $gestionnaire->getStudents();
            }
            break;
        case 'POST':
            /* Ajoute un etudiant 
            * @BODY body: { nom, prenom, date_naissance, email }
            */
            $response = "Post request";
            $student = new Etudiant($_POST['nom'], $_POST['prenom'], $_POST['date_naissance'], $_POST['email']);
            $gestionnaire->setStudents($student);
            break;
        case 'PUT':
            /* Update un etudiant 
            * @BODY body: { nom, prenom, date_naissance, email }
            */
            $response = "Put request";
            $student = new Etudiant($_POST['nom'], $_POST['prenom'], $_POST['date_naissance'], $_POST['email']);
            $gestionnaire->putStudents($student);
            break;
        case "DELETE":
            /* Erase a student 
            * @BODY body: { email }
            */
            $response = "Delete request";
            if(isset($_POST['email'])){
                $response = $gestionnaire->deleteStudents($_POST['email']);
            } else {
                // TODO: return no email error
            }
            break;
        default:
            /* Invalid request */
            $response = "Invalid request";
            // TODO: return invalid request error
            break;
    }
    
    echo $response;
?>