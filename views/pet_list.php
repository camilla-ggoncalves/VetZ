<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet">
    <title>Pet Cadastrados</title>
</head>
<body>

<h1>Pacientes Cadastrados</h1>
<table border="1">
    <tr>
        <th>Nome</th>
        <th>Raça</th>
        <th>Idade</th>
        <th>Porte</th>
        <th>Peso</th>
        <th>Sexo</th>
        <th>Imagem</th>
    </tr>
    <?php foreach ($pets as $pet): ?>
    <tr> <!-- Tabela de valor dentro de Book -->
        <td><?php echo $pet['nome']; ?></td>
        <td><?php echo $pet['raca']; ?></td>
        <td><?php echo $pet['idade']; ?></td>
        <td><?php echo $pet['porte']; ?></td>
        <td><?php echo $pet['peso']; ?></td>
        <td><?php echo $pet['sexo']; ?></td>
        <td><img src="/public/uploads/<?= htmlspecialchars($pet['imagem']) ?>" alt="Imagem do pet" width="150"></td>


            <!-- Link para atualizar o pet -->
            <a href="projeto/vetz/update-pet/<?php echo $pet['id']; ?>">Atualizar</a>
            <!-- Formulário para deletar o pet -->
            <form action="projeto/vetz/delete-pet" method="POST" style="display:inline;">
                <input type="hidden" name="id" value="<?php echo $pet['id']; ?>">
                <button type="submit">Excluir</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<a href="projeto/vetz/public">Cadastrar novo pet</a>

</body>
</html>