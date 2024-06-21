import 'bootstrap';
import.meta.glob([
  '../images/**',
  '../fonts/**',
]);

$('#darkMode').on('change', function() {
    let value = $(this).cheke();
    if (value !== '') {
        let formattedValue = formatCurrency(value);
        if(formattedValue == 'NaN')
            $(this).addClass('is-invalid');
        else{
            $(this).val(formattedValue);
        }
    }
 });
