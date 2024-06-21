import 'bootstrap';
import.meta.glob([
  '../images/**',
  '../fonts/**',
]);

$('#darkMode').on(function'change', function() {
    let value = $(this).chec();
    if (value !== '') {
        let formattedValue = formatCurrency(value);
        if(formattedValue == 'NaN')
            $(this).addClass('is-invalid');
        else{
            $(this).val(formattedValue);
        }
    }
 });
