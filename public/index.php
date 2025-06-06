<?php
// Ativar exibição de erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../controllers/PetController.php';
require_once '../controllers/UserController.php';

// Lógica de roteamento
$request = $_SERVER['REQUEST_URI'];
$request = parse_url($request, PHP_URL_PATH);

// Primeiro, verifique rotas com parâmetros via preg_match

// Ex: /projeto/vetz/update-pet/5
if (preg_match('#^/projeto/vetz/update-pet/(\d+)$#', $request, $matches)) {
    $id = $matches[1];
    $controller = new PetController();
    $controller->updatePet($id);
    exit;
}

// (Opcional) Ex: /projeto/vetz/delete-pet/5 (se quiser fazer delete via GET, não recomendado)
if (preg_match('#^/projeto/vetz/delete-pet/(\d+)$#', $request, $matches)) {
    $id = $matches[1];
    $controller = new PetController();
    $controller->deletePetById($id);
    exit;
}

// Roteamento padrão para rotas fixas
switch ($request) {
    case '/projeto/vetz/cadastrar':
        $controller = new UserController();
        $controller->cadastrar();
        break;

    case '/projeto/vetz/login':
        $controller = new UserController();
        $controller->login();
        break;

    case '/projeto/vetz/enviarCodigo':
        $controller = new UserController();
        $controller->enviarCodigo();
        break;

    case '/projeto/vetz/verificarCodigo':
        $controller = new UserController();
        $controller->verificarCodigo();
        break;

    case '/projeto/vetz/redefinirSenha':
        $controller = new UserController();
        $controller->redefinirSenha();
        break;

    case '/projeto/vetz/public/':
        $controller = new PetController();
        $controller->showForm();
        break;

    case '/projeto/vetz/save-pet':
        $controller = new PetController();
        $controller->savePet();
        break;

    case '/projeto/vetz/list-pet':
        $controller = new PetController();
        $controller->listPet();
        break;

    case '/projeto/vetz/delete-pet': // POST com id no body
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $controller = new PetController();
            $controller->deletePetById($_POST['id']);
        }
        break;

    case '/projeto/vetz/update-pet': // Acessado por formulário de update sem ID na URL
        $controller = new PetController();
        $controller->updatePet();
        break;

    default:
        http_response_code(404);
        echo "Página não encontrada: $request";
        break;
}
