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

// Rotas com parâmetros dinâmicos via regex

// Pets
if (preg_match('#^/projeto/vetz/update-pet/(\d+)$#', $request, $matches)) {
    $id = $matches[1];
    $controller = new PetController();
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller->showUpdateForm($id);
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->updatePet($id);
    }
    exit;
}

if (preg_match('#^/projeto/vetz/delete-pet/(\d+)$#', $request, $matches)) {
    $id = $matches[1];
    $controller = new PetController();
    $controller->deletePetById($id);
    exit;
}

// Vacinação
if (preg_match('#^/projeto/vetz/pets/(\d+)/vacinas$#', $request, $matches)) {
    $pet_id = $matches[1];
    $controller = new VacinacaoController();
    $controller->listarPorPet($pet_id);
    exit;
}

if (preg_match('#^/projeto/vetz/pets/(\d+)/vacinas/cadastrar$#', $request, $matches)) {
    $pet_id = $matches[1];
    $controller = new VacinacaoController();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->cadastrarVacina($pet_id);
    } else {
        // Exibir formulário para cadastro de vacinação para o pet
        include '../views/vacinacao_form.php';
    }
    exit;
}

if (preg_match('#^/projeto/vetz/vacinacao/editar/(\d+)$#', $request, $matches)) {
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

if (preg_match('#^/projeto/vetz/vacinacao/excluir/(\d+)$#', $request, $matches)) {
    $id = $matches[1];
    $controller = new VacinacaoController();
    $controller->excluir($id);
    exit;
}

if (preg_match('#^/projeto/vetz/usuarios/(\d+)/pets$#', $request, $matches)) {
    $usuario_id = $matches[1];
    $controller = new PetController();
    $controller->listarPorUsuario($usuario_id); // método que você ainda vai criar
    exit;
}


if (preg_match('#^/projeto/vetz/update-usuario/(\d+)$#', $request, $matches)) {
    $id = $matches[1];
    $controller = new UsuarioController();
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller->showUpdateForm($id);
     } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->updateUsuario($id);
    }
    exit;
}


// Rotas fixas padrão
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

    case '/projeto/vetz/list-ficha':
        $controller = new FichaTecnicaController();
        $controller->listFicha();
        break;

    case '/projeto/vetz/list-usuarios':
        $controller = new UsuarioController();
        $controller->listarUsuarios();
        break;

    case '/projeto/vetz/perfil':
        $controller = new UsuarioController();
        $controller->perfil();
        break;

        
    default:
        http_response_code(404);
        echo "Página não encontrada: $request";
        break;
}
