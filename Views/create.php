<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/Style.css">
    <title>Cadastro de Doadores</title>
    <style>
        #mensagem {
            color: red;
            font-size: 14px;
            display: none;
        }
    </style>    
</head>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Public/index.php");  // Redireciona se não estiver logado
    exit();
}
?>
<body class="Container-alin">
    <div class="Container-ex1">
        <div>
        <h2 class="Alinha-itens til-pag">Cadastro de Doadores</h2>
        <div class="form-de-criacao">
            <form action="../controllers/DoadoresController.php" method="POST" id="formCadastro" class="Forma-create">
                <div class="trlinha">
                    <div style="width:50%">
                        <label>Nome:</label>
                        <input type="text" name="nome" placeholder="Nome do Doador(a)?" required><br>
                    </div>
                    <div style="width:50%">
                        <label>Email:</label>
                        <input type="email" name="email" placeholder="Qual E-mail?" required><br>
                    </div>
                </div>
                <div class="trlinha">
                    <div style="width:30%">
                        <label>CPF:</label>
                        <input type="text" id="cpf" name="cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" placeholder="000.000.000-00" maxlength="14" oninput="formatarCPF(this)" required><br>
                        <span id="cpfErro" style="color: red; display: none;">CPF inválido</span>   
                    </div>
                    <div style="width:30%">
                        <label>Telefone:</label>
                        <input type="text" id="telefone" maxlength="15" placeholder="(00) 00000-0000" name="telefone" required><br> 
                    </div>
                    <div style="width:30%">
                        <label>Data de Nascimento:</label>
                        <input type="date" name="data_nascimento" required><br>
                    </div>
                </div>
                <div class="trlinha">
                    <div style="width:30%">
                        <label>Intervalo de Doação:</label>
                        <select name="intervalo_doacao">
                            <option value="Único">Único</option>
                            <option value="Bimestral">Bimestral</option>
                            <option value="Semestral">Semestral</option>
                            <option value="Anual">Anual</option>
                        </select><br>   
                    </div>
                    <div style="width:30%">
                        <label>Valor da Doação:</label>
                        <input type="text" name="valor_doacao" id="valor_doacao" required placeholder="R$ 0,00"><br>
                    </div>
                    <div style="width:30%">
                        <label>Forma de Pagamento:</label>
                        <select name="forma_pagamento" id="forma_pagamento">
                            <option value="Débito">Débito</option>
                            <option value="Crédito">Crédito</option>
                        </select><br>
                    </div>
                </div>
                
                

                <div id="debito">
                    <label>Conta Débito:</label>
                    <input type="number" name="conta_debito" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"><br>
                </div>

                <div id="credito" class="trlinha" style="display: none;" >
                    <div style="width:50%">
                        <label>Bandeira do Cartão:</label>
                        <input type="text" name="bandeira_cartao"><br>
                    </div>
                    <div style="width:50%">
                        <label>Número do Cartão:</label>
                        <input type="number" name="cartao_numero" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" maxlength="10" oninput="validarCartao()" placeholder="Digite o numero do Cartão"><br>
                        <p id="mensagem">Cartão inválido</p>
                    </div>
                </div>


                <div>
                    <label>Endereço:</label>
                    <textarea name="endereco" required></textarea><br>
                </div>
                <button type="submit" class="button-cda alibtn">Cadastrar</button>
                <div class="volt-btn">
                <a href="index.php">Voltar</button>
                </div>
            </form>
        </div>

        </div>
    </div>
    <script>    
        function validarCartao() {
                const cartaoInput = document.getElementById("cartao");
                const mensagem = document.getElementById("mensagem");
                
                if (cartaoInput.value.length < 10) {
                    mensagem.style.display = "block";
                } else {
                    mensagem.style.display = "none";
                }
            }

        document.getElementById("telefone").addEventListener("input", function () {
                let telefone = this.value.replace(/\D/g, ""); // Remove tudo que não for número

                // Aplica a máscara automaticamente
                if (telefone.length <= 10) { 
                    telefone = telefone.replace(/^(\d{2})(\d{4})(\d{0,4})/, "($1) $2-$3"); // Formato fixo
                } else {
                    telefone = telefone.replace(/^(\d{2})(\d{5})(\d{0,4})/, "($1) $2-$3"); // Formato celular
                }

                this.value = telefone; // Atualiza o campo
        });

        let input = document.getElementById("valor_doacao");

        input.addEventListener("input", function () {
            let valor = this.value.replace(/\D/g, ""); // Remove tudo que não for número
            valor = (parseFloat(valor) / 100).toLocaleString("pt-BR", { style: "currency", currency: "BRL" });

            if (valor === "NaN") {
                this.value = "R$ 0,00"; // Evita erro caso o campo fique vazio
            } else {
                this.value = valor;
            }
        });

        function formatarCPF(campo) {
            let cpf = campo.value.replace(/\D/g, ''); // Remove tudo que não for número

            if (cpf.length > 11) {
                cpf = cpf.substring(0, 11); // Garante que não passe de 11 números
            }

            // Formata o CPF: 000.000.000-00
            if (cpf.length >= 9) {
                campo.value = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
            } else if (cpf.length >= 6) {
                campo.value = cpf.replace(/(\d{3})(\d{3})(\d{0,3})/, "$1.$2.$3");
            } else if (cpf.length >= 3) {
                campo.value = cpf.replace(/(\d{3})(\d{0,3})/, "$1.$2");
            } else {
                campo.value = cpf;
            }
        }

        document.getElementById('forma_pagamento').addEventListener('change', function() {
            document.getElementById('debito').style.display = this.value == 'Débito' ? 'block' : 'none';
            document.getElementById('credito').style.display = this.value == 'Crédito' ? 'flex' : 'none';
        });
        
    </script>
</body>
</html>
