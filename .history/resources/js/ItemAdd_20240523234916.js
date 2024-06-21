@param handler
$(document).ready(function() {
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
                    $(this).val(formattedValue);
                }
            });

            function formatCurrency(value) {
                value = parseFloat(value.replace(/,/g, '')).toFixed(2);
                return value.replace(/\d(?=(\d{3})+\.)/g, '$&,');
            }
        });
