<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/Style.css">
    <title>Editar Doador</title>
</head>
<body class="Container-alin">
    <div class="Container-ex1">
        <h2 class="Alinha-itens til-pag">Editar Doador</h2>

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
                // Une prefixo e sufixo do cartão no mesmo campo, se existirem
                $cartaoCompleto = (!empty($doadorEncontrado['cartao_prefixo']) && !empty($doadorEncontrado['cartao_sufixo'])) 
                    ? $doadorEncontrado['cartao_prefixo'] . '-' . $doadorEncontrado['cartao_sufixo'] 
                    : '';
        ?>

        <div class="form-de-criacao1">
            <form action="../controllers/DoadoresController.php" method="POST" class="Forma-create">
                <input type="hidden" name="id" value="<?= $doadorEncontrado['id']; ?>">

                <div class="trlinha">
                    <div style="width:50%">
                        <label>Nome:</label>
                        <input type="text" name="nome" value="<?= $doadorEncontrado['nome']; ?>" required><br>
                    </div>
                    <div style="width:50%">
                        <label>Email:</label>
                        <input type="email" name="email" value="<?= $doadorEncontrado['email']; ?>" required><br>
                    </div>

                </div>
                <div class="trlinha">
                    <div style="width:30%">
                        <label>CPF:</label>
                        <input type="text" name="cpf" value="<?= $doadorEncontrado['cpf']; ?>" required><br>
                    </div>
                    <div style="width:30%">
                        <label>Telefone:</label>
                        <input type="text" name="telefone" value="<?= $doadorEncontrado['telefone']; ?>" required><br>
                    </div>
                    <div style="width:30%">
                        <label>Data de Nascimento:</label>
                        <input type="date" name="data_nascimento" value="<?= $doadorEncontrado['data_nascimento']; ?>" required><br>
                    </div>
                </div>
                <div class="trlinha">
                    <div style="width:30%">
                        <label>Intervalo de Doação:</label>
                        <select name="intervalo_doacao">
                            <option value="Único" <?= $doadorEncontrado['intervalo_doacao'] == 'Único' ? 'selected' : ''; ?>>Único</option>
                            <option value="Bimestral" <?= $doadorEncontrado['intervalo_doacao'] == 'Bimestral' ? 'selected' : ''; ?>>Bimestral</option>
                            <option value="Semestral" <?= $doadorEncontrado['intervalo_doacao'] == 'Semestral' ? 'selected' : ''; ?>>Semestral</option>
                            <option value="Anual" <?= $doadorEncontrado['intervalo_doacao'] == 'Anual' ? 'selected' : ''; ?>>Anual</option>
                        </select><br>
                    </div>
                    <div style="width:30%">
                        <label>Valor da Doação:</label>
                        <input type="number" step="0.01" name="valor_doacao" value="<?= $doadorEncontrado['valor_doacao']; ?>" required><br>
                    </div>
                    <div style="width:30%">
                        <label>Forma de Pagamento:</label>
                        <select name="forma_pagamento" id="forma_pagamento" onchange="toggleCampos()">
                        <option value="Débito" <?= $doadorEncontrado['forma_pagamento'] == 'Débito' ? 'selected' : ''; ?>>Débito</option>
                        <option value="Crédito" <?= $doadorEncontrado['forma_pagamento'] == 'Crédito' ? 'selected' : ''; ?>>Crédito</option>
                        </select><br>
                    </div>
                </div>
                
                <div id="conta_debito_div" style="display: none;">
                    <label>Conta de Débito:</label>
                    <input type="text" name="conta_debito" id="conta_debito" value="<?= $doadorEncontrado['conta_debito'] ?? ''; ?>"><br>
                </div>

                
                <div id="cartao_div" class="trlinha" style="display: none;">
                    <div style="width:50%">
                        <label>Bandeira do Cartão:</label>
                        <input type="text" name="bandeira_cartao" value="<?= $doadorEncontrado['bandeira_cartao'] ?? ''; ?>"><br>
                    </div>
                    <div style="width:50%">
                        <label>Cartão (Prefixo - Sufixo):</label>
                        <input type="text" name="cartao_numero" id="cartao_numero" value="<?= $cartaoCompleto; ?>" placeholder="Ex: 123456-7890"><br>
                    </div>
                </div>

                <label>Endereço:</label>
                <textarea name="endereco" required><?= $doadorEncontrado['endereco']; ?></textarea><br>

                <button type="submit" class="button-cda alibtn">Atualizar</button>
                <div class="volt-btn">
                <a href="index.php">Voltar</button>
                </div>
            </form>
        </div>
    </div>
    

    <script>
        function toggleCampos() {
            var formaPagamento = document.getElementById("forma_pagamento").value;
            var contaDebitoDiv = document.getElementById("conta_debito_div");
            var cartaoDiv = document.getElementById("cartao_div");

            if (formaPagamento === "Débito") {
                contaDebitoDiv.style.display = "block";
                cartaoDiv.style.display = "none";
            } else {
                contaDebitoDiv.style.display = "none";
                cartaoDiv.style.display = "flex";
            }
        }

        // Chama a função ao carregar para ajustar os campos corretamente
        window.onload = toggleCampos;
    </script>

    <?php
        } else {
            echo "<p>Doador não encontrado!</p>";
        }
    } else {
        echo "<p>ID inválido!</p>";
    }
    ?>

</body>
</html>
