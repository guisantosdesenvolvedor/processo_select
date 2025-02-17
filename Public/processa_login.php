<?php
session_start();
require "conexao.php";  // Conexão com banco

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Prepara a consulta SQL
    $sql = "SELECT id, nome, senha FROM admin WHERE email = ?";
    $stmt = $conn->prepare($sql);

    // Verifica se a preparação da consulta falhou
    if (!$stmt) {
        die("Erro na preparação da consulta: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifica a senha
        if (password_verify($senha, $user['senha'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nome'];
            header("Location: dashboard.php");
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
