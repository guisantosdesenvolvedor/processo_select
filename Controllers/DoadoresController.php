<?php
require_once __DIR__ . '/../models/Doadores.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doador = new Doadores();

    $dados = [
        'nome' => $_POST['nome'],
        'email' => $_POST['email'],
        'cpf' => $_POST['cpf'],
        'telefone' => $_POST['telefone'],
        'data_nascimento' => $_POST['data_nascimento'],
        'intervalo_doacao' => $_POST['intervalo_doacao'],
        'valor_doacao' => $_POST['valor_doacao'],
        'forma_pagamento' => $_POST['forma_pagamento'],
        'conta_debito' => $_POST['forma_pagamento'] == 'Débito' ? $_POST['conta_debito'] : null,
        'bandeira_cartao' => $_POST['forma_pagamento'] == 'Crédito' ? $_POST['bandeira_cartao'] : null,
        'cartao_prefixo' => $_POST['forma_pagamento'] == 'Crédito' ? substr($_POST['cartao_numero'], 0, 6) : null,
        'cartao_sufixo' => $_POST['forma_pagamento'] == 'Crédito' ? substr($_POST['cartao_numero'], -4) : null,
        'endereco' => $_POST['endereco']
    ];

    $resultado = $doador->criarDoador($dados);
    echo $resultado;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $doador = new Doadores();
    $doadores = $doador->listarDoadores();
    echo json_encode($doadores);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $doador = new Doadores();
    $id = $_POST['id'];

    $dados = [
        'nome' => $_POST['nome'],
        'email' => $_POST['email'],
        'cpf' => $_POST['cpf'],
        'telefone' => $_POST['telefone'],
        'data_nascimento' => $_POST['data_nascimento'],
        'intervalo_doacao' => $_POST['intervalo_doacao'],
        'valor_doacao' => $_POST['valor_doacao'],
        'forma_pagamento' => $_POST['forma_pagamento'],
        'conta_debito' => $_POST['forma_pagamento'] == 'Débito' ? $_POST['conta_debito'] : null,
        'bandeira_cartao' => $_POST['forma_pagamento'] == 'Crédito' ? $_POST['bandeira_cartao'] : null,
        'cartao_prefixo' => $_POST['forma_pagamento'] == 'Crédito' ? substr($_POST['cartao_numero'], 0, 6) : null,
        'cartao_sufixo' => $_POST['forma_pagamento'] == 'Crédito' ? substr($_POST['cartao_numero'], -4) : null,
        'endereco' => $_POST['endereco']
    ];

    $resultado = $doador->atualizarDoador($id, $dados);
    echo $resultado;
}


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete'])) {
    $doador = new Doadores();
    $id = $_GET['delete'];

    $resultado = $doador->deletarDoador($id);
    echo $resultado;
}

?>
