<?php
require_once '../models/Vacinacao.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID da vacinação não fornecido.";
    exit;
}

$vacinacaoModel = new Vacinacao();
$vacina = $vacinacaoModel->buscarPorId($id);

if (!$vacina) {
    echo "Vacinação não encontrada.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Vacinação</title>
</head>
<body>
    <h1>Atualizar Vacinação</h1>
    <form action="/projeto/vetz/update-vacinacao" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($vacina['id']) ?>">

        <label for="data">Data:</label>
        <input type="date" name="data" value="<?= htmlspecialchars($vacina['data']) ?>" required><br>

        <label for="doses">Doses:</label>
        <input type="number" name="doses" min="1" value="<?= htmlspecialchars($vacina['doses']) ?>" required><br>

        <label for="id_vacina">ID da Vacina:</label>
        <input type="number" name="id_vacina" value="<?= htmlspecialchars($vacina['id_vacina']) ?>" required><br>

        <label for="id_pet">ID do Pet:</label>
        <input type="number" name="id_pet" value="<?= htmlspecialchars($vacina['id_pet']) ?>" required><br>

        <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($vacina['id_usuario']) ?>">

        <button type="submit">Atualizar</button>
    </form>
</body>
</html>
