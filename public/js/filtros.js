$(document).ready(function() {
    $('#hotel').select2({
        placeholder: 'Pesquisar hotel',
        ajax: {
            url: '/hoteis/busca',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                var results = [];
            
                if (data && data.length) {
                    results = $.map(data, function(hotel) {
                        return {
                            id: hotel.id,
                            text: hotel.nome
                        };
                    });
                }
            
                return {
                    results: results
                };
            },
            cache: true
        },
    });

    $('#hotel').closest('.form-group').find('.select2-container').addClass('form-control');
});

$('#hotel').on('change', function() {
    var hotelId = $(this).val();

    // Limpar e desabilitar o dropdown dos quartos
    $('#quarto').empty().prop('disabled', true);

    if (hotelId) {
        // Fazer a requisição AJAX para obter os quartos
        $.ajax({
            url: '/quartos/' + hotelId,
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Preencher o dropdown dos quartos com os dados obtidos
                if (data && data.length) {
                    $.each(data, function(index, quarto) {
                        $('#quarto').append($('<option>', {
                            value: quarto.id,
                            text: quarto.nome
                        }));
                    });
                    
                    // Habilitar o dropdown dos quartos
                    $('#quarto').prop('disabled', false);
                }
            },
            error: function() {
                console.log('Erro ao obter os quartos.');
            }
        });
    }
});
