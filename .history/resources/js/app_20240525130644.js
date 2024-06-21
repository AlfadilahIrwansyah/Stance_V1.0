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
                $(this).removeClass('text-dark').addClass('text-light');
                    if($('.text').hasClass('text-dark'))
                    {
                        $('.text').removeClass('text-dark');
                        $('.text').addClass('text-light');
                    }
                });
            } else {
                $('body').addClass('body-home-light');
                $('body').removeClass('body-home-dark');
                if($('.text').hasClass('text-light'))
                {
                    $('.text').addClass('text-dark');
                    $('.text').removeClass('text-light');
                }
            }
        });
    });
