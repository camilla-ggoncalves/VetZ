<<<<<<< HEAD
                                            <?php

require_once '../models/Usuario.php';
=======
<?php
require_once __DIR__ . '../models/Usuario.php';
>>>>>>> 96a34f25ca9c845c51b6f4c5090dec726bed3ff2


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
}

