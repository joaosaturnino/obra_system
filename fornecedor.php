<?php
session_start();
include 'includes/db_connect.php';
include 'includes/functions.php';

verificarLogin(); // Verifica se o usuário está logado

// Busca todos os fornecedores
$fornecedores = buscarFornecedores($pdo);

include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Fornecedores</title>
    <link rel="stylesheet" href="css/styles1.css">
</head>
<body>
    <h1>Fornecedores</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CNPJ</th>
                <th>Endereço</th>
                <th>Telefone</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fornecedores as $fornecedor): ?>
                <tr>
                    <td><?php echo $fornecedor['id']; ?></td>
                    <td><?php echo $fornecedor['nome']; ?></td>
                    <td><?php echo $fornecedor['cnpj']; ?></td>
                    <td><?php echo $fornecedor['endereco']; ?></td>
                    <td><?php echo $fornecedor['telefone']; ?></td>
                    <td><?php echo $fornecedor['email']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div style="text-align: center; margin-top: 20px; ">
    <a href="index.php" class="btn-voltar">Voltar à Página Inicial</a>
</div>
</body>
</html>

<?php include 'includes/footer.php'; ?>