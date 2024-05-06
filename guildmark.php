<?php
// Validar a entrada do usuário
if (!isset($_POST['guildid']) || !is_numeric($_POST['guildid'])) {
    echo "<script>alert('ID de guilda inválido.');top.location.href='EnviarGuildMark.php'; </script>";
    exit();
}

$guildid = intval($_POST['guildid']);

// Definir constantes para cálculos de ID de guilda
define('GUILD_ID_OFFSET', 3000000);
define('GUILD_ID_MULTIPLIER', 1000000);

$img = ".guilds/img_guilds/b0" . ($guildid + GUILD_ID_OFFSET) . ".bmp";

if (isset($_FILES['arquivo']['name'])) {
    $uploaddir = '.\\guilds\\img_guilds\\';
    $arquivo = $uploaddir . "b0" . ($guildid + GUILD_ID_OFFSET) . ".bmp";

    $dimensao = getimagesize($_FILES['arquivo']['tmp_name']);
    if ($_FILES['arquivo']["type"] == "image/bmp") {
        if (($dimensao[0] <= 16) && ($dimensao[1] <= 12)) {
            if ($_FILES['arquivo']["size"] <= 2000) {
                if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $arquivo)) {
                    copy($arquivo, $uploaddir . "b0" . ($guildid + GUILD_ID_MULTIPLIER) . ".bmp");
                    copy($arquivo, $uploaddir . "b0" . ($guildid + GUILD_ID_MULTIPLIER * 2) . ".bmp");
                    echo "<script>alert('O arquivo foi enviado com sucesso!');top.location.href='EnviarGuildMark.php'; </script>";
                    $img = "img_guilds/b0" . ($guildid + GUILD_ID_OFFSET) . ".bmp";
                } else {
                    echo "<script>alert('Error: O arquivo não foi enviado.');top.location.href='EnviarGuildMark.php'; </script>";
                }
            } else {
                echo "<script>alert('Error: Imagem muito pesada.');top.location.href='EnviarGuildMark.php'; </script>";
            }
        } else {
            echo "<script>alert('Error: Imagem muito grande.');top.location.href='EnviarGuildMark.php'; </script>";
        }
    } else {
        echo "<script>alert('Error: Formato de imagem inválido.');top.location.href='EnviarGuildMark.php'; </script>";
    }
}
?>