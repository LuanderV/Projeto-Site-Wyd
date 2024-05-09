<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Configurações do Gmail
$emailTo = 'withyourdestiny.nostalgic@gmail.com';  // Seu endereço de email do Gmail
$emailFrom = 'yourapp@gmail.com';  // Endereço de email do remetente
$password = 'nostalgia.wyd@1707';  // Senha de aplicativo gerada
$smtpHost = 'smtp.gmail.com';
$smtpPort = 587;  // Porta TLS do Gmail

// Criar uma nova instância do PHPMailer
$mail = new PHPMailer(true);

try {
    // Configurações do servidor SMTP
    $mail->isSMTP();
    $mail->Host = $smtpHost;
    $mail->SMTPAuth = true;
    $mail->Username = $emailFrom;
    $mail->Password = $password;
    $mail->SMTPSecure = 'tls';
    $mail->Port = $smtpPort;

    // Configurações do email
    $mail->setFrom($emailFrom);
    $mail->addAddress($emailTo);
    $mail->Subject = 'Assunto do Email';
    $mail->Body = 'Corpo do Email';

    // Enviar o email
    $mail->send();
    echo 'Email enviado com sucesso.';
} catch (Exception $e) {
    echo 'Ocorreu um erro ao enviar o email: ' . $mail->ErrorInfo;
}
?>
