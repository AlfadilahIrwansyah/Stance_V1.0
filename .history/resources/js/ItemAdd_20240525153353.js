$(document).ready(function() {

            $('#item_code, #item_buy_price, #item_name, #item_sell_price, #item_stock, #item_category, #item_desc, #item_active').on('blur', function() {
                validateitem(this);
            });

            $('#item_sell_price').on('input', function() {
                var sellPrice = $(this).val().trim();
                var checkbox = $('#item_active');
                if (sellPrice !== '') {
                    checkbox.prop('disabled', false);
                } else {
                    checkbox.prop('disabled', true);
                }
            });

            $('#item_sell_price').on('blur', function() {
                let value = $(this).val();
                if (value !== '') {
                    let formattedValue = formatCurrency(value);
                    let checkchart = /[a-zA-Z]/;
                    if(checkchart.test(value))
                        $(this).addClass('is-invalid');
                    else{
                        $(this).val(formattedValue);
                    }
                }else{
                    value.text('0.00');
                }
            });
            $('#item_buy_price').on('blur', function() {
                let value = $(this).val();
                if (value !== '') {
                    let checkchart = /[a-zA-Z]/;
                    let formattedValue = formatCurrency(value);
                    if(checkchart.test(value))
                        $(this).addClass('is-invalid');
                    else{
                        $(this).val(formattedValue);
                    }
                }else{
                    value.text('0.00');
                }
            });

            function formatCurrency(value) {
                var ValueFormatted = parseFloat(value.replace(/,/g, '')).toFixed(2);
                var Formatted = /^(?:\$)?\d{1,3}(?:,\d{3})*(\.\d{2})?$/;
                if (Formatted.test(value)) {
                    return value;
                }
                return ValueFormatted.replace(/\d(?=(\d{3})+\.)/g, '$&,');
            }

            function validateitem(field) {
                let fieldValue = $(field).val();
                let fieldName = $(field).attr('name');
                let _token = $('input[name="_token"]').val();
                let errorDiv = '#' + fieldName + 'Error';
                console.log(fieldName);
                if (fieldName === 'item_buy_price' || fieldName === 'item_sell_price') {
                    fieldValue = fieldValue.replace(/,/g, "");
                    console.log(fieldValue);
                }
                console.log(fieldValue);
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
        });
