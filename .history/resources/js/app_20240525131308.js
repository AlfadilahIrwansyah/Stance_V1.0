import 'bootstrap';
import.meta.glob([
  '../images/**',
  '../fonts/**',
]);

// $('#darkMode').on('click', function() {
// let value = $(this).chec();
// if (value !== '') {
// let formattedValue = formatCurrency(value);
// if(formattedValue == 'NaN')
// $(this).addClass('is-invalid');
// else{
// $(this).val(formattedValue);
// }
// }
//  });

$(document).ready(function() {
    let darkMode = localStorage.getItem('darkMode');
    if (darkMode === 'enabled') {
        $('#darkMode').prop('checked', true);
        $('body').removeClass('body-home-light').addClass('body-home-dark');
        $('.text').each(function() {
        $(this).removeClass('text-dark').addClass('text-light');
        });
    } else {
        $('#darkMode').prop('checked', false);
        $('body').removeClass('body-home-dark').addClass('body-home-light');
        $('.text').each(function() {
            $(this).removeClass('text-light').addClass('text-dark');
        });
    }


$('#darkMode').on('change', function() {
let isChecked = $(this).prop('checked');
if (isChecked) {
$('body').removeClass('body-home-light');
$('body').addClass('body-home-dark');
 $('.text').each(function() {
if($(this).hasClass('text-dark'))
{
$(this).removeClass('text-dark');
$(this).addClass('text-light');
}
});
} else {
$('body').addClass('body-home-light');
$('body').removeClass('body-home-dark');
$('.text').each(function() {
if($(this).hasClass('text-light'))
{
$(this).addClass('text-dark');
$(this).removeClass('text-light');
}
});
}
});
});
