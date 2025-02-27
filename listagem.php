<?php
session_start();
include 'includes/db_connect.php';
include 'includes/functions.php';

verificarLogin(); // Verifica se o usuário está logado

// Busca todos os clientes, obras, fornecedores e empreiteiros
$clientes = buscarClientes($pdo);
$obras = buscarObras($pdo);
$fornecedores = buscarFornecedores($pdo);
$empreiteiros = buscarEmpreiteiros($pdo);

include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Dados</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Listagem de Dados</h1>

    <!-- Listagem de Clientes -->
    <h2>Clientes</h2>
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
            <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?php echo $cliente['id']; ?></td>
                    <td><?php echo $cliente['nome']; ?></td>
                    <td><?php echo $cliente['cpf']; ?></td>
                    <td><?php echo $cliente['endereco']; ?></td>
                    <td><?php echo $cliente['telefone']; ?></td>
                    <td><?php echo $cliente['email']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Listagem de Obras -->
    <h2>Obras</h2>
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

    <!-- Listagem de Fornecedores -->
    <h2>Fornecedores</h2>
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

    <!-- Listagem de Empreiteiros -->
    <h2>Empreiteiros</h2>
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