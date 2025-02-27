<?php
session_start();
include 'includes/db_connect.php';
include 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = sanitizarEntrada($_POST['email']);
    $senha = sanitizarEntrada($_POST['senha']);

    // Busca o usuário pelo email
    $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE email = ?');
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    // Verifica se o usuário existe e se a senha está correta
    if ($usuario && verificarSenha($senha, $usuario['senha'])) {
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_nome'] = $usuario['nome'];
        redirecionar('index.php');
    } else {
        echo exibirMensagem("Email ou senha incorretos.", "erro");
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Login</h1>
    <form method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Seu email" required>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" placeholder="Sua senha" required>

        <button type="submit">Entrar</button>
    </form>
    <p>Não tem uma conta? <a href="cadastro_usuario.php">Cadastre-se aqui</a>.</p>
</body>
</html>

<?php include 'includes/footer.php'; ?>