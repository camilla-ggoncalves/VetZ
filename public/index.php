<?php
// Rotas

// Ativar exibição de erros para depuração
ini_set('display_errors', 1); //ini_set =função que permite modificar a configuração interna do PHP | display_errors = permite que mostre os erros | 1 = afirmação
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); //E_ALL = exibe todos os tipos de erros

require_once '../controllers/PetController.php';
require_once '../controllers/FichaTecnicaController.phpController.php';
require_once '../controllers/UserController.php'; // Importa o controlador de usuários

// Lógica de roteamento
$request = $_SERVER['REQUEST_URI']; // Requisição cliente-servidor


switch ($request) { //mostra as requisições que o cliente está fazendo ao servidor, dependendo dela, muda as páginas  

    case '/vetz/cadastrar':
        $controller = new UserController();
        $controller->cadastrar();
        break;
    case '/vetz/login':
        $controller = new UserController();
        $controller->login();
        break;
    case 'vetz/enviarCodigo':
        $controller = new UserController();
        $controller->enviarCodigo();
        break;
    case 'vetz/verificarCodigo':
        $controller = new UserController();
        $controller->verificarCodigo();
        break;
    case 'vetz/redefinirSenha':    
        $controller = new UserController();
        $controller->redefinirSenha();
        break;
    case '/projeto/vetz/public/':
        $controller = new PetController(); //A classe que contém a lógica do que fazer com as requisições (por exemplo, exibir um formulário, salvar dados, excluir registros, etc.).
        $controller->showForm();
        break;

    case '/projeto/vetz/save-pet':
        $controller = new PetController();
        $controller->savePet();                    ;
        break;
    case '/projeto/vetz/list-pet':
        $controller = new PetController();
        $controller->listPet();
        break;
        case '/projeto/vetz/delete-pet':
            require_once '../controllers/PetController.php';
            $controller = new PetController();
            $controller->deletePetById();
            break;
    
        case (preg_match('/\/vetz\/update-pet\/(\d+)/', $request, $matches) ? true : false):
            $id = $matches[1];
            require_once '../controllers/PetController.php';
            $controller = new PetController();
            $controller->showUpdateForm($id);
            break;
    
        case '/projeto/vetz/update-pet':
            require_once '../controllers/PetController.php';
            $controller = new PetController();
            $controller->updatePet();
            break;

            case '/projeto/vetz/list-ficha':
        $controller = new FichaController();
        $controller->listFicha();
        break;
            
    default:
        http_response_code(404);
        echo $request;
        echo "Página não encontrada.";
        break;
 }