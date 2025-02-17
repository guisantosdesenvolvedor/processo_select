<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");  // Redireciona se não estiver logado
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Logada</title>
</head>
<body>
    <h2>Bem-vindo, <?php echo $_SESSION['user_name']; ?>!</h2>
    <a href="logout.php">Sair</a>
</body>
</html>
