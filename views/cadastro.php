<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cadastro - VetZ</title>
  <link rel="stylesheet" href="css/cadastro.css" />
</head>
<body>    

  <!-- Cabeçalho -->
  <header class="topo">
    <div class="logo-box">
      <img src="logo.png" alt="Logo da Clínica" />
      <span class="titulo">VetZ</span>
    </div>
    <button class="voltar" onclick="history.back()">VOLTAR</button>
  </header>

  <!-- Conteúdo principal -->
  <main>
    <div class="cadastro-box">
      <h2 class="cadastro-title">Registrar-se</h2>
      <form action="/projeto/vetz/cadastrarei" method="POST">
        <input name="nome" placeholder="Nome completo" required>
        <input name="email" type="email" placeholder="Email" required>
        <input name="senha" type="password" placeholder="Senha" required>
        <button class="cadastrar" type="submit">CADASTRAR</button>
      </form>
    </div>
  </main>

  <!-- Rodapé -->
  <footer class="rodape">
    <p>Todos os direitos reservados © 2025 - VetZ</p>
    
    </div>
  </footer>

</body>
</html>
