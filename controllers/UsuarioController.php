<?php
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
        echo $codigo; // <-- Só isso! Não retorne HTML, só o código
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
}
?>


<!-- Popup para inserir código e nova senha -->
<div id="popup-codigo" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.4); z-index:1000; align-items:center; justify-content:center;">
  <div style="background:#fff; padding:30px; border-radius:15px; width:300px; margin:auto; text-align:center; position:relative;">
    <h3>Digite o código recebido</h3>
    <form action="/projeto/vetz/verificarCodigo" method="POST">
      <input name="email" id="popup-email" type="hidden">
      <input name="codigo" type="text" placeholder="Código" required style="margin-bottom:10px; width:90%;"><br>
      <input name="nova_senha" type="password" placeholder="Nova senha" required style="margin-bottom:10px; width:90%;"><br>
      <button type="submit">Trocar senha</button>
    </form>
    <button onclick="fecharPopup()" style="position:absolute; top:10px; right:10px; background:none; border:none; font-size:18px; cursor:pointer;">&times;</button>
  </div>
</div>

<script>
function mostrarPopup() {
  // Pega o e-mail digitado e coloca no popup
  var email = document.querySelector('input[name="email"]').value;
  document.getElementById('popup-email').value = email;
  setTimeout(function() {
    document.getElementById('popup-codigo').style.display = 'flex';
  }, 500); // espera meio segundo para simular envio
  return false; // impede o submit real do form de e-mail
}
function fecharPopup() {
  document.getElementById('popup-codigo').style.display = 'none';
}
</script>

