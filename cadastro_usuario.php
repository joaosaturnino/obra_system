<?php
session_start();
include 'includes/db_connect.php';
include 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = sanitizarEntrada($_POST['nome']);
    $email = sanitizarEntrada($_POST['email']);
    $senha = sanitizarEntrada($_POST['senha']);

    // Verifica se o email já está cadastrado
    $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE email = ?');
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        echo exibirMensagem("Este email já está cadastrado.", "erro");
    } else {
        // Cria um hash seguro da senha
        $senhaHash = gerarHashSenha($senha);

        // Insere o novo usuário no banco de dados
        $stmt = $pdo->prepare('INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)');
        if ($stmt->execute([$nome, $email, $senhaHash])) {
            echo exibirMensagem("Cadastro realizado com sucesso! Faça login para continuar.", "sucesso");
        } else {
            echo exibirMensagem("Erro ao cadastrar o usuário.", "erro");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Cadastro de Usuário</h1>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" placeholder="Seu nome" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Seu email" required>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" placeholder="Sua senha" required>

        <button type="submit">Cadastrar</button>
    </form>
    <p>Já tem uma conta? <a href="login.php">Faça login aqui</a>.</p>
</body>
</html>

<?php include 'includes/footer.php'; ?>