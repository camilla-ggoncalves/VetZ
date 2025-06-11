<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets Cadastrados</title>
</head>
<body>

<h1>Pets Cadastrados</h1>

<table border="1">
    <tr>
        <th>Nome</th>
        <th>Raça</th>
        <th>Idade</th>
        <th>Porte</th>
        <th>Peso</th>
        <th>Sexo</th>
        <th>Imagem</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($pets as $pet): ?>
    <tr>
        <td><?= htmlspecialchars($pet['nome']) ?></td>
        <td><?= htmlspecialchars($pet['raca']) ?></td>
        <td><?= htmlspecialchars($pet['idade']) ?></td>
        <td><?= htmlspecialchars($pet['porte']) ?></td>
        <td><?= htmlspecialchars($pet['peso']) ?></td>
        <td><?= htmlspecialchars($pet['sexo']) ?></td>
        <td>
            <img src="/public/uploads/<?= htmlspecialchars($pet['imagem']) ?>" alt="Imagem do pet" width="150">
        </td>
        <td>
            
            <a href="/projeto/vetz/update-pet/<?= $pet['id'] ?>">Editar</a>
            <a href="/projeto/vetz/delete-pet/<?= $pet['id'] ?>">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<br>
<a href="/projeto/vetz/public">Cadastrar novo pet</a>
<a href="/projeto/vetz/cadastrar-vacina">Adicionar Vacina</a>

</body>
</html>
