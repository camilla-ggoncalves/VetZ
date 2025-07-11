<?php
// Ativar exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../controllers/PetController.php';
require_once '../controllers/UsuarioController.php';
require_once '../controllers/VacinacaoController.php';

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// ---------------- ROTAS DINÂMICAS ------------------

// Editar Pet (formulário)
if (preg_match('#^/projeto/vetz/update-pet/(\d+)$#', $request, $matches) && $_SERVER['REQUEST_METHOD'] === 'GET') {
    (new PetController())->showUpdateForm($matches[1]);
    exit;
}

if (preg_match('#^/projeto/vetz/update-pet/(\d+)$#', $request, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    (new PetController())->showUpdateForm($matches[1]);
    exit;
}

if (preg_match('#^/projeto/vetz/delete-pet/(\d+)$#', $request, $matches) && $_SERVER['REQUEST_METHOD'] === 'GET') {
    (new PetController())->deletePetById($matches[1]);
    exit;
}

if (preg_match('#^/projeto/vetz/delete-pet/(\d+)$#', $request, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    (new PetController())->deletePetById($matches[1]);
    exit;
}

// Editar Vacina
if (preg_match('#^/projeto/vetz/editar-vacina/(\d+)$#', $request, $matches)) {
    $controller = new VacinacaoController();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->editar($matches[1], $_POST['data'], $_POST['doses'], $_POST['id_vacina'], $_POST['id_pet'], $_POST['id_usuario']);
    } else {
        $vacina = $controller->buscarPorId($matches[1]);
        include '../views/vacinacao/editar.php';
    }
    exit;
}

// Excluir Vacina
if (preg_match('#^/projeto/vetz/excluir-vacina/(\d+)$#', $request, $matches)) {
    (new VacinacaoController())->excluir($matches[1]);
    exit;
}

// Atualizar Usuário - Exibir formulário
if (preg_match('#^/projeto/vetz/update-usuario/(\d+)$#', $request, $matches) && $_SERVER['REQUEST_METHOD'] === 'GET') {
    (new UsuarioController())->showUpdateForm($matches[1]);
    exit;
}

// Atualizar Usuário - Processar POST
if (preg_match('#^/projeto/vetz/update-usuario/(\d+)$#', $request, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    (new UsuarioController())->updateUsuario($matches[1]);
    exit;
}

// ---------------- ROTAS FIXAS ------------------
switch ($request) {

    case '/projeto/vetz/recuperarForm':
        include '../views/recuperar.php';
        break;

    case '/projeto/vetz/cadastrar':
        (new UsuarioController())->cadastrar();
        break;

    case '/projeto/vetz/cadastrarForm':
        (new UsuarioController())->cadastrarForm();
        break;

    case '/projeto/vetz/loginForm':
        (new UsuarioController())->loginForm();
        break;

    case '/projeto/vetz/login':
        (new UsuarioController())->login();
        break;

    case '/projeto/vetz/enviarCodigo':
        (new UsuarioController())->enviarCodigo();
        break;

    case '/projeto/vetz/verificarCodigo':
        (new UsuarioController())->verificarCodigo();
        break;

    case '/projeto/vetz/redefinirSenha':
        (new UsuarioController())->redefinirSenha();
        break;

    case '/projeto/vetz/public/':
        (new PetController())->showForm();
        break;

    case '/projeto/vetz/save-pet':
        (new PetController())->savePet();
        break;

    case '/projeto/vetz/list-pet':
        (new PetController())->listPet();
        break;

    case '/projeto/vetz/delete-pet':
        (new PetController())->deletePetById();
        break;

    case '/projeto/vetz/update-pet':
        (new PetController())->updatePet(); // Agora está certo, pois o ID vem do $_POST
        break;
        
    case '/projeto/vetz/cadastrar-vacina':
        (new VacinacaoController())->exibirFormulario();
        break;

    case '/projeto/vetz/salvar-vacina':
        (new VacinacaoController())->cadastrarVacina();
        break;

    case '/projeto/vetz/list-vacinas':
        (new VacinacaoController())->listVacina();
        break;

    case '/projeto/vetz/list-ficha':
        $controller = new FichaController();
        $controller->listFicha();
        break;


    case '/projeto/vetz/perfil-usuario':
        if (!isset($_GET['id'])) {
            echo "ID não especificado.";
            exit;
        }
        $controller = new UsuarioController();
        $usuario = $controller->perfil($_GET['id']);
        require_once '../views/usuario/perfil_usuario.php';
        break;

    case '/projeto/vetz/excluir-usuario':
        if (!isset($_GET['id'])) {
            echo "ID não especificado.";
            exit;
        }
        $controller = new UsuarioController();
        $sucesso = $controller->excluir($_GET['id']);
        echo $sucesso ? "Usuário excluído com sucesso." : "Erro ao excluir usuário.";
        break;

    case '/projeto/vetz/perfil':
        // Adicione a lógica se necessário
        break;

    default:
        http_response_code(404);
        echo "Página não encontrada: $request";
        break;
}
