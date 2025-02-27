<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}
include 'includes/db_connect.php';
include 'includes/header.php';

$total_obras = $pdo->query('SELECT COUNT(*) AS total FROM obras')->fetch()['total'];
$total_materiais = $pdo->query('SELECT COUNT(*) AS total FROM materiais')->fetch()['total'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Estatísticas</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Estatísticas da Empresa</h1>
    <p>Total de Obras: <?php echo $total_obras; ?></p>
    <p>Total de Materiais: <?php echo $total_materiais; ?></p>
</body>

<div style="text-align: center; margin-top: 20px;">
    <a href="index.php" class="btn-voltar">Voltar à Página Inicial</a>
</div>
</html>

<?php include 'includes/footer.php'; ?>