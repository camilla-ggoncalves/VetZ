<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Vacinação</title>
</head>
<body>
    <h2>Cadastro de Vacinação</h2>

    <form action="/projeto/vetz/save-vacina" method="POST">
        <label>Data:</label>
        <input type="date" name="data" required><br><br>

        <label>Doses:</label>
        <input type="text" name="doses" required><br><br>

        <label>ID da Vacina:</label>
        <input type="number" name="id_vacina" required><br><br>

        <label>ID do Pet:</label>
        <input type="number" name="id_pet" required><br><br>

        <label>ID do Usuário:</label>
        <input type="number" name="id_usuario" required><br><br>

        <input type="submit" value="Salvar">
    </form>

    <br>
    <a href="/projeto/vetz/list-vacina">Voltar para lista</a>
</body>
</html>
