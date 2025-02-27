<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}
include 'includes/db_connect.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mensagem = $_POST['mensagem'];
    $usuario_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare('INSERT INTO compartilhamentos (mensagem, usuario_id) VALUES (?, ?)');
    if ($stmt->execute([$mensagem, $usuario_id])) {
        echo "<p>Mensagem compartilhada com sucesso!</p>";
    } else {
        echo "<p>Erro ao compartilhar a mensagem.</p>";
    }
}

$compartilhamentos = $pdo->query('SELECT compartilhamentos.mensagem, usuarios.nome FROM compartilhamentos JOIN usuarios ON compartilhamentos.usuario_id = usuarios.id ORDER BY compartilhamentos.data_compartilhamento DESC')->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Compartilhamento</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Compartilhamento de Informações</h1>
    <form method="POST">
        <textarea name="mensagem" placeholder="Digite sua mensagem..." required></textarea>
        <button type="submit">Compartilhar</button>
    </form>

    <h2>Mensagens Compartilhadas</h2>
    <ul>
        <?php foreach ($compartilhamentos as $compartilhamento): ?>
            <li><strong><?php echo $compartilhamento['nome']; ?>:</strong> <?php echo $compartilhamento['mensagem']; ?></li>
        <?php endforeach; ?>
    </ul>

    <div style="text-align: center; margin-top: 20px;">
    <a href="index.php" class="btn-voltar">Voltar à Página Inicial</a>
</div>
</body>
</html>

<?php include 'includes/footer.php'; ?>