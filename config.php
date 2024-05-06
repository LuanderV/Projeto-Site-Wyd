<?php
// Define as credenciais do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$database = "wydserv";

// Estabelece a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $database);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

?>