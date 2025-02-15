<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Doadores</title>
</head>
<body>
    <h2>Cadastro de Doadores</h2>
    <form action="../controllers/DoadoresController.php" method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>CPF:</label>
        <input type="text" name="cpf" required><br>

        <label>Telefone:</label>
        <input type="text" name="telefone" required><br>

        <label>Data de Nascimento:</label>
        <input type="date" name="data_nascimento" required><br>

        <label>Intervalo de Doação:</label>
        <select name="intervalo_doacao">
            <option value="Único">Único</option>
            <option value="Bimestral">Bimestral</option>
            <option value="Semestral">Semestral</option>
            <option value="Anual">Anual</option>
        </select><br>

        <label>Valor da Doação:</label>
        <input type="number" step="0.01" name="valor_doacao" required><br>

        <label>Forma de Pagamento:</label>
        <select name="forma_pagamento" id="forma_pagamento">
            <option value="Débito">Débito</option>
            <option value="Crédito">Crédito</option>
        </select><br>

        <div id="debito">
            <label>Conta Débito:</label>
            <input type="text" name="conta_debito"><br>
        </div>

        <div id="credito" style="display: none;">
            <label>Bandeira do Cartão:</label>
            <input type="text" name="bandeira_cartao"><br>

            <label>Número do Cartão:</label>
            <input type="text" name="cartao_numero"><br>
        </div>

        <label>Endereço:</label>
        <textarea name="endereco" required></textarea><br>

        <button type="submit">Cadastrar</button>
    </form>

    <script>
        document.getElementById('forma_pagamento').addEventListener('change', function() {
            document.getElementById('debito').style.display = this.value == 'Débito' ? 'block' : 'none';
            document.getElementById('credito').style.display = this.value == 'Crédito' ? 'block' : 'none';
        });
    </script>
</body>
</html>
