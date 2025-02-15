<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Doador</title>
</head>
<body>
    <h2>Editar Doador</h2>

    <?php
    require_once __DIR__ . '/../models/Doadores.php';
    $doador = new Doadores();
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $doadores = $doador->listarDoadores();
        $doadorEncontrado = null;
        
        foreach ($doadores as $d) {
            if ($d['id'] == $id) {
                $doadorEncontrado = $d;
                break;
            }
        }

        if ($doadorEncontrado) {
    ?>

    <form action="../controllers/DoadoresController.php" method="POST">
        <input type="hidden" name="id" value="<?= $doadorEncontrado['id']; ?>">

        <label>Nome:</label>
        <input type="text" name="nome" value="<?= $doadorEncontrado['nome']; ?>" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?= $doadorEncontrado['email']; ?>" required><br>

        <label>CPF:</label>
        <input type="text" name="cpf" value="<?= $doadorEncontrado['cpf']; ?>" required><br>

        <label>Telefone:</label>
        <input type="text" name="telefone" value="<?= $doadorEncontrado['telefone']; ?>" required><br>

        <label>Data de Nascimento:</label>
        <input type="date" name="data_nascimento" value="<?= $doadorEncontrado['data_nascimento']; ?>" required><br>

        <label>Intervalo de Doação:</label>
        <select name="intervalo_doacao">
            <option value="Único" <?= $doadorEncontrado['intervalo_doacao'] == 'Único' ? 'selected' : ''; ?>>Único</option>
            <option value="Bimestral" <?= $doadorEncontrado['intervalo_doacao'] == 'Bimestral' ? 'selected' : ''; ?>>Bimestral</option>
            <option value="Semestral" <?= $doadorEncontrado['intervalo_doacao'] == 'Semestral' ? 'selected' : ''; ?>>Semestral</option>
            <option value="Anual" <?= $doadorEncontrado['intervalo_doacao'] == 'Anual' ? 'selected' : ''; ?>>Anual</option>
        </select><br>

        <label>Valor da Doação:</label>
        <input type="number" step="0.01" name="valor_doacao" value="<?= $doadorEncontrado['valor_doacao']; ?>" required><br>

        <label>Forma de Pagamento:</label>
        <select name="forma_pagamento">
            <option value="Débito" <?= $doadorEncontrado['forma_pagamento'] == 'Débito' ? 'selected' : ''; ?>>Débito</option>
            <option value="Crédito" <?= $doadorEncontrado['forma_pagamento'] == 'Crédito' ? 'selected' : ''; ?>>Crédito</option>
        </select><br>

        <label>Endereço:</label>
        <textarea name="endereco" required><?= $doadorEncontrado['endereco']; ?></textarea><br>

        <button type="submit">Atualizar</button>
    </form>

    <?php
        } else {
            echo "<p>Doador não encontrado!</p>";
        }
    } else {
        echo "<p>ID inválido!</p>";
    }
    ?>

<td>
    <a href="edit.php?id={$d['id']}">Editar</a> | 
    <a href="../controllers/DoadoresController.php?delete={$d['id']}" onclick='return confirm(\"Tem certeza que deseja excluir?\")'>Excluir</a>
</td>


</body>
</html>
