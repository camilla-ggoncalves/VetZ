<?php
require_once '../controllers/VacinacaoController.php';
require_once '../controllers/PetController.php';       // Supondo que você tenha
require_once '../controllers/UsuarioController.php';   // para listar pets e usuários

$vacinacaoController = new VacinacaoController();
$vacinas = $vacinacaoController->listarVacinas();

$petController = new PetController();
$pets = $petController->listarPets();


// Caso seja edição, carregar vacinação
$id = $_GET['id'] ?? null;
$vacinacao = null;
if ($id) {
    $vacinacao = $vacinacaoController->buscarPorId($id);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $id ? "Editar Vacinação" : "Cadastrar Vacinação" ?></title>
</head>
<body>
    <h1><?= $id ? "Editar Vacinação" : "Cadastrar Vacinação" ?></h1>

<form action="/projeto/vetz/cadastrar-vacina" method="POST">


        <?php if ($id): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($vacinacao['id']) ?>">
        <?php endif; ?>

        <label for="data">Data:</label>
        <input type="date" name="data" value="<?= $vacinacao['data'] ?? '' ?>" required><br>

        <label for="doses">Doses:</label>
        <input type="number" name="doses" min="1" value="<?= $vacinacao['doses'] ?? '' ?>" required><br>

        <label for="id_vacina">Vacina:</label>
        <select name="id_vacina" required>
            <option value="">Selecione uma vacina</option>
            <?php foreach ($vacinas as $vacina): ?>
                <option value="<?= $vacina['id_vacina'] ?>" 
                    <?= (isset($vacinacao['id_vacina']) && $vacinacao['id_vacina'] == $vacina['id_vacina']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($vacina['vacina']) ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="id_pet">Pet:</label>
<select name="id_pet" required>
    <option value="">Selecione um pet</option>
    <?php foreach ($pets as $pet): ?>
        <option value="<?= $pet['id'] ?>" 
            <?= (isset($vacinacao['id_pet']) && $vacinacao['id_pet'] == $pet['id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($pet['nome']) ?>
        </option>
    <?php endforeach; ?>
</select><br>


         <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
