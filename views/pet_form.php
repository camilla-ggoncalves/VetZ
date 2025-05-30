<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Cadastrar Pet</title>
</head>
<body>
    <h1>Cadastrar / Atualizar Pet</h1>

    <!-- Se estiver editando, o campo hidden vai ter o id -->
    <form action="/projeto/vetz/public/save-pet" method="POST" enctype="multipart/form-data">
        <!-- Para editar, envie o id -->
        <?php if (!empty($petInfo['id'])): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($petInfo['id']) ?>">
        <?php endif; ?>

        <label>Nome:</label><br />
        <input type="text" name="nome" required value="<?= htmlspecialchars($petInfo['nome'] ?? '') ?>"><br /><br />

        <label>Raça:</label><br />
        <input type="text" name="raca" required value="<?= htmlspecialchars($petInfo['raca'] ?? '') ?>"><br /><br />

        <label>Idade:</label><br />
        <input type="number" name="idade" min="0" value="<?= htmlspecialchars($petInfo['idade'] ?? '') ?>"><br /><br />

        <label>Porte:</label><br />
        <input type="text" name="porte" value="<?= htmlspecialchars($petInfo['porte'] ?? '') ?>"><br /><br />

        <label>Peso (kg):</label><br />
        <input type="number" name="peso" step="0.01" min="0" value="<?= htmlspecialchars($petInfo['peso'] ?? '') ?>"><br /><br />

        <label>Sexo:</label><br />
        <select name="sexo" required>
            <option value="">Selecione</option>
            <option value="M" <?= (isset($petInfo['sexo']) && $petInfo['sexo'] == 'M') ? 'selected' : '' ?>>Macho</option>
            <option value="F" <?= (isset($petInfo['sexo']) && $petInfo['sexo'] == 'F') ? 'selected' : '' ?>>Fêmea</option>
        </select><br /><br />

        <button type="submit">Salvar</button>
    </form>
</body>
</html>
