function validateitem(field) {
        let fieldValue = $(field).val();
        let fieldName = $(field).attr('name');
        let _token = $('input[name="_token"]').val();
        let errorDiv = '#' + fieldName + 'Error';
        if (fieldName === 'item_buy_price' || fieldName === 'item_sell_price') {
            fieldValue = fieldValue.replace(/,/g, "");
        }
        $.ajax({
            url: '/validate-item',
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
