<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}
include 'includes/db_connect.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $quantidade = $_POST['quantidade'];
    $fornecedor_id = $_POST['fornecedor_id'];
    $obra_id = $_POST['obra_id'];
    $data_pedido = $_POST['data_pedido'];
    $data_entrega = $_POST['data_entrega'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare('INSERT INTO materiais (nome, quantidade, fornecedor_id, obra_id, data_pedido, data_entrega, status) VALUES (?, ?, ?, ?, ?, ?, ?)');
    if ($stmt->execute([$nome, $quantidade, $fornecedor_id, $obra_id, $data_pedido, $data_entrega, $status])) {
        echo "<p>Material cadastrado com sucesso!</p>";
    } else {
        echo "<p>Erro ao cadastrar o material.</p>";
    }
}

$fornecedores = $pdo->query('SELECT id, nome FROM fornecedores')->fetchAll();
$obras = $pdo->query('SELECT id, nome FROM obras')->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Controle de Material</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Controle de Material</h1>
    <form method="POST">
        <label for="nome">Nome do Material:</label>
        <input type="text" name="nome" id="nome" placeholder="Nome do Material" required>

        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" id="quantidade" placeholder="Quantidade" required>

        <label for="fornecedor_id">Fornecedor:</label>
        <select name="fornecedor_id" id="fornecedor_id" required>
            <option value="">Selecione um fornecedor</option>
            <?php foreach ($fornecedores as $fornecedor): ?>
                <option value="<?php echo $fornecedor['id']; ?>"><?php echo $fornecedor['nome']; ?></option>
            <?php endforeach; ?>
        </select>
            <br>
        <label for="obra_id">Obra:</label>
        <select name="obra_id" id="obra_id" required>
            <option value="">Selecione uma obra</option>
            <?php foreach ($obras as $obra): ?>
                <option value="<?php echo $obra['id']; ?>"><?php echo $obra['nome']; ?></option>
            <?php endforeach; ?>
        </select>
                <br>
        <label for="data_pedido">Data do Pedido:</label>
        <input type="date" name="data_pedido" id="data_pedido" required>

        <label for="data_entrega">Data de Entrega:</label>
        <input type="date" name="data_entrega" id="data_entrega" required>

        <label for="status">Status:</label>
        <select name="status" id="status" required>
            <option value="pendente">Pendente</option>
            <option value="entregue">Entregue</option>
            <option value="atrasado">Atrasado</option>
        </select>

        <button type="submit">Cadastrar Material</button>
    </form>

    <div style="text-align: center; margin-top: 20px;">
    <a href="index.php" class="btn-voltar">Voltar à Página Inicial</a>
</div>
</body>
</html>

<?php include 'includes/footer.php'; ?>