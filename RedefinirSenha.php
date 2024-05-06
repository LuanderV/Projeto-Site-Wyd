<?php
require('config.php');
require('dbaSis.php');

// Verificar se os dados foram submetidos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se os campos foram preenchidos
    if (isset($_POST['usuario'], $_POST['email'])) {
        $usuario = $_POST['usuario'];
        $email = $_POST['email'];

        // Consultar o banco de dados para encontrar o usuário
        $stmt = $conn->prepare("SELECT * FROM contas WHERE email=? AND login=? LIMIT 1");

        if ($stmt) {
            // Executar a consulta com parâmetros preparados para evitar injeção de SQL
            $stmt->bind_param("ss", $email, $usuario);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                // Usuário encontrado, enviar email com link para redefinição de senha
                $row = $result->fetch_assoc();
                $token = bin2hex(random_bytes(16)); // Gerar um token único
                $link = "http://localhost/sitenovo/RedefinirSenha.php?token=" . $token; // Link para a página de redefinição de senha
                $mensagem = "Olá $usuario, clique no link abaixo para redefinir sua senha: $link";

                // Enviar o email
                $to = $email;
                $subject = 'Redefinição de Senha';
                $headers = 'From: seuemail@seusite.com' . "\r\n" .
                           'Reply-To: seuemail@seusite.com' . "\r\n" .
                           'Content-Type: text/html; charset=UTF-8' . "\r\n" .
                           'X-Mailer: PHP/' . phpversion();

                if (mail($to, $subject, $mensagem, $headers)) {
                    echo 'Um email foi enviado para você com instruções para redefinir sua senha.';
                } else {
                    echo 'Ocorreu um erro ao enviar o email. Por favor, tente novamente.';
                }
            } else {
                // Usuário não encontrado
                echo "Email ou nome de usuário não encontrado.";
            }
        } else {
            // Erro na preparação da consulta
            echo "Erro ao preparar a consulta.";
        }
    } else {
        // Campos não foram preenchidos
        echo "Por favor, preencha todos os campos.";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['token'])) {
    // Este bloco de código é para processar a redefinição de senha após o usuário clicar no link enviado por email
    $token = $_GET['token'];

    // Verificar se o token é válido (por exemplo, verificar se está na tabela de tokens válidos)
    // Se o token for válido, exibir o formulário de redefinição de senha
    // Se o token não for válido, exibir uma mensagem de erro
    // Este é um exemplo básico e você precisa implementar a lógica completa aqui
} else {
    // Se o método de requisição não for POST ou GET com um token, redirecionar para a página de login ou página inicial
    header("Location: RecuperarSenha.html");
}
?>
