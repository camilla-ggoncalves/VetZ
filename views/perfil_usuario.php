<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Perfil do Usuário</title>
</head>
<body>
    <h1>Perfil do Usuário</h1>
    <p>ID: <?= htmlspecialchars($usuario['id']) ?></p>
    <p>Nome: <?= htmlspecialchars($usuario['nome']) ?></p>
    <p>Email: <?= htmlspecialchars($usuario['email']) ?></p>
    <?php if (!empty($usuario['imagem'])): ?>
        <img src="/projeto/uploads/<?= htmlspecialchars($usuario['imagem']) ?>" alt="Imagem do usuário" width="150">
    <?php endif; ?>
    <br><br>
    <a href="/projeto/vetz/update-usuario/<?= htmlspecialchars($usuario['id']) ?>">Editar</a> |
    <a href="/projeto/vetz/delete-usuario/<?= htmlspecialchars($usuario['id']) ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
</body>
</html>