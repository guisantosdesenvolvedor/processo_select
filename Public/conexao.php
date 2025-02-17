<?php
$host = "localhost";
$dbname = "doacoes";
$username = "root";  // Substitua conforme seu banco
$password = "";  // Coloque a senha do MySQL (caso tenha)

// Criar conexão
$conn = new mysqli($host, $username, $password, $dbname);

// Verifica erro
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
