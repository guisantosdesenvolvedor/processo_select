<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Doadores</title>
</head>
<body>
    <h2>Lista de Doadores</h2>
    <a href="create.php">Cadastrar Novo Doador</a>
    <table style="border='1'">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Intervalo</th>
                <th>Valor</th>
                <th>Forma de Pagamento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once __DIR__ . '/../models/Doadores.php';
            $doador = new Doadores();
            $doadores = $doador->listarDoadores();

            foreach ($doadores as $d) {
                echo "<tr>
                        <td>{$d['id']}</td>
                        <td>{$d['nome']}</td>
                        <td>{$d['email']}</td>
                        <td>{$d['telefone']}</td>
                        <td>{$d['intervalo_doacao']}</td>
                        <td>R$ {$d['valor_doacao']}</td>
                        <td>{$d['forma_pagamento']}</td>
                        <td>
                            <a href='edit.php?id={$d['id']}'>Editar</a> | 
                            <a href='../controllers/DoadoresController.php?delete={$d['id']}' onclick='return confirm(\"Tem certeza?\")'>Excluir</a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
