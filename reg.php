<?php
require('dbaSis.php');

if(isset($_POST['Submit2'])) {
    $userid = trim($_POST['userid']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    $pergunta = trim($_POST['pergunta']);
    $resposta = trim($_POST['resposta']);

    // Verifica se o login atende aos requisitos
    if (!preg_match("/^[a-zA-Z1-9]{6,12}$/", $userid)) {
        echo "<script>alert('Seu login só pode ter letras de A a Z, números de 1 a 9 e deve ter entre 6 e 12 caracteres.');top.location.href='http://localhost/sitenovo/Cadastro.html'; </script>";
        exit();
    }

    // Verifica se a senha atende aos requisitos
    if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^\w\d\s]).{6,10}$/", $password)) {
        echo "<script>alert('Sua senha deve conter entre 6 e 10 caracteres, incluindo pelo menos 1 número, 1 letra minúscula, 1 letra maiúscula e 1 caractere especial.');top.location.href='http://localhost/sitenovo/Cadastro.html'; </script>";
        exit();
    }

    // Verifica se a pergunta secreta atende aos requisitos
    if (!preg_match("/^[a-zA-Z\s]{1,30}$/", $pergunta)) {
        echo "<script>alert('A pergunta secreta só pode conter letras e espaços, e deve ter no máximo 30 caracteres.');top.location.href='http://localhost/sitenovo/Cadastro.html'; </script>";
        exit();
    }

    // Verifica se a resposta secreta atende aos requisitos
    if (!preg_match("/^[a-zA-Z0-9\s]{1,20}$/", $resposta)) {
        echo "<script>alert('A resposta secreta só pode conter letras, números e espaços, e deve ter no máximo 20 caracteres.');top.location.href='http://localhost/sitenovo/Cadastro.html'; </script>";
        exit();
    }

    // Verifica se o usuário ou e-mail já existe no banco de dados
    $check_user_email = "SELECT * FROM contas WHERE login = '$userid' OR email = '$email'";
    $result = $conn->query($check_user_email);
    if ($result->num_rows > 0) {
        echo "<script>alert('Usuário ou e-mail já está cadastrado!');top.location.href='http://localhost/sitenovo/Cadastro.html'; </script>";
        exit();
    }

    // Criptografa a senha
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Cria a conta no banco de dados
    $datas = array(
        "login" => $userid,
        "senha" => $hashed_password, // Salva a senha criptografada
        "email" => $email,
        "pergunta" => $pergunta,
        "resposta" => $resposta
    );
    $Criar = create("contas", $datas, $conn);
    if($Criar) {
        echo "<script>alert('Conta $userid foi criada com sucesso!');top.location.href='http://localhost/sitenovo/index.html'; </script>";
    } else {
        echo "<script>alert('Erro ao criar a conta!');top.location.href='http://localhost/sitenovo/Cadastro.html'; </script>";
    }

    // Abre ou cria o arquivo na pasta do jogo
    $file = fopen("C:\\xampp\\htdocs\\Servidor\\DATA\\ImportUser\\arquivo.txt", "a");

    // Escreve os dados no arquivo
    fwrite($file, $userid . " " . $password . PHP_EOL); // Salva a senha em texto plano

    // Fecha o arquivo
    fclose($file);
}
?>
