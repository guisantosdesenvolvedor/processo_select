<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/Style.css">
    <title>Lista de Doadores</title>
</head>
<body class="Container-alin">
    <div class="Container-ex">
    <h2 class="Alinha-itens til-pag">Lista de Doadores</h2>
    <div class="Add-cliente">
        <div class="text-add">
            <p>Deseja Adicionar Doador?</p>
        </div>
        <button type="button" class="button-cd"><a href="create.php" class="te4Xt">Cadastrar Doador</a></button>
    </div>
    <Div class="Alinha-itens">
    <table class="cont-table" style="width: 90%; border-collapse: collapse; text-align: center; ">
        <thead>
            <tr>
                <th style="border: 1px solid #000; padding: 10px;">ID</th>
                <th style="border: 1px solid #000; padding: 10px;">Nome</th>
                <th style="border: 1px solid #000; padding: 10px;">Email</th>
                <th style="border: 1px solid #000; padding: 10px;">Telefone</th>
                <th style="border: 1px solid #000; padding: 10px;">Intervalo</th>
                <th style="border: 1px solid #000; padding: 10px;">Valor</th>
                <th style="border: 1px solid #000; padding: 10px;">Forma de Pagamento</th>
                <th style="border: 1px solid #000; padding: 10px;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once __DIR__ . '/../Models/Doadores.php';
            $doador = new Doadores();
            $doadores = $doador->listarDoadores();

            foreach ($doadores as $d) {
                echo "<tr style='text-align: center;'>
                        <td style='border: 1px solid #000; padding: 10px;'>{$d['id']}</td>
                        <td style='border: 1px solid #000; padding: 10px;'>{$d['nome']}</td>
                        <td style='border: 1px solid #000; padding: 10px;'>{$d['email']}</td>
                        <td style='border: 1px solid #000; padding: 10px;'>{$d['telefone']}</td>
                        <td style='border: 1px solid #000; padding: 10px;'>{$d['intervalo_doacao']}</td>
                        <td style='border: 1px solid #000; padding: 10px;'>R$ {$d['valor_doacao']}</td>
                        <td style='border: 1px solid #000; padding: 10px;'>{$d['forma_pagamento']}</td>
                        <td style='border: 1px solid #000; padding: 10px;'>
                            <button type='button' class='button-cd-add'><a class='te4Xt' href='edit.php?id={$d['id']}'>Editar</a></button>
                             | 
                            <button type='button' class='button-cd-exc'>
                                <a class='te4Xt' href='#' onclick='confirmDelete({$d['id']})'>Excluir</a>
                            </button>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>


    </Div>
    </div>

    <script>
    function confirmDelete(id) {
        if (confirm("Tem certeza?")) {
            // Enviar requisição para excluir o item
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '../controllers/DoadoresController.php?delete=' + id, true);
            xhr.onload = function() {
                if (xhr.status == 200) {
                    // Mostrar o alerta "Usuário excluído"
                    alert('Usuário excluído com sucesso!');
                    // Recarregar a página após a exclusão
                    location.reload();
                } else {
                    alert('Erro ao excluir usuário.');
                }
            };
            xhr.send();
        }
    }
</script>
</body>
</html>
