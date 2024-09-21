<?php
    header('Content-Type: application/json; charset=utf-8');
    require_once "../../src/GestionnaireDesEtudiants/GestionnaireFichiersEtudiants.php";
    require_once "../../src/GestionnaireDesEtudiants/Etudiant.php";
    
    $request_method = $_SERVER['REQUEST_METHOD'];
    $gestionnaire = new GestionnaireDesFichiersEtudiants("student.txt");
    
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode('/', $uri);

    if(!(isset($uri[4]) && $uri[4] === 'etudiant.php')) {
        // IF IS NOT A REQUEST TO ETUDIANT.PHP
        header('HTTP/1.1 404 Not Found');
        $response = array("res" => null, "error" => "URI incorrect {$uri[2]}");
        $response = json_encode($response);
        echo $response;
        return;
    }

    switch ($request_method) {
        case 'GET':
            /*  give all if email not specified else specific students  
            *   @GET: .../etudiant.php/filter?info=null
            */
            if(!isset($uri[5]) && !count($_GET)) {
                $filter = 'all';
                $info = null;
            }else {
                $filter = array_keys($_GET)[0] ?? 'all';
                $info = array_values($_GET)[0] ?? null;
            }
            // send request to gestionnaire
            try {
                $result = $gestionnaire->getStudents($filter, $info);
                $response = array("res" => $result);
                $response = json_encode($result);
            } catch (Error $e) {
                $response = array("res" => null, "error" => $e->getMessage());
                $response = json_encode($response);
            } catch (Throwable $e) {
                $response = array("res" => null, "error" => ${$filter});
                $response = json_encode($response);
            }
            break;
        case 'POST':
            /* Ajoute un etudiant
            * @URI: .../etudiant.php
            * @BODY: { nom, prenom, date_naissance, email }
            */
            try {
                $data = json_decode(file_get_contents("php://input"));
                $student = new Etudiant($data->nom, $data->prenom, $data->date_naissance, $data->email);
                $result = $gestionnaire->setStudents($student);
                $response = array("res" => $result? "L'operation a réussi" : "L'operation a échoué");
                $response = json_encode($response);
            } catch (Error $e) {
                $response = array("res" => null, "error" => $e->getMessage());
                $response = json_encode($response);
            } catch (Throwable $e) {
                $response = array("res" => null, "error" => $e->getMessage());
                $response = json_encode($response);
            }
            break;
        case 'PUT':
            /* Update un etudiant 
            * @URI: .../etudiant.php/email
            * @BODY: { nom, prenom, date_naissance }
            */
            try {
                $email = $uri[5];
                $data = json_decode(file_get_contents("php://input"));
                $student = new Etudiant($data->nom, $data->prenom, $data->date_naissance, $email);
                $result = $gestionnaire->putStudents($student);
                $response = array("res" => $result? "L'operation a réussi" : "L'operation a échoué");
                $response = json_encode($response);
            } catch (Error $e) {
                $response = array("res" => null, "error" => $e->getMessage());
                $response = json_encode($response);
            } catch (Throwable $e) {
                $response = array("res" => null, "error" => $e->getMessage());
                $response = json_encode($response);
            }
            break;
        case 'DELETE':
            /* Erase a student 
            *   @URI: .../etudiant.php/email
            */
            try {
                $email = $uri[5];
                $result = $gestionnaire->deleteStudents($email);
                $response = array("res" => $result? "L'operation a réussi" : "L'operation a échoué");
                $response = json_encode($response);
            }catch (Error $e) {
                $response = array("res" => null, "error" => $e->getMessage());
                $response = json_encode($response);
            } catch (Throwable $e) {
                $response = array("res" => null, "error" => $e->getMessage());
                $response = json_encode($response);
            }
            break;
        default:
            /* Invalid request */
            $response = json_encode(array("res" => "Invalid request"));
            break;
    }
    echo $response;
?>