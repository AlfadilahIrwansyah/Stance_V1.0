import 'bootstrap';
import.meta.glob([
  '../images/**',
  '../fonts/**',
]);

import './itemPage.js';
import './ItemAdd.js';
import './registerValidate.js';
import './sales.js';
import './category.js';




$(function() {
    let darkMode = localStorage.getItem('darkMode');
    if (darkMode === 'enabled') {
        $('#darkMode').prop('checked', true);
        $('body').removeClass('body-home-light');
        $('body').addClass('body-home-dark');
        $('nav').removeClass('navbar-light');
        $('nav').addClass('navbar-dark');
        // $('#chart').removeClass('bg-chart-light');
        // $('#chart').addClass('bg-chart-dark');

        $('.text').each(function() {
            if($(this).hasClass('text-dark'))
            {
                $(this).removeClass('text-dark');
                $(this).addClass('text-light');
            }
        });

        $('.btn').each(function() {
            if($(this).hasClass('btn-custom-light'))
            {
                $(this).removeClass('btn-custom-light');
                $(this).addClass('btn-custom-dark');
            }
        });
        $('.chart').each(function() {
            if($(this).hasClass('bg-chart-light'))
            {
                $(this).removeClass('bg-chart-light');
                $(this).addClass('bg-chart-dark');
            }
        });
    } else {
        $('#darkMode').prop('checked', false);
        $('body').addClass('body-home-light');
        $('body').removeClass('body-home-dark');
        $('.navbar').removeClass('navbar-dark');
        $('.navbar').addClass('navbar-light');
        // $('#chart').addClass('bg-chart-light');
        // $('#chart').removeClass('bg-chart-dark');

        $('.text').each(function() {
            if($(this).hasClass('text-light'))
            {
                $(this).removeClass('text-light');
                $(this).addClass('text-dark');
            }
        });

        $('.btn').each(function() {
            if($(this).hasClass('btn-custom-dark'))
            {
                $(this).removeClass('btn-custom-dark');
                $(this).addClass('btn-custom-light');
            }
        });
        $('.chart').each(function() {
            if($(this).hasClass('bg-chart-dark'))
            {
                $(this).removeClass('bg-chart-dark');
                $(this).addClass('bg-chart-light');
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
            // $('#chart').removeClass('bg-chart-light');
            // $('#chart').addClass('bg-chart-dark');

            $('.text').each(function() {
                if($(this).hasClass('text-dark'))
                {
                    $(this).removeClass('text-dark');
                    $(this).addClass('text-light');
                }
            });

            $('.btn').each(function() {
                if($(this).hasClass('btn-custom-light'))
                {
                    $(this).removeClass('btn-custom-light');
                    $(this).addClass('btn-custom-dark');
                }
            });

            $('.chart').each(function() {
                if($(this).hasClass('bg-chart-light'))
                {
                    $(this).removeClass('bg-chart-light');
                    $(this).addClass('bg-chart-dark');
                }
            });
            localStorage.setItem('darkMode', 'enabled');
        } else {
            $('body').addClass('body-home-light');
            $('body').removeClass('body-home-dark');
            $('nav').removeClass('navbar-dark');
            $('nav').addClass('navbar-light');
            // $('#chart').addClass('bg-chart-light');
            // $('#chart').removeClass('bg-chart-dark');

            $('.text').each(function() {
                if($(this).hasClass('text-light'))
                {
                    $(this).removeClass('text-light');
                    $(this).addClass('text-dark');
                }
            });

            $('.btn').each(function() {
                if($(this).hasClass('btn-custom-dark'))
                {
                    $(this).removeClass('btn-custom-dark');
                    $(this).addClass('btn-custom-light');
                }
            });

            $('.chart').each(function() {
                if($(this).hasClass('bg-chart-dark'))
                {
                    $(this).removeClass('bg-chart-dark');
                    $(this).addClass('bg-chart-light');
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

    $(document).on('click',function(event) {
        if (!sidebar.is(event.target) && !sidebar.has(event.target).length && !toggleBtn.is(event.target)) {
            sidebar.addClass('collapsed');
            mainContent.addClass('collapsed');
            $('.nav-link').aria-expanded(false);
            $('.sidebar-header').contents('sidebar-logo').removeProp;
        }
    });

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

    setTimeout(function() {
            $('.alert-fixed').fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 5000);
});
