import 'bootstrap';
import.meta.glob([
  '../images/**',
  '../fonts/**',
]);

$('#darkMode').chan('click', function() {
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
