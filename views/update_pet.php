<?php
require_once '../models/Pet.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID do pet não fornecido.";
    exit;
}

$petModel = new Pet();
$pet = $petModel->getById($id);

if (!$pet) {
    echo "Pet não encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Pet</title>
</head>
<body>
    <h1>Atualizar Pet</h1>
    <form action="/projeto/vetz/update-pet" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($pet['id']) ?>">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($pet['nome']) ?>" required><br>

        <label for="raca">Raça:</label>
        <input type="text" name="raca" value="<?= htmlspecialchars($pet['raca']) ?>" required><br>

        <label for="idade">Idade:</label>
        <input type="number" name="idade" value="<?= htmlspecialchars($pet['idade']) ?>" required><br>

        <label for="porte">Porte:</label>
        <input type="text" name="porte" value="<?= htmlspecialchars($pet['porte']) ?>" required><br>

        <label for="peso">Peso:</label>
        <input type="text" name="peso" value="<?= htmlspecialchars($pet['peso']) ?>" required><br>

        <label for="sexo">Sexo:</label>
        <select name="sexo" required>
            <option value="M" <?= $pet['sexo'] === 'Macho' ? 'selected' : '' ?>>Macho</option>
            <option value="F" <?= $pet['sexo'] === 'Fêmea' ? 'selected' : '' ?>>Fêmea</option>
        </select><br>

        <label for="imagem">Imagem:</label>
        <?php if (!empty($pet['imagem'])): ?>
            <img src="/projeto/uploads/<?= htmlspecialchars($pet['imagem']) ?>" alt="Imagem atual" width="100"><br>
        <?php endif; ?>
        <input type="file" name="imagem"><br>

        <button type="submit">Atualizar</button>
    </form>
</body>
</html>
