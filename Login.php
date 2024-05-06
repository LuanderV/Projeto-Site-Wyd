<?php
require('config.php');
require('dbaSis.php');

// Verificar se os dados foram submetidos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se os campos foram preenchidos
    if (isset($_POST['emailOuUsuario'], $_POST['senha'])) {
        $emailOuUsuario = $_POST['emailOuUsuario'];
        $senha = $_POST['senha'];

        // Validar o formato do e-mail
        if (!filter_var($emailOuUsuario, FILTER_VALIDATE_EMAIL)) {
            // Se não for um email válido, então é considerado como nome de usuário
            $usuario = $emailOuUsuario;
            $email = null;
        } else {
            $usuario = null;
            $email = $emailOuUsuario;
        }

        // Consultar o banco de dados para encontrar o usuário
        $stmt = $conn->prepare("SELECT * FROM contas WHERE email=? OR login=? LIMIT 1");

        if ($stmt) {
            // Executar a consulta com parâmetros preparados para evitar injeção de SQL
            $stmt->bind_param("ss", $email, $usuario);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $senhaHash = $row['senha'];
                $tentativasLogin = $row['tentativas_login'];
                $bloqueado = $row['bloqueado'];
                $horaBloqueio = strtotime($row['hora_bloqueio']);
                $horaAtual = time();

                // Verificar se o usuário está bloqueado
                if ($bloqueado == 1) {
                    // Verificar se já passaram 2 horas desde o bloqueio
                    if ($horaAtual - $horaBloqueio >= 7200) { // 7200 segundos = 2 horas
                        // Desbloquear o usuário
                        $stmtDesbloquear = $conn->prepare("UPDATE contas SET bloqueado = 0, tentativas_login = 0, hora_bloqueio = NULL WHERE id = ?");
                        $stmtDesbloquear->bind_param("i", $row['id']);
                        $stmtDesbloquear->execute();
                        $stmtDesbloquear->close();
                    } else {
                        // Calcular o tempo restante até o desbloqueio
                        $tempoRestante = 7200 - ($horaAtual - $horaBloqueio);
                        echo "Sua conta está temporariamente bloqueada. Por favor, tente novamente em " . gmdate("H:i:s", $tempoRestante) . ".";
                        exit();
                    }
                }

                // Verificar se a senha fornecida corresponde à senha hash no banco de dados
                if (password_verify($senha, $senhaHash)) {
                    // Login bem-sucedido
                    // Reiniciar o contador de tentativas de login
                    $stmtResetTentativas = $conn->prepare("UPDATE contas SET tentativas_login = 0 WHERE id = ?");
                    $stmtResetTentativas->bind_param("i", $row['id']);
                    $stmtResetTentativas->execute();
                    $stmtResetTentativas->close();

                    session_start();
                    $_SESSION['emailOuUsuario'] = $row['email']; // Armazenar o email ou login na sessão para futuras verificações de autenticação
                    header("Location: doacao.php"); // Redirecionar para a página de perfil
                    exit();
                } else {
                    // Incrementar o contador de tentativas de login
                    $tentativasLogin++;

                    // Verificar se o número de tentativas atingiu 5
                    if ($tentativasLogin >= 5) {
                        // Bloquear o usuário e registrar a hora do bloqueio
                        $stmtBloquear = $conn->prepare("UPDATE contas SET bloqueado = 1, hora_bloqueio = NOW() WHERE id = ?");
                        $stmtBloquear->bind_param("i", $row['id']);
                        $stmtBloquear->execute();
                        $stmtBloquear->close();
                        echo "Sua conta foi bloqueada temporariamente devido a muitas tentativas de login malsucedidas. Por favor, tente novamente mais tarde.";
                        exit();
                    } else {
                        // Atualizar o contador de tentativas de login
                        $stmtAtualizarTentativas = $conn->prepare("UPDATE contas SET tentativas_login = ? WHERE id = ?");
                        $stmtAtualizarTentativas->bind_param("ii", $tentativasLogin, $row['id']);
                        $stmtAtualizarTentativas->execute();
                        $stmtAtualizarTentativas->close();
                        $tentativasRestantes = 5 - $tentativasLogin;
                        echo "Senha incorreta. Você tem mais " . $tentativasRestantes . " tentativas.";
                        exit();
                    }
                }
            } else {
                // Usuário não encontrado
                echo "Email ou nome de usuário não encontrado.";
                exit();
            }
        } else {
            // Erro na preparação da consulta
            echo "Erro ao preparar a consulta.";
            exit();
        }
    } else {
        // Campos não foram preenchidos
        echo "Por favor, preencha todos os campos.";
        exit();
    }
}
?>
