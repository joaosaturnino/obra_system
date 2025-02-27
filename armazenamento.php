<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}
include 'includes/db_connect.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["arquivo"]["name"]);
    if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], $target_file)) {
        $stmt = $pdo->prepare('INSERT INTO arquivos (nome, caminho) VALUES (?, ?)');
        $stmt->execute([basename($_FILES["arquivo"]["name"]), $target_file]);
        echo "<p>Arquivo enviado com sucesso!</p>";
    } else {
        echo "<p>Erro ao enviar o arquivo.</p>";
    }
}

$arquivos = $pdo->query('SELECT * FROM arquivos')->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Armazenamento</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Armazenamento de Arquivos</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="arquivo" required>
        <button type="submit">Enviar Arquivo</button>
    </form>

    <h2>Arquivos Armazenados</h2>
    <ul>
        <?php foreach ($arquivos as $arquivo): ?>
            <li><a href="<?php echo $arquivo['caminho']; ?>" target="_blank"><?php echo $arquivo['nome']; ?></a></li>
        <?php endforeach; ?>
    </ul>

    <div style="text-align: center; margin-top: 20px;">
    <a href="index.php" class="btn-voltar">Voltar à Página Inicial</a>
</div>
</body>
</html>

<?php include 'includes/footer.php'; ?>