<?php
session_start();
include 'includes/db_connect.php';
include 'includes/functions.php';

verificarLogin(); // Verifica se o usuário está logado

// Enviar mensagem
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mensagem = sanitizarEntrada($_POST['mensagem']);
    $usuario_id = $_SESSION['user_id'];

    if (!empty($mensagem)) {
        $stmt = $pdo->prepare('INSERT INTO mensagens (usuario_id, mensagem) VALUES (?, ?)');
        $stmt->execute([$usuario_id, $mensagem]);
    }
}

// Buscar mensagens
$mensagens = $pdo->query('
    SELECT mensagens.mensagem, usuarios.nome, mensagens.data_envio
    FROM mensagens
    JOIN usuarios ON mensagens.usuario_id = usuarios.id
    ORDER BY mensagens.data_envio ASC
')->fetchAll();

include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Compartilhamento</title>
    <link rel="stylesheet" href="css/styles1.css">
</head>
<body>
    <h1>Chat de Compartilhamento</h1>

    <!-- Área de Mensagens -->
    <div id="chat">
        <?php foreach ($mensagens as $msg): ?>
            <div class="mensagem">
                <strong><?php echo $msg['nome']; ?>:</strong>
                <span><?php echo $msg['mensagem']; ?></span>
                <small><?php echo date('d/m/Y H:i', strtotime($msg['data_envio'])); ?></small>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Formulário de Envio de Mensagem -->
    <form id="form-mensagem" method="POST">
        <textarea name="mensagem" placeholder="Digite sua mensagem..." required></textarea>
        <button type="submit">Enviar</button>
    </form>

    <!-- Script para atualizar o chat em tempo real -->
    <script>
        function atualizarChat() {
            fetch('buscar_mensagens.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('chat').innerHTML = data;
                });
        }

        // Atualiza o chat a cada 2 segundos
        setInterval(atualizarChat, 2000);

        // Rola a tela para baixo ao carregar novas mensagens
        document.getElementById('chat').scrollTop = document.getElementById('chat').scrollHeight;
    </script>
</body>
</html>

<?php include 'includes/footer.php'; ?>