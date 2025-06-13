<?php
// Ativar exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../controllers/PetController.php';
require_once '../controllers/FichaTecnicaController.php';
require_once '../controllers/UsuarioController.php'; 
require_once '../controllers/VacinacaoController.php';

$request = $_SERVER['REQUEST_URI'];
$request = parse_url($request, PHP_URL_PATH);

// Primeiras rotas com parâmetros dinâmicos via REGEX
// Exibir o formulário de edição (GET)
if (preg_match('#^/projeto/vetz/update-pet/(\d+)$#', $request, $matches) && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $matches[1];
    $controller = new PetController();
    $controller->showUpdateForm($id);
    exit;
}

// Processar o update (POST)
if (preg_match('#^/projeto/vetz/update-pet/(\d+)$#', $request, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $matches[1];
    $controller = new PetController();
    $controller->updatePet($id);
    exit;
}

if (preg_match('#^/projeto/vetz/delete-pet/(\d+)$#', $request, $matches)) {
    $id = $matches[1];
    $controller = new PetController();
    $controller->deletePetById($id);
    exit;
}

if (preg_match('#^/projeto/vetz/editar-vacina/(\d+)$#', $request, $matches)) {
    $id = $matches[1];
    $controller = new VacinacaoController();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->editar(
            $id,
            $_POST['data'],
            $_POST['doses'],
            $_POST['id_vacina'],
            $_POST['id_pet'],
            $_POST['id_usuario']
        );
    } else {
        $vacina = $controller->buscarPorId($id);
        include '../views/vacinacao/editar.php';
    }
    exit;
}

if (preg_match('#^/projeto/vetz/excluir-vacina/(\d+)$#', $request, $matches)) {
    $id = $matches[1];
    $controller = new VacinacaoController();
    $controller->excluir($id);
    exit;
}

// Roteamento padrão fixo
switch ($request) {
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

    case '/projeto/vetz/update-pet':
        $controller = new PetController();
        $controller->updatePet(); // POST do formulário
        break;

    case '/projeto/vetz/delete-pet':
        $controller = new PetController();
        $controller->deletePetById(); // POST do formulário
        break;

    if (preg_match('#^/projeto/vetz/delete-pet/(\d+)$#', $request, $matches)) {
    $id = $matches[1];
    $controller = new PetController();
    $controller->deletePet($id);
    exit;
}

if (preg_match('#^/projeto/vetz/cadastrar-vacina/(\d+)$#', $request, $matches)) {
    $id = $matches[1];
    $controller = new VacinacaoController();
    $controller->cadastrarVacina($id);
    
    exit;
}

    case '/projeto/vetz/list-vacinas':
        $controller = new VacinacaoController();
        $controller->listVacina();
        break;

    case '/projeto/vetz/cadastrar-vacina':
            $controller = new VacinacaoController();
            $controller->cadastrarVacina();
            include '../views/vacinacao_form.php'; // Exibe o formulário de cadastro
        break;

    case '/projeto/vetz/cadastrar':
        $controller = new UsuarioController();
        $controller->cadastrar();
        break;

    case '/projeto/vetz/login':
        $controller = new UsuarioController();
        $controller->login();
        break;

    case '/projeto/vetz/enviarCodigo':
        $controller = new UsuarioController();
        $controller->enviarCodigo();
        break;

    case '/projeto/vetz/verificarCodigo':
        $controller = new UsuarioController();
        $controller->verificarCodigo();
        break;

    case '/projeto/vetz/redefinirSenha':
        $controller = new UsuarioController();
        $controller->redefinirSenha();
        break;

    case '/projeto/vetz/cadastrarei':
        $controller = new UsuarioController();
        $controller->cadastrar();
        break;

    case '/projeto/vetz/list-ficha':
        $controller = new FichaController();
        $controller->listFicha();
        break;

    case '/projeto/vetz/update-usuario':
        $controller = new UsuarioController();
        $controller->updateUsuario(); // POST do formulário
        include '../views/update_usuario.php';
        break;

    default:
        http_response_code(404);
        echo "Página não encontrada: $request";
        break;
}
