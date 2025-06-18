<?php
// Ativar exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../controllers/PetController.php';
require_once '../controllers/UsuarioController.php'; // Importa o controlador de usuários

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

switch ($request) { //mostra as requisições que o cliente está fazendo ao servidor, dependendo dela, muda as páginas
   
    case '/projeto/vetz/recuperarForm':
    include '../views/recuperar.php';
    break;    

    case '/projeto/vetz/cadastrar':
        $controller = new UsuarioController();
        $controller->cadastrar();
        break;

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

// Exibir o formulário de edição de usuário (GET)
if (preg_match('#^/projeto/vetz/update-usuario/(\d+)$#', $request, $matches) && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $matches[1];
    $controller = new UsuarioController();
    $controller->showUpdateForm($id);
    exit;
}

// Processar o update de usuário (POST)
if (preg_match('#^/projeto/vetz/update-usuario/(\d+)$#', $request, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $matches[1];
    $controller = new UsuarioController();
    $controller->updateUsuario($id);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UsuarioController();
    $sucesso = $controller->atualizar($_POST, $_FILES);
    if ($sucesso) {
        header('Location: /projeto/vetz/perfil-usuario/' . $_POST['id']);
        exit;
    } else {
        echo "Erro ao atualizar usuário.";
    }
} else {
    if (!isset($_GET['id'])) {
        echo "ID do usuário não especificado.";
        exit;
    }

    $controller = new UsuarioController();
    $usuario = $controller->perfil($_GET['id']);
    require_once '../../views/usuario/update_usuario.php';
}

if (!isset($_GET['id'])) {
    echo "ID não especificado.";
    exit;
}

$controller = new UsuarioController();
$sucesso = $controller->excluir($_GET['id']);

if ($sucesso) {
    echo "Usuário excluído com sucesso.";
} else {
    echo "Erro ao excluir usuário.";
}

if (!isset($_GET['id'])) {
    echo "ID não especificado.";
    exit;
}

$controller = new UsuarioController();
$usuario = $controller->perfil($_GET['id']);
require_once '../../views/usuario/perfil_usuario.php';


// Roteamento padrão fixo
switch ($request) {
    case '/projeto/vetz/cadastrarForm':
        $controller = new UsuarioController();
        $controller->cadastrarForm();
        break;
    case '/projeto/vetz/loginForm':
        $controller = new UsuarioController();  
        $controller->loginForm();
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
    case '/projeto/vetz/perfil':
        // Exemplo: require_once '../views/perfil.php';
        break;
    default:
        http_response_code(404);
        echo "Página não encontrada: $request";
        break;
    }
}