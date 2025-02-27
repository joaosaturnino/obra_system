<?php
session_start();
include 'includes/db_connect.php';
include 'includes/functions.php';

verificarLogin(); // Verifica se o usuário está logado

// Buscar mensagens
$mensagens = $pdo->query('
    SELECT mensagens.mensagem, usuarios.nome, mensagens.data_envio
    FROM mensagens
    JOIN usuarios ON mensagens.usuario_id = usuarios.id
    ORDER BY mensagens.data_envio ASC
')->fetchAll();

foreach ($mensagens as $msg): ?>
    <div class="mensagem">
        <strong><?php echo $msg['nome']; ?>:</strong>
        <span><?php echo $msg['mensagem']; ?></span>
        <small><?php echo date('d/m/Y H:i', strtotime($msg['data_envio'])); ?></small>
    </div>
<?php endforeach;
?>