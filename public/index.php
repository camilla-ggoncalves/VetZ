<?php
// Rotas

// Ativar exibição de erros para depuração
ini_set('display_errors', 1); //ini_set =função que permite modificar a configuração interna do PHP | display_errors = permite que mostre os erros | 1 = afirmação
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); //E_ALL = exibe todos os tipos de erros

require_once '../controllers/PetController.php';

// Lógica de roteamento
$request = $_SERVER['REQUEST_URI']; //requisição do HTTP cliente - servidor


switch ($request) { //mostra as requisições que o cliente está fazendo ao servidor, dependendo dela, muda as páginas
    case '/VetZ/public':
    case '/VetZ/public/index':
        $controller = new PetController(); //A classe que contém a lógica do que fazer com as requisições (por exemplo, exibir um formulário, salvar dados, excluir registros, etc.).
        $controller->showForm();
        break;
    case '/VetZ/save-pet':
        $controller = new PetController();
        $controller->savepet();                    ;
        break;
    case '/VetZ/list-pet':
        $controller = new PetController();
        $controller->listpet();
        break;
        case '/VetZ/delete-pet':
            require_once '../controllers/PetController.php';
            $controller = new PetController();
            $controller->deletepetById();
            break;
    
        case (preg_match('/\/VetZ\/update-pet\/(\d+)/', $request, $matches) ? true : false):
            $id = $matches[1];
            require_once '../controllers/PetController.php';
            $controller = new PetController();
            $controller->showUpdateForm($id);
            break;
    
        case '/VetZ/update-pet':
            require_once '../controllers/PetController.php';
            $controller = new PetController();
            $controller->updatepet();
            break;
    default:
        http_response_code(404);
        echo $request;
        echo "Página não encontrada.";
        break;
}