<?php


require_once '../models/Usuario.php';

require_once __DIR__ . '/../models/Usuario.php';



class UsuarioController {
    private $model;

    public function __construct() {
        $this->model = new Usuario();
    }

    public function cadastrar() {
       
        $dados = $_POST;
        $ok = $this->model->cadastrar($dados['nome'], $dados['email'], $dados['senha']);
        if ($ok) {
            header('Location: login.php');
            exit;
        } else {
            echo "Erro ao cadastrar.";
        }
    }
    

    public function login() {
        //$email = $_POST['email'];
        //$senha = $_POST['senha'];
        $usuario = $this->model->autenticar($email, $senha);
        if ($usuario) {
            // Aqui você pode iniciar a sessão e redirecionar para o perfil
            session_start();
            $_SESSION['usuario'] = $usuario;
            header('Location: perfil.html');
            exit;
        } else {
            echo "Credenciais inválidas.";
        }
    }

    public function enviarCodigo() {
        $email = $_POST['email'];
        $codigo = rand(100000, 999999);
        $this->model->salvarCodigo($email, $codigo);
        echo "Código enviado: $codigo (simulação de envio)";
    }

    public function verificarCodigo() {
        $email = $_POST['email'];
        $codigo = $_POST['codigo'];
        $valido = $this->model->verificarCodigo($email, $codigo);
        echo $valido ? "Código verificado!" : "Código inválido ou expirado.";
    }

    public function redefinirSenha() {
        $email = $_POST['email'];
        $novaSenha = $_POST['nova_senha'];
        $ok = $this->model->redefinirSenha($email, $novaSenha);
        echo $ok ? "Senha alterada com sucesso!" : "Erro ao alterar senha.";
    }

    // Método para atualizar um usuário
    public function perfil() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header('Location: login.php');
            exit;
        }
        $usuario = $_SESSION['usuario']; // usuário logado

        // Aqui você pode pegar do banco a imagem, etc, se quiser atualizar os dados
        include '../views/perfil_usuario.php';
    }

    public function showUpdateForm($id) {
        $usuario = $this->model->getById($id);
        if (!$usuario) {
            echo "Usuário não encontrado.";
            exit;
        }
        include '../views/update_usuario.php';
    }

public function updateUsuario($id) {
    $usuario = $this->model->getById($id);
    if (!$usuario) {
        echo "Usuário não encontrado.";
        exit;
    }

    // Atualiza somente o que veio do post
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $imagem = '';

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $nomeImagem = uniqid() . '.' . $extensao;
        $caminhoDestino = __DIR__ . '/../uploads/' . $nomeImagem;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoDestino)) {
            $imagem = $nomeImagem;
        }
    } else {
        $imagem = $usuario['imagem'] ?? '';
    }

    $ok = $this->model->updateUsuario($id, $nome, $email, $senha, $imagem);

    if ($ok) {
        header('Location: /projeto/vetz/perfil');
        exit;
    } else {
        echo "Erro ao atualizar usuário.";
    }
}
    public function excluir($id) {
        $ok = $this->model->excluir($id);
        if ($ok) {
            header('Location: /projeto/vetz/login');
            exit;
        } else {
            echo "Erro ao excluir usuário.";
        }
    }
}