<?php
session_start();
require "conexao.php";  // Arquivo de conexão com o banco

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Busca usuário pelo e-mail
    $sql = "SELECT id, nome, senha FROM admin WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Erro na preparação da consulta: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $senha_bd = $user['senha']; // Senha armazenada no banco

        // Verifica se a senha foi armazenada com hash
        if (password_verify($senha, $senha_bd) || $senha === $senha_bd) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nome'];
            header("Location: ../Views/index.php"); // Página pós-login
            exit();
        } else {
            echo "<script>alert('Senha incorreta!');window.location='index.php';</script>";
        }
    } else {
        echo "<script>alert('Usuário não encontrado!');window.location='index.php';</script>";
    }

    $stmt->close();
}
$conn->close();
?>
