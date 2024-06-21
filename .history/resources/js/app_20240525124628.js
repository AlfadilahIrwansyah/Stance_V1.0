import 'bootstrap';
import.meta.glob([
  '../images/**',
  '../fonts/**',
]);

$('#darkMode').on('click', function() {
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
