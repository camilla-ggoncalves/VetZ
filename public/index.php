<?php
// Rotas

// Ativar exibição de erros para depuração
ini_set('display_errors', 1); //ini_set =função que permite modificar a configuração interna do PHP | display_errors = permite que mostre os erros | 1 = afirmação
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); //E_ALL = exibe todos os tipos de erros

require_once '../controllers/PetController.php';

// Lógica de roteamento
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // Requisição cliente-servidor

$basePath = 'Projeto/VetZ/public'; 
$route = str_replace($basePath, '', $request);

$controller = new PetController();

switch ($route) {
   
    case '/projeto/vetz/public/':
        $controller->showForm();
        break;
    case '/projeto/vetz/save-pet':
        $controller->savePet();
        break;
    case '/projeto/vetz/list-pet':
        $controller->listPet();
        break;
    case '/projeto/vetz/delete-pet':
        $controller->deletePetById();
        break;
    case '/projeto/vetz/update-pet':
        $controller->updatePet();
        break;
    default:
        // Rota dinâmica com ID, que muda de acordo com o conteúdo da URL
        if (preg_match('#^/update-pet/(\d+)$#', $route, $matches)) {
            $controller->showUpdateForm($matches[1]);
        } else {
            http_response_code(404);
            echo "404 - Página não encontrada<br>";
            echo "Rota: $request";
        }
        break;
}