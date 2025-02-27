<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}
include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Bem-vindo ao Sistema de Obras <br> <?php echo $_SESSION['user_nome']; ?>!</h1>
    <nav>
        <ul>
            <!--<li><a href="listagem.php">Listagem de Dados</a></li><br>!-->
            <li><a href="cadastro_cliente.php">Cadastrar Cliente</a></li><br>
            <li><a href="cliente.php">Listar Clientes</a></li><br>
            <li><a href="cadastro_obra.php">Cadastrar Obra</a></li><br>
            <li><a href="obra.php">Listar Obra</a></li><br>
            <li><a href="cadastro_fornecedor.php">Cadastrar Fornecedor</a></li><br>
            <li><a href="fornecedor.php">Listar Fornecedor</a></li><br>
            <li><a href="cadastro_empreiteiro.php">Cadastrar Empreiteiro</a></li><br>
            <li><a href="empreiteiro.php">Listar Empreiteiro</a></li><br>
            <li><a href="controle_material.php">Controle de Material</a></li><br>
            <li><a href="relatorios.php">Relatórios</a></li><br>
            <li><a href="estatisticas.php">Estatísticas</a></li><br>
            <li><a href="armazenamento.php">Armazenamento</a></li><br>
            <li><a href="compartilhamento.php">Compartilhamento</a></li><br>
            <li><a href="logout.php">Sair</a></li><br>
        </ul>
    </nav>
</body>
</html>

<?php include 'includes/footer.php'; ?>