$(document).ready(function() {
    $('#buscar-btn').click(function() {
        var search = $('#search').val();
        $.ajax({
            type: "GET",
            url: "/SearchProducts",
            data: { search: search },
            success: function(response) {
            $('#searchs-products #body').html(response);
            }
        });
    });
});

$(document).ready(function() {
    $('#amount').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botón que activó el modal
        var id = button.data('id'); // Extraer el valor del atributo data-id
        var modal = $(this);
        modal.find('#id').val(id); // Actualizar el valor del input id en el formulario
    });
});