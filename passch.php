<?php
require('config.php');
require('dbaSis.php');

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recebe os dados do formulário
    $login = $_POST['userid'];
    $senha_atual = $_POST['password'];
    $nova_senha = $_POST['newpass'];
    $pergunta_secreta = $_POST['pergunta'];
    $resposta_secreta = $_POST['resposta'];

    // Verifica se a senha atende aos requisitos
    if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^\w\d\s]).{6,10}$/", $nova_senha)) {
        echo "<script>alert('Sua senha deve conter entre 6 e 10 caracteres, incluindo pelo menos 1 número, 1 letra minúscula, 1 letra maiúscula e 1 caractere especial.');top.location.href='http://localhost/sitenovo/TrocarSenha.html'; </script>";
        exit();
    }

    // Consulta preparada para evitar SQL injection
    $stmt = $conn->prepare("SELECT * FROM contas WHERE login = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Verificar se o usuário existe
    if ($result->num_rows === 1) {
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
                $stmtDesbloquear = $conn->prepare("UPDATE contas SET bloqueado = 0, tentativas_login = 0, hora_bloqueio = NULL WHERE login = ?");
                $stmtDesbloquear->bind_param("s", $login);
                $stmtDesbloquear->execute();
                $stmtDesbloquear->close();
            } else {
                // Calcular o tempo restante até o desbloqueio
                $tempoRestante = 7200 - ($horaAtual - $horaBloqueio);
                echo "Sua conta está temporariamente bloqueada. Por favor, tente novamente em " . gmdate("H:i:s", $tempoRestante) . ".";
                exit();
            }
        }

        // Verifica se a senha atual fornecida corresponde à senha armazenada
        if (password_verify($senha_atual, $senhaHash)) {
            // Verifica se a pergunta e resposta secreta correspondem
            if ($row['pergunta'] === $pergunta_secreta && $row['resposta'] === $resposta_secreta) {
                // Criptografar a nova senha
                $nova_senha_criptografada = password_hash($nova_senha, PASSWORD_DEFAULT);
                // Atualizar a senha no banco de dados
                $stmt = $conn->prepare("UPDATE contas SET senha = ? WHERE login = ?");
                $stmt->bind_param("ss", $nova_senha_criptografada, $login);
                $stmt->execute();

                // Localiza o caminho para o arquivo XML do usuário
                $primeira_letra = strtoupper(substr($login, 0, 1));
                $caminho_arquivo_xml = "C:\\xampp\\htdocs\\Servidor\\DBSRV\\account\\{$primeira_letra}\\{$login}.xml";

                // Verifica se o arquivo XML existe
                if (file_exists($caminho_arquivo_xml)) {
                    // Carrega o conteúdo do arquivo XML
                    $xml = simplexml_load_file($caminho_arquivo_xml);
                    // Atualiza a senha no arquivo XML
                    $xml->password = $nova_senha;
                    // Salva as alterações no arquivo XML
                    $xml->asXML($caminho_arquivo_xml);
                    echo 'Senha atualizada com sucesso!';
                } else {
                    echo 'Algo deu errado, tente novamente.';
                }
            } else {
                echo 'Algo deu errado, tente novamente.';
            }
        } else {
            // Incrementar o contador de tentativas de login
            $tentativasLogin++;

            // Verificar se o número de tentativas atingiu 5
            if ($tentativasLogin >= 5) {
                // Bloquear o usuário e registrar a hora do bloqueio
                $stmtBloquear = $conn->prepare("UPDATE contas SET bloqueado = 1, hora_bloqueio = NOW() WHERE login = ?");
                $stmtBloquear->bind_param("s", $login);
                $stmtBloquear->execute();
                $stmtBloquear->close();
                echo "Sua conta foi bloqueada temporariamente devido a muitas tentativas de login malsucedidas. Por favor, tente novamente mais tarde.";
                exit();
            } else {
                // Atualizar o contador de tentativas de login
                $stmtAtualizarTentativas = $conn->prepare("UPDATE contas SET tentativas_login = ? WHERE login = ?");
                $stmtAtualizarTentativas->bind_param("is", $tentativasLogin, $login);
                $stmtAtualizarTentativas->execute();
                $stmtAtualizarTentativas->close();
                $tentativasRestantes = 5 - $tentativasLogin;
                echo "Senha incorreta. Você tem mais " . $tentativasRestantes . " tentativas.";
                exit();
            }
        }
    } else {
        echo 'Algo deu errado, tente novamente.';
    }
}
?>
