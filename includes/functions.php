<?php
// Função para validar CPF
function validarCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}

// Função para validar CNPJ
function validarCNPJ($cnpj) {
    $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

    if (strlen($cnpj) != 14 || preg_match('/(\d)\1{13}/', $cnpj)) {
        return false;
    }

    for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
        $soma += $cnpj[$i] * $j;
        $j = ($j == 2) ? 9 : $j - 1;
    }
    $resto = $soma % 11;
    $digito1 = ($resto < 2) ? 0 : 11 - $resto;

    for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
        $soma += $cnpj[$i] * $j;
        $j = ($j == 2) ? 9 : $j - 1;
    }
    $resto = $soma % 11;
    $digito2 = ($resto < 2) ? 0 : 11 - $resto;

    return ($cnpj[12] == $digito1 && $cnpj[13] == $digito2);
}

// Função para sanitizar entradas do usuário
function sanitizarEntrada($dados) {
    $dados = trim($dados);
    $dados = stripslashes($dados);
    $dados = htmlspecialchars($dados);
    return $dados;
}

// Função para exibir mensagens de erro/sucesso
function exibirMensagem($mensagem, $tipo = 'sucesso') {
    $classe = ($tipo == 'erro') ? 'mensagem-erro' : 'mensagem-sucesso';
    return "<div class='$classe'>$mensagem</div>";
}

// Função para redirecionar o usuário
function redirecionar($url) {
    header("Location: $url");
    exit();
}

// Função para verificar se o usuário está logado
function verificarLogin() {
    if (!isset($_SESSION['user_id'])) {
        redirecionar('login.php');
    }
}

// Função para gerar um hash seguro para senhas
function gerarHashSenha($senha) {
    return password_hash($senha, PASSWORD_BCRYPT);
}

// Função para verificar se a senha está correta
function verificarSenha($senha, $hash) {
    return password_verify($senha, $hash);
}

// Função para buscar todos os clientes
function buscarClientes($pdo) {
    return $pdo->query('SELECT * FROM clientes')->fetchAll();
}

// Função para buscar todas as obras
function buscarObras($pdo) {
    return $pdo->query('SELECT * FROM obras')->fetchAll();
}

// Função para buscar todos os fornecedores
function buscarFornecedores($pdo) {
    return $pdo->query('SELECT * FROM fornecedores')->fetchAll();
}

// Função para buscar todos os empreiteiros
function buscarEmpreiteiros($pdo) {
    return $pdo->query('SELECT * FROM empreiteiros')->fetchAll();
}

// Função para buscar todos os materiais
function buscarMateriais($pdo) {
    return $pdo->query('SELECT * FROM materiais')->fetchAll();
}

// Função para buscar todos os arquivos
function buscarArquivos($pdo) {
    return $pdo->query('SELECT * FROM arquivos')->fetchAll();
}

// Função para buscar todas as mensagens compartilhadas
function buscarCompartilhamentos($pdo) {
    return $pdo->query('SELECT compartilhamentos.mensagem, usuarios.nome FROM compartilhamentos JOIN usuarios ON compartilhamentos.usuario_id = usuarios.id ORDER BY compartilhamentos.data_compartilhamento DESC')->fetchAll();
}
?>