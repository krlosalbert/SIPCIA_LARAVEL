//para activar el modal y buscar los productos
$(document).ready(function() {
    $('#search-btn').click(function() {
        var search = $('#search_pro').val();
        console.log(search);
        $.ajax({
            type: "GET",
            url: "/SearchProducts",
            data: { search: search },
            success: function(response) {
            $('#search-product #body').html(response);
            }
        });
    });
});

//para mostrar el modal y solicitar la cantidad
$(document).ready(function() {
    $('#amount').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botón que activó el modal
        var id = button.data('id'); // Extraer el valor del atributo data-id
        var modal = $(this);
        modal.find('#id').val(id); // Actualizar el valor del input id en el formulario
    });
});