<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Pet</title>
</head>
<body>

<h1>Atualizar Pet</h1>
<form action="/projeto/vetz/update-pet" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $petInfo['id']; ?>">

    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?php echo $petInfo['nome']; ?>" required><br><br>

    <label for="raca">Raça:</label>
    <input type="text" id="raca" name="raca" value="<?php echo $petInfo['raca']; ?>" required><br><br>

    <label for="idade">Idade:</label>
    <input type="number" id="idade" name="idade" value="<?php echo $petInfo['idade']; ?>" required><br><br>

    <label for="peso">Peso:</label>
    <input type="number" id="peso" name="peso" step="0.01" value="<?php echo $petInfo['peso']; ?>" required><br><br>

    <label for="porte">Porte:</label>
    <select id="porte" name="porte" required>
        <option value="">Selecione</option>
        <option value="pequeno" <?php if ($petInfo['porte'] == 'pequeno') echo 'selected'; ?>>Pequeno</option>
        <option value="medio" <?php if ($petInfo['porte'] == 'medio') echo 'selected'; ?>>Médio</option>
        <option value="grande" <?php if ($petInfo['porte'] == 'grande') echo 'selected'; ?>>Grande</option>
    </select><br><br>

    <label for="sexo">Sexo:</label>
    <select id="sexo" name="sexo" required>
        <option value="">Selecione</option>
        <option value="macho" <?php if ($petInfo['sexo'] == 'macho') echo 'selected'; ?>>Macho</option>
        <option value="femea" <?php if ($petInfo['sexo'] == 'femea') echo 'selected'; ?>>Fêmea</option>
    </select><br><br>

    <label>Imagem atual do Pet:</label><br>
    <img src="/projeto/vetz/public/uploads/<?php echo htmlspecialchars($petInfo['imagem']); ?>" alt="Imagem do Pet" style="max-width: 150px;"><br><br>

    <label for="imagem">Alterar imagem:</label>
    <input type="file" name="imagem" id="imagem" accept="image/*"><br><br>

    <input type="submit" value="Atualizar Pet"
</form>

<a href="/projeto/vetz/list-pet">Voltar para a lista</a>

</body>
</html>
