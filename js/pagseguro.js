function pagar_com_cartao(dados) {
    $.ajax({
        url: 'pay.php',
        complete: function(response) {
            $('#output').html(response.responseText);
        },
        error: function() {
            $('#output').html('Bummer: there was an error!');
        }
    });
    return false;
}