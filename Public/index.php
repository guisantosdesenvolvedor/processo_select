<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>

<div class='container'>
  <div class='card'>
    <h1> Entrar </h1>
    
    <div id='msgError'></div>
    
    <!-- Formulário com action para processa_login.php -->
    <form action="processa_login.php" method="POST">
        <div class='label-float'>
            <input type="email" name="email" id="email" placeholder="Digite seu e-mail" required>
        </div>
        
        <div class='label-float'>
            <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
            <i class="fa fa-eye" aria-hidden="true"></i>
        </div>
        
        <div class='justify-center'>
            <button type="submit">Entrar</button>
        </div>
    </form>
  </div>
</div>
    
</body>
</html>
