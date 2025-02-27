<?php
session_start();
include 'includes/db_connect.php';
include 'includes/functions.php';

verificarLogin(); // Verifica se o usuário está logado

// Busca todos os empreiteiros
$empreiteiros = buscarEmpreiteiros($pdo);

include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Empreiteiros</title>
    <link rel="stylesheet" href="css/styles1.css">
</head>
<body>
    <h1>Empreiteiros</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Endereço</th>
                <th>Telefone</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($empreiteiros as $empreiteiro): ?>
                <tr>
                    <td><?php echo $empreiteiro['id']; ?></td>
                    <td><?php echo $empreiteiro['nome']; ?></td>
                    <td><?php echo $empreiteiro['cpf']; ?></td>
                    <td><?php echo $empreiteiro['endereco']; ?></td>
                    <td><?php echo $empreiteiro['telefone']; ?></td>
                    <td><?php echo $empreiteiro['email']; ?></td>
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