<!-- views/usuarios_list.php -->
<h2>Lista de Tutores</h2>

<table border="1">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= htmlspecialchars($usuario['nome']) ?></td>
                <td><?= htmlspecialchars($usuario['email']) ?></td>
                <td>
                    <a href="/projeto/vetz/pets-usuario/<?= $usuario['id'] ?>">Ver Pets</a> |
                    <a href="/projeto/vetz/update-usuario/<?= $usuario['id'] ?>">Editar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p>
    <a href="/projeto/vetz/cadastrar-usuario">Cadastrar Novo Perfil</a>
</p>
