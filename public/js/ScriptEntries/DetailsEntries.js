$(document).ready(function() {
    $('.details-btn').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: "/details_entries",
            data: { id: id },
            success: function(response) {
                $('#details-entries #body').html(response);
            }
        });
    });
});