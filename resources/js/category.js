$(function() {
function validateitem(field) {
        let fieldValue = $(field).val();
        let fieldName = $(field).attr('name');
        let _token = $('input[name="_token"]').val();
        let errorDiv = '#' + fieldName + 'Error';

        $.ajax({
            url: '/Category-validate',
            method: 'POST',
            data: {
                _token: _token,
                field: fieldName,
                value: fieldValue
            },
            success: function(response) {
                if (response.errors) {
                    $(field).addClass('is-invalid');
                    $(errorDiv).text(response.errors[0]);
                } else {
                    $(field).removeClass('is-invalid');
                    $(errorDiv).text('');
                }
            }
        });
    }

    $('#category_name').on('blur', function() {
        validateitem(this);
    });
});
