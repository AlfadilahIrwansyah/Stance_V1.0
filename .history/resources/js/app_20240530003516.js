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
        $('body').removeClass('body-home-light');
        $('body').addClass('body-home-dark');
        $('nav').removeClass('navbar-light');
        $('nav').addClass('navbar-dark');
        $('.text').each(function() {
            if($(this).hasClass('text-dark'))
            {
                $(this).removeClass('text-dark');
                $(this).addClass('text-light');
            }
        });
    } else {
        $('#darkMode').prop('checked', false);
        $('body').addClass('body-home-light');
        $('body').removeClass('body-home-dark');
        $('.navbar').removeClass('navbar-dark');
        $('.navbar').addClass('navbar-light');
        $('.text').each(function() {
            if($(this).hasClass('text-light'))
            {
                $(this).removeClass('text-light');
                $(this).addClass('text-dark');
            }
        });
    }


    $('#darkMode').on('change', function() {
        let isChecked = $(this).prop('checked');
        if (isChecked) {
            $('body').removeClass('body-home-light');
            $('body').addClass('body-home-dark');
            $('.navbar').removeClass('navbar-light');
            $('.navbar').addClass('navbar-dark');
            $('.text').each(function() {
                if($(this).hasClass('text-dark'))
                {
                    $(this).removeClass('text-dark');
                    $(this).addClass('text-light');
                }
            });
            localStorage.setItem('darkMode', 'enabled');
        } else {
            $('body').addClass('body-home-light');
            $('body').removeClass('body-home-dark');
            $('nav').removeClass('navbar-dark');
            $('nav').addClass('navbar-light');
            $('.text').each(function() {
                if($(this).hasClass('text-light'))
                {
                    $(this).removeClass('text-light');
                    $(this).addClass('text-dark');
                }
            });
            localStorage.setItem('darkMode', 'disabled');
        }
    });

    $('#toggle-btn').on('click', function() {
        $('#sidebar').toggleClass('collapsed');
        $('#main-content').toggleClass('collapsed');
        $('#sidebar-logo').toggleClass('collapsed');
    });

    const sidebar = $('#sidebar');
    const toggleBtn = $('#toggle-btn');
    const mainContent = $('#main-content');

    $(document).click(function(event) {
        if (!sidebar.is(event.target) && !sidebar.has(event.target).length && !toggleBtn.is(event.target)) {
            sidebar.addClass('collapsed');
            mainContent.addClass('collapsed');
        }
    });

    //navbar and sidebar show
    var currentPath = window.location.pathname;
    var route = ['/login', '/register']
    const navbarview = $('.navbar');
    const sidebarview = $('.sidebar');
    if (route.includes(currentPath)) {
        navbarview.addClass('d-none');
        sidebarview.addClass('d-none');
    } else {
        navbarview.removeClass('d-none');
        sidebarview.removeClass('d-none');
    }


    var hasBgDark = false;
    if (darkMode === 'enabled') {
        hasBgDark = true;
    }

        $.ajax({
            url: '/home-chart',
            method: 'GET',
            data: { isDark: hasBgDark },
            success: function(response) {
                // Update the chart container with the new chart
                $('#homeChart').html(response);
            }
        });



    $.ajax({
            url: '/home-chart',
            method: 'POST',
            data: {
                isDark: isDark,
                _token: '{{ csrf_token() }}' // Include CSRF token
            },
            success: function(response) {
                // Handle the response (assuming the response is in JSON format)
                // Update the chart in your view
                // For example, you might replace the chart container's content:
                $('#homeChartContainer').html(response.chart);

                // If the chart is rendered using a specific library, make sure to initialize it again
                // For example, if you use ApexCharts:
                new ApexCharts(document.querySelector("#homeChartContainer"), response.chart.options).render();
            }
        });
});
