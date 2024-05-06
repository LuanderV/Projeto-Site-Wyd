<?php
require('config.php');

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Erro ao conectar: " . $conn->connect_error);
}

/*************************
FUNÇÃO DE CADASTRO NO BANCO
*************************/

function create($tabela, array $datas, $conn) {
    $fields = implode(", ", array_keys($datas));
    $placeholders = rtrim(str_repeat("?, ", count($datas)), ", ");
    $values = array_values($datas);
    $types = str_repeat("s", count($values)); // Assume que todos os valores são strings
    $stmt = $conn->prepare("INSERT INTO {$tabela} ({$fields}) VALUES ({$placeholders})");
    $stmt->bind_param($types, ...$values);
    $result = $stmt->execute();
    if (!$result) {
        die('Erro ao cadastrar em ' . $tabela . ': ' . $stmt->error);
    }
    return $result;
}

/*************************
FUNÇÃO DE LEITURA NO BANCO
*************************/

function read($tabela, $cond = NULL, $conn) {
    $qrRead = "SELECT * FROM {$tabela} {$cond}";
    $stRead = $conn->query($qrRead);
    if (!$stRead) {
        die('Erro ao ler em ' . $tabela . ': ' . $conn->error);
    }
    $resultado = $stRead->fetch_all(MYSQLI_ASSOC);
    return $resultado;
}

/*************************
FUNÇÃO DE EDIÇÃO NO BANCO
*************************/

function update($tabela, array $datas, $where, $conn) {
    $fields = implode(" = ?, ", array_keys($datas)) . " = ?";
    $values = array_values($datas);
    $values[] = $where; // Adiciona o valor do where para a lista de valores
    $types = str_repeat("s", count($values)); // Assume que todos os valores são strings
    $stmt = $conn->prepare("UPDATE {$tabela} SET {$fields} WHERE {$where}");
    $stmt->bind_param($types, ...$values);
    $result = $stmt->execute();
    if (!$result) {
        die('Erro ao atualizar em ' . $tabela . ': ' . $stmt->error);
    }
    return $result;
}

/*************************
FUNÇÃO DE ALTERAÇÃO DE SENHA NO BANCO
*************************/

function alterarSenha($novaSenha, $usuario, $conn) {
    // Criptografar a nova senha antes de atualizar no banco de dados
    $senhaCriptografada = password_hash($novaSenha, PASSWORD_DEFAULT);

    // Query para atualizar a senha do usuário
    $stmt = $conn->prepare("UPDATE usuarios SET senha = ? WHERE usuario = ?");
    $stmt->bind_param("ss", $senhaCriptografada, $usuario);
    
    // Executar a query
    $result = $stmt->execute();
    if (!$result) {
        die('Erro ao alterar senha: ' . $stmt->error);
    }
    return $result;
}

/*************************
FUNÇÃO DE DELEÇÃO NO BANCO
*************************/

function delete($tabela, $where, $conn) {
    $stmt = $conn->prepare("DELETE FROM {$tabela} WHERE {$where}");
    $result = $stmt->execute();
    if (!$result) {
        die('Erro ao deletar em ' . $tabela . ': ' . $stmt->error);
    }
    return $result;
}
?>