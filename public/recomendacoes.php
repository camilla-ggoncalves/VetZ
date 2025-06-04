<?php
require_once __DIR__ . '/../config/database_site.php';

// Consulta para buscar as fichas técnicas dos animais
$sql = "SELECT id, nome_comum, nome_cientifico, habitat, alimentacao, tamanho_peso, curiosidades, descricao, imagem FROM ficha_tecnica";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Recomendações - VetZ</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 30px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f5f5f5; }
        img { max-width: 120px; height: auto; }
    </style>
</head>
<body>
    <h1>Recomendações - Fichas Técnicas dos Animais</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome Comum</th>
                <th>Nome Científico</th>
                <th>Habitat</th>
                <th>Alimentação</th>
                <th>Tamanho/Peso</th>
                <th>Curiosidades</th>
                <th>Descrição</th>
                <th>Imagem</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['nome_comum']) ?></td>
                        <td><?= htmlspecialchars($row['nome_cientifico']) ?></td>
                        <td><?= htmlspecialchars($row['habitat']) ?></td>
                        <td><?= htmlspecialchars($row['alimentacao']) ?></td>
                        <td><?= htmlspecialchars($row['tamanho_peso']) ?></td>
                        <td><?= htmlspecialchars($row['curiosidades']) ?></td>
                        <td><?= htmlspecialchars($row['descricao']) ?></td>
                        <td>
                            <?php if (!empty($row['imagem'])): ?>
                                <img src="../views/<?= htmlspecialchars($row['imagem']) ?>" alt="<?= htmlspecialchars($row['nome_comum']) ?>">
                            <?php else: ?>
                                Sem imagem
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="9">Nenhum animal cadastrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
<?php $conn->close(); ?>
