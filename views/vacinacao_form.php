<?php
require_once '../controllers/VacinacaoController.php';
require_once '../controllers/PetController.php';
require_once '../controllers/UsuarioController.php';

// Controlador de vacinação
$vacinacaoController = new VacinacaoController();
$vacinas = $vacinacaoController->listarVacinas(); // Lista de vacinas disponíveis no sistema

// Controlador de pets
$petController = new PetController();
$pets = $petController->listarPets(); // Lista de pets cadastrados no sistema

// Verifica se há um ID recebido via GET para edição de vacinação
$id = $_GET['id'] ?? null; // Se existir um ID na URL, armazena na variável $id; caso contrário, $id será null
$vacinacao = null; // Inicializa a variável $vacinacao como nula

if ($id) { // Se um ID foi passado (ou seja, é uma edição)
    $vacinacao = $vacinacaoController->buscarPorId($id); // Busca os dados da vacinação correspondente ao ID
}
?>

<!DOCTYPE html>
<html lang="pt-br"> <!-- Define o idioma da página como português do Brasil -->
<head>
    <meta charset="UTF-8"> <!-- Define o conjunto de caracteres como UTF-8 -->
    <!-- O título da página será "Editar Vacinação" se estiver editando, ou "Cadastrar Vacinação" se for um novo cadastro -->
    <title><?= $id ? "Editar Vacinação" : "Cadastrar Vacinação" ?></title>
</head>
<body>
    <!-- Exibe o título da página de acordo com a ação (edição ou cadastro) -->
    <h1><?= $id ? "Editar Vacinação" : "Cadastrar Vacinação" ?></h1>

<!-- Início do formulário de cadastro/edição de vacinação -->
<form action="/projeto/vetz/cadastrar-vacina" method="POST"> <!-- Envia os dados para a rota de cadastro de vacina -->

        <?php if ($id): ?> <!-- Se estiver editando uma vacinação -->
            <!-- Campo oculto que armazena o ID da vacinação para atualização no banco de dados -->
            <input type="hidden" name="id" value="<?= htmlspecialchars($vacinacao['id']) ?>">
        <?php endif; ?>

        <!-- Campo para selecionar a data da vacinação -->
        <label for="data">Data:</label>
        <input type="date" name="data" value="<?= $vacinacao['data'] ?? '' ?>" required><br>

        <!-- Campo para inserir o número de doses aplicadas -->
        <label for="doses">Doses:</label>
        <input type="number" name="doses" min="1" value="<?= $vacinacao['doses'] ?? '' ?>" required><br>

        <!-- Campo select para escolher qual vacina foi aplicada -->
        <label for="id_vacina">Vacina:</label>
        <select name="id_vacina" required>
            <option value="">Selecione uma vacina</option>
            <?php foreach ($vacinas as $vacina): ?> <!-- Percorre a lista de vacinas obtida do controlador -->
                <option value="<?= $vacina['id_vacina'] ?>">
                    <!-- Se for edição e a vacina corresponde à vacinação atual, marca como selecionada -->
                    <?= (isset($vacinacao['id_vacina']) && $vacinacao['id_vacina'] == $vacina['id_vacina']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($vacina['vacina']) ?> <!-- Nome da vacina exibido -->
                </option>
            <?php endforeach; ?>
        </select><br>

        <!-- Campo select para escolher qual pet recebeu a vacina -->
        <label for="id_pet">Pet:</label>
        <select name="id_pet" required>
            <option value="">Selecione um pet</option>
            <?php foreach ($pets as $pet): ?> <!-- Percorre a lista de pets obtida do controlador -->
                <option value="<?= $pet['id'] ?>">
                    <!-- Se for edição e o pet corresponde à vacinação atual, marca como selecionado -->
                    <?= (isset($vacinacao['id_pet']) && $vacinacao['id_pet'] == $pet['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($pet['nome']) ?> <!-- Nome do pet exibido -->
                </option>
            <?php endforeach; ?>
        </select><br>

         <!-- Botão para enviar o formulário (cadastrar ou atualizar a vacinação) -->
         <input type="submit" value="Cadastrar">
    </form>
</body>
</html>