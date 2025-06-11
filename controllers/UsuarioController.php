<?php


require_once '../models/Usuario.php';
require_once '../controllers/UsuarioController.php';

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
            header('Location: login.html');
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
    public function updateUsuarios($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new usuario();
            $usuario->id = $_POST['id'];
            $usuario->nome = $_POST['nome'];
            $usuario->email = $_POST['email'];
            $usuario->senha = $_POST['senha'];

            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
                $nomeImagem = uniqid() . '.' . $extensao;
                $caminhoDestino = __DIR__ . '/../uploads/' . $nomeImagem;

                if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoDestino)) {
                    $usuario->imagem = $nomeImagem;
                } else {
                    echo "Erro ao mover a nova imagem.";
                    return;
                }
            } 
            

            if ($usuario->update()) {
                header('Location: /projeto/vetz/list-usuario');
                exit;
            } else {
                echo "Erro ao atualizar o usuário.";
            }
        }
    }
}

