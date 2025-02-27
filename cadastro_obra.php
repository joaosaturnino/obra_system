<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}
include 'includes/db_connect.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $cliente_id = $_POST['cliente_id'];

    $stmt = $pdo->prepare('INSERT INTO obras (nome, endereco, cliente_id) VALUES (?, ?, ?)');
    if ($stmt->execute([$nome, $endereco, $cliente_id])) {
        echo "<p>Obra cadastrada com sucesso!</p>";
    } else {
        echo "<p>Erro ao cadastrar a obra.</p>";
    }
}

$clientes = $pdo->query('SELECT id, nome FROM clientes')->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Obra</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Cadastrar Obra</h1>
    <form method="POST">
        <label for="nome">Nome da Obra:</label>
        <input type="text" name="nome" id="nome" placeholder="Nome da Obra" required>

        <label for="endereco">Endereço da Obra:</label>
        <input type="text" name="endereco" id="endereco" placeholder="Endereço da Obra" required>

        <label for="cliente_id">Cliente:</label>
        <select name="cliente_id" id="cliente_id" required>
            <option value="">Selecione um cliente</option>
            <?php foreach ($clientes as $cliente): ?>
                <option value="<?php echo $cliente['id']; ?>"><?php echo $cliente['nome']; ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Cadastrar Obra</button>
    </form>

    <div style="text-align: center; margin-top: 20px;">
    <a href="index.php" class="btn-voltar">Voltar à Página Inicial</a>
</div>
</body>
</html>

<?php include 'includes/footer.php'; ?>