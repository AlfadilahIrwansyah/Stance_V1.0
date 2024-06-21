import 'bootstrap';
import.meta.glob([
  '../images/**',
  '../fonts/**',
]);

$('#item_sell_price').on('blur', function() {
                let value = $(this).val();
                if (value !== '') {
                    let formattedValue = formatCurrency(value);
                    if(formattedValue == 'NaN')
                        $(this).addClass('is-invalid');
                    else{
                        $(this).val(formattedValue);
                    }
                }
            });
