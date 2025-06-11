<?php
// views/vacinacao/vacina_list.php
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Vacinações</title>
    <link rel="stylesheet" href="/projeto/vetz/public/assets/style.css"> <!-- se tiver um CSS -->
</head>
<body>
    <h1>Vacinações Registradas</h1>

    <a href="/projeto/vetz/cadastrar-vacina">
        <button>Cadastrar nova vacinação</button>
    </a>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Data</th>
                <th>Doses</th>
                <th>Vacina</th>
                <th>Pet</th>
                <!-- <th>Tutor</th> -->
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($vacinacoes)) : ?>
                <?php foreach ($vacinacoes as $vacina) : ?>
                    <tr>
                        <td><?= htmlspecialchars($vacina['data']) ?></td>
                        <td><?= htmlspecialchars($vacina['doses']) ?></td>
                        <td><?= htmlspecialchars($vacina['vacina']) ?></td>
                        <td><?= htmlspecialchars($vacina['nome_pet']) ?></td>
                        <td>
                            <a href="/projeto/vetz/editar-vacina/<?= $vacina['id'] ?>">Editar</a> |
                            <a href="/projeto/vetz/excluir-vacina/<?= $vacina['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir esta vacinação?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6">Nenhuma vacinação registrada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
