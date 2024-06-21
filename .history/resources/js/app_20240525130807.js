import 'bootstrap';
import.meta.glob([
  '../images/**',
  '../fonts/**',
]);

// $('#darkMode').on('click', function() {
//     let value = $(this).chec();
//     if (value !== '') {
//         let formattedValue = formatCurrency(value);
//         if(formattedValue == 'NaN')
//             $(this).addClass('is-invalid');
//         else{
//             $(this).val(formattedValue);
//         }
//     }
//  });

 $(document).ready(function() {
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
                    if($(this).hasClass('text-dark'))
                    {
                        $(this).addClass('text-dark');
                        $(this).addClass('text-light');
                    }
                });
            }
        });
    });
