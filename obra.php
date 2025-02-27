<?php
session_start();
include 'includes/db_connect.php';
include 'includes/functions.php';

verificarLogin(); // Verifica se o usuário está logado

// Busca todas as obras
$obras = buscarObras($pdo);

include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Obras</title>
    <link rel="stylesheet" href="css/styles1.css">
</head>
<body>
    <h1>Obras</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Cliente</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($obras as $obra): ?>
                <tr>
                    <td><?php echo $obra['id']; ?></td>
                    <td><?php echo $obra['nome']; ?></td>
                    <td><?php echo $obra['endereco']; ?></td>
                    <td>
                        <?php
                        $stmt = $pdo->prepare('SELECT nome FROM clientes WHERE id = ?');
                        $stmt->execute([$obra['cliente_id']]);
                        $cliente = $stmt->fetch();
                        echo $cliente ? $cliente['nome'] : 'Cliente não encontrado';
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div style="text-align: center; margin-top: 20px;">
    <a href="index.php" class="btn-voltar">Voltar à Página Inicial</a>
</div>
</body>
</html>

<?php include 'includes/footer.php'; ?>