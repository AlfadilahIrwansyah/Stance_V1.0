
$(function() {
    $('#item_code, #item_buy_price, #item_name, #item_sell_price, #item_stock, #item_category, #item_desc, #item_active').on('blur', function() {
        validateitem(this);
    });

    $('#item_sell_price').on('input', function() {
        var sellPrice = $(this).val().trim();
        var checkbox = $('#item_active');
        console.log(sellPrice);
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
            $(this).val('0.00');
        }
    });

    $('#item_buy_price').on('blur', function() {
        let value = $(this).val();
        console.log(value);
        if (value !== '') {
            let checkchart = /[a-zA-Z]/;
            let formattedValue = formatCurrency(value);
            if(checkchart.test(value))
    $(this).addClass('is-invalid');
            else{
    $(this).val(formattedValue);
            }
        }else{
            $(this).val('0.00');
        }
    });

    function formatCurrency(value, currency = false) {
        var ValueFormatted = parseFloat(value).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        var Formatted = /^(?:\$)?\d{1,3}(?:,\d{3})*(\.\d{2})?$/;
        if (Formatted.test(value)) {
            return value;
        }
        if (currency) {
            return 'Rp ' + ValueFormatted.replace(/\d(?=(\d{3})+\.)/g, '$&,');
        }
        return ValueFormatted.replace(/\d(?=(\d{3})+\.)/g, '$&,');
    }

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
    function selectedItem(itemSelect){
        var itemCode = itemSelect.val();
        $.ajax({
            url: '/get-item-details/' + itemCode,
            method: 'GET',
            success: function(response) {
                if (response) {
                    $('#itemName').val(response.ITEM_NAME);
                    $('#itemPrice').val(response.SELL_PRICE_AMT);
                } else {
                    alert('Item not found');
                }
            },
            error: function() {
                alert('Error fetching item details');
            }
        });
    }
    $('#searchItem').on('keyup', function() {
            var searchTerm = $(this).val().toLowerCase();
            $('#itemCode option').each(function() {
                var text = $(this).text().toLowerCase();
                if (text.indexOf(searchTerm) > -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    $('#itemCode').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var itemName = selectedOption.data('name');
            var itemPrice = selectedOption.data('price');
            var itemPrice = selectedOption.data('price');
            $('#itemName').val(itemName);
            $('#itemPrice').val(itemPrice);
        });
    $('#saveItemButton').on('click', function() {
            var itemCode = $('#itemCode').val();
            var itemName = $('#itemName').val();
            var itemQty = $('#itemQty').val() == 0 || $('#itemQty').val() == '' || $('#itemQty').val() == null ? 1 : $('#itemQty').val();
            var itemPrice = $('#itemPrice').val();
            var itemTotal = itemQty * itemPrice.replace(/[^0-9.-]+/g, "");

            var newRow = '<tr>' +
            '<td>' + itemCode + '</td>' +
            '<td>' + itemName + '</td>' +
            '<td>' + itemQty + '</td>' +
            '<td>'+ formatCurrency(itemPrice, true) + '</td>' +
            '<td>'+ formatCurrency(itemTotal, true) + '</td>' +
            '</tr>';
            $('#itemsTable tbody').append(newRow);
            $('#addItemModal').modal('hide');
            $('#addItemForm')[0].reset();
            $('#itemCode').val(null).trigger('change');
            calculateTotal();
        });

        function calculateTotal() {
            var subtotal = 0;
            $('#itemsTable tbody tr').each(function() {
                var total = parseFloat($(this).find('td').eq(4).text().replace(/[^0-9.-]+/g, ""));
                subtotal += total;
            });

            var tax = subtotal * 0.0;
            var grandTotal = subtotal + tax;

            $('#subtotal').text('Rp ' + formatCurrency(subtotal));
            $('#tax').text('Rp ' + formatCurrency(tax));
            $('#total').text('Rp ' + formatCurrency(grandTotal));
        }
});
