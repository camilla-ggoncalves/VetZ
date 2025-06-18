<?php
require_once __DIR__ . '/../models/Usuario.php';

require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController {

   public function loginForm() {
        include '../views/login.php'; // Inclua o arquivo do formulário
    }
    public function cadastrarForm() {
        include '../views/cadastro.php'; // Inclua o arquivo do formulário
    }

    public function cadastrar() {
                
        var_dump($_POST);
       
        $dados = $_POST;
        $model = new Usuario();
        $ok = $model->cadastrar($dados['nome'], $dados['email'], $dados['senha']);
        if ($ok) {
            header('Location: /projeto/vetz/loginForm');
            exit;  
        } else {         
            echo "Erro ao cadastrar.";
        }
    }
    

    public function login() {

        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $model = new Usuario(); 
        $usuario = $model->autenticar($email, $senha);
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
        $codigo = rand(100000, 999999); // Gera código aleatório
        $usuario = new Usuario();
        $usuario->salvarCodigo($email, $codigo);
        // Aqui você pode enviar o e-mail real, se quiser
        echo $codigo; 
        exit;
    }

    public function verificarCodigo() {
    $email = $_POST['email'];
    $codigo = $_POST['codigo'];
    $novaSenha = $_POST['nova_senha'];
    $model = new Usuario();
    $valido = $model->verificarCodigo($email, $codigo);
    if ($valido) {
        $model->redefinirSenha($email, $novaSenha);
        echo "Senha alterada com sucesso!";
    } else {
        echo "Código inválido ou expirado.";
    }
}

    public function redefinirSenha() {
        $email = $_POST['email'];
        $novaSenha = $_POST['nova_senha'];
        $model = new Usuario(); // Corrigido aqui
        $ok = $model->redefinirSenha($email, $novaSenha);
        echo $ok ? "Senha alterada com sucesso!" : "Erro ao alterar senha.";
    }



        public function perfil($id) {
            $usuarioModel = new Usuario();
            return $usuarioModel->buscarPorId($id);
        }

        public function atualizar($dados, $file) {
            $usuarioModel = new Usuario();

            $imagem = null;
            if (isset($file['imagem']) && $file['imagem']['error'] === UPLOAD_ERR_OK) {
                $imagem = basename($file['imagem']['name']);
                move_uploaded_file($file['imagem']['tmp_name'], '../uploads/' . $imagem);
            }

            return $usuarioModel->atualizar($dados['id'], $dados['nome'], $dados['email'], $dados['senha'], $imagem);
        }

        public function excluir($id) {
            $usuarioModel = new Usuario();
            return $usuarioModel->excluir($id);
        }
    }
?>



