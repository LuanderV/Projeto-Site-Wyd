<?php
require('config.php');
require('dbaSis.php');
session_start();

// Verificar se o usuário está logado
if (isset($_COOKIE['usuarioLogado']) && $_COOKIE['usuarioLogado'] === "true") {
    // Verificar se o ID do usuário está definido na sessão
    if (isset($_SESSION['userId'])) {
        // Obter o ID do usuário da sessão
        $userId = $_SESSION['userId'];

        // Consultar o banco de dados para obter as informações do usuário
        $stmt = $conn->prepare("SELECT login, email, pergunta FROM contas WHERE id=?");
        if ($stmt) {
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $login = $row['login'];
                $email = $row['email'];
                $pergunta = $row['pergunta'];
                
                // Saída de dados do usuário
                echo "<p>Login: " . $login . "</p><p>Email: " . $email . "</p><p>Pergunta: " . $pergunta . "</p>";
            } else {
                echo "Usuário não encontrado.";
            }
        } else {
            echo "Erro ao preparar a consulta.";
        }
    } else {
        echo "ID do usuário não definido na sessão.";
    }
} else {
    echo "Usuário não está logado.";
}
?>
