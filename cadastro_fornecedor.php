<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}
include 'includes/db_connect.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cnpj = $_POST['cnpj'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare('INSERT INTO fornecedores (nome, cnpj, endereco, telefone, email) VALUES (?, ?, ?, ?, ?)');
    if ($stmt->execute([$nome, $cnpj, $endereco, $telefone, $email])) {
        echo "<p>Fornecedor cadastrado com sucesso!</p>";
    } else {
        echo "<p>Erro ao cadastrar o fornecedor.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Fornecedor</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Cadastrar Fornecedor</h1>
    <form method="POST">
        <label for="nome">Nome do Fornecedor:</label>
        <input type="text" name="nome" id="nome" placeholder="Nome do Fornecedor" required>

        <label for="cnpj">CNPJ:</label>
        <input type="text" name="cnpj" id="cnpj" placeholder="CNPJ" required>

        <label for="endereco">Endereço:</label>
        <input type="text" name="endereco" id="endereco" placeholder="Endereço" required>

        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone" placeholder="Telefone" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Email" required>

        <button type="submit">Cadastrar Fornecedor</button>
    </form>

    <div style="text-align: center; margin-top: 20px;">
    <a href="index.php" class="btn-voltar">Voltar à Página Inicial</a>
</div>
</body>
</html>

<?php include 'includes/footer.php'; ?>