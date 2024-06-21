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
                    $(this).val(formattedValue);
                }
            });
            $('#item_buy_price').on('blur', function() {
                let value = $(this).val();
                if (value !== '') {
                    let formattedValue = formatCurrency(value);
                    i
                    $(this).val(formattedValue);
                }
            });

            function formatCurrency(value) {
                value = parseFloat(value.replace(/,/g, '')).toFixed(2);
                return value.replace(/\d(?=(\d{3})+\.)/g, '$&,');
            }

            function validateitem(field) {
                let fieldValue = $(field).val();
                let fieldName = $(field).attr('name');
                let _token = $('input[name="_token"]').val();
                let errorDiv = '#' + fieldName + 'Error';

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
