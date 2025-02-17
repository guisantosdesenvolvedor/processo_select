<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popup Exemplo</title>
    <style>
        /* Estilizando o fundo escuro do modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        /* Conteúdo do modal */
        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            margin: 15% auto;
            text-align: center;
        }

        /* Botão de fechar */
        .close {
            color: red;
            float: right;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <button onclick="abrirModal()">Abrir Popup</button>

    <div id="meuModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="fecharModal()">&times;</span>
            <p>Este é um popup!</p>
        </div>
    </div>

    <script>
        function abrirModal() {
            document.getElementById("meuModal").style.display = "block";
        }

        function fecharModal() {
            document.getElementById("meuModal").style.display = "none";
        }
    </script>

</body>
</html>
