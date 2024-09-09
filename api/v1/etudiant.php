<?php
    $request_method = $_SERVER['REQUEST_METHOD'];
    switch ($request_method) {
        case 'GET':
            $response = "Get request";
            break;
        case 'POST':
            $response = "Post request";
            break;
        case 'PUT':
            $response = "Put request";
            break;
        case "DELETE":
            $response = "Delete request";
            break;
        default:
            $response = "Invalid request";
            break;
    }
    
    echo $response;
?>