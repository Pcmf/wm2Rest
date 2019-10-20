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
require_once './class/Artigo.php';
require_once './class/Familia.php';
require_once './class/Menu.php';
require_once './class/Responsavel.php';
require_once './class/Promocao.php';
require_once './class/Area.php';
require_once './class/UpImage.php';



/**
 * POST
 */
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $postBody = file_get_contents("php://input");
    $postBody = json_decode($postBody);
    if($_GET['url']=="login"){
        $ob = new Empresa();
        echo json_encode($ob->checkuser($postBody->email, $postBody->password));
        http_response_code(200);
    } elseif ($_GET['url']=="empresas") {
        $ob = new Empresa();
        echo json_encode($ob->register($postBody->nome, $postBody->area, $postBody->email, $postBody->pass));
        http_response_code(200);        
    } elseif ($_GET['url']=="artigos") {
        $ob = new Artigo();
        echo json_encode($ob->create($postBody->empresa, $postBody));
        http_response_code(200);        
    } elseif ($_GET['url']=="responsaveis") {
        $ob = new Responsavel();
        echo json_encode($ob->create($postBody));
        http_response_code(200);        
    } elseif ($_GET['url'] == "upimage") {
        $ob = new UpImage();
        return json_encode($ob->uploadImage($postBody));
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
    } elseif($_GET['url']=="artigos"){
        $ob = new Artigo();
        if(isset($_GET['id'])){
            echo json_encode($ob->edit($_GET['empresa'], $_GET['id'], $postBody));
        } else {
            echo json_encode($ob->create($_GET['empresa'], $postBody));
        }
        http_response_code(200);
    } elseif($_GET['url']=="familias"){
        $ob = new Familia();
        if(isset($_GET['id'])){
            echo json_encode($ob->edit($_GET['empresa'], $_GET['id'], $postBody));
        } else {
            echo json_encode($ob->create($_GET['empresa'], $postBody));
        }
        http_response_code(200);
    } elseif($_GET['url']=="menu"){
        $ob = new Menu();
        if(isset($_GET['artigo'])){
            echo json_encode($ob->edit($_GET['empresa'], $_GET['id'], $postBody));
        } else {
            echo json_encode($ob->create($_GET['empresa'], $postBody));
        }
        http_response_code(200);
    }
    
    // GETS
} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
    //ARTIGO
    if($_GET['url']=="artigos"){
        $ob = new Artigo();
        if(isset($_GET['empresa']) && isset($_GET['id'])){
            echo json_encode($ob->getOne($_GET['empresa'], $_GET['id']));
            http_response_code(200);
        } elseif(isset($_GET['empresa'])) {
            echo json_encode($ob->getAll($_GET['empresa']));
            http_response_code(200);
        }
    //EMPRESA
    } elseif($_GET['url']=="empresas"){
        $ob = new Empresa();
        if(isset($_GET['id'])){
            echo json_encode($ob->getOne($_GET['id']));
            http_response_code(200);
        } else {
            echo json_encode($ob->getAll());
            http_response_code(200);
        }
    //FAMILIA
    } elseif($_GET['url']=="familias"){
        $ob = new Familia();
        if(isset($_GET['id'])){
            echo json_encode($ob->getOne($_GET['empresa'], $_GET['id']));
            http_response_code(200);
        } else {
            echo json_encode($ob->getAll($_GET['empresa']));
            http_response_code(200);
        }
    } elseif($_GET['url']=="menu"){
        $ob = new Menu();
        if(isset($_GET['familia'])){
            echo json_encode($ob->getByFamilia($_GET['empresa'], $_GET['familia']));
            http_response_code(200);
        } else {
            echo json_encode($ob->getAll($_GET['empresa']));
            http_response_code(200);
        }
    }
} 