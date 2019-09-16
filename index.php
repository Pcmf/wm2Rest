<?php
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
	header('Access-Control-Allow-Headers: token, Content-Type');
	die();
}
 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once './class/Empresa.php';

/**
 * POST
 */
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $postBody = file_get_contents("php://input");
    $postBody = json_decode($postBody);
    if($_GET['url']=="login"){
        $ob = new Empresa();
        echo json_encode($ob->login($postBody));
        http_response_code(200);
    } elseif ($_GET['url']=="empresas") {
        $ob = new Empresa();
        echo json_encode($ob->register($postBody->nome, $postBody->area, $postBody->email, $postBody->pass));
        http_response_code(200);        
    }
    // PUTS
} elseif ($_SERVER['REQUEST_METHOD'] == "PUT") {
    $postBody = file_get_contents("php://input");
    $postBody = json_decode($postBody);
    if($_GET['url']=="empresas"){
        $ob = new Empresa();
        echo json_encode($ob->edit($_GET['id'], $postBody));
        http_response_code(200);
    }
}