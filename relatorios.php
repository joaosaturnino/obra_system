<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}
include 'includes/db_connect.php';
include 'includes/header.php';

$obras = $pdo->query('SELECT obras.nome AS obra_nome, clientes.nome AS cliente_nome FROM obras JOIN clientes ON obras.cliente_id = clientes.id')->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatórios</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Relatórios de Obras</h1>
    <table>
        <thead>
            <tr>
                <th>Obra</th>
                <th>Cliente</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($obras as $obra): ?>
                <tr>
                    <td><?php echo $obra['obra_nome']; ?></td>
                    <td><?php echo $obra['cliente_nome']; ?></td>
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