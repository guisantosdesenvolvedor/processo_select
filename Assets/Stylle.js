$(document).ready(function() {
    $("#formCadastro").submit(function(event) {
        event.preventDefault(); // Impede o envio do formulário tradicional

        var formData = new FormData(this); // Serializa os dados do formulário

        // Envia os dados para o servidor via AJAX
        $.ajax({
            url: '../Controllers/DoadoresController.php',  // Certifique-se de que o caminho está correto
            type: 'POST',
            data: formData,
            processData: false,  // Impede o jQuery de processar os dados
            contentType: false,  // Impede o jQuery de definir automaticamente o contentType
            dataType: 'json',
            success: function(response) {
                if (response.success) {  // Se o cadastro foi bem-sucedido
                    alert("Seu cadastro foi confirmado!");

                    // Exibe e inicia o contador para redirecionamento
                    let contador = 5;
                    let contadorElement = $('#contador');
                    contadorElement.css({
                        'position': 'absolute',
                        'top': '20px',
                        'left': '50%',
                        'transform': 'translateX(-50%)',
                        'font-size': '20px',
                        'font-weight': 'bold'
                    }).html(`Redirecionando em ${contador} segundos...`);

                    let intervalo = setInterval(function() {
                        contador--;
                        contadorElement.html(`Redirecionando em ${contador} segundos...`);

                        if (contador <= 0) {
                            clearInterval(intervalo);
                            window.location.href = '../Views/index.php'; // URL correta para redirecionamento
                        }
                    }, 1000); // Atualiza o contador a cada 1 segundo
                } else {
                    alert("Houve um erro ao confirmar o cadastro. Tente novamente.");
                }
            },
            error: function(xhr, status, error) {
                console.error("Erro AJAX:", xhr.responseText);
                alert("Ocorreu um erro na requisição. Verifique o console para mais detalhes.");
            }
        });
    });
});
