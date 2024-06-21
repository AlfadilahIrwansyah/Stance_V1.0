import 'bootstrap';
import.meta.glob([
  '../images/**',
  '../fonts/**',
]);

import './itemPage.js';
import './ItemAdd.js';
import './registerValidate.js';
import './sales.js';


$(function() {
    let isChecked = $(this).prop('checked');
        if (isChecked) {
        $('body').removeClass('body-home-light').addClass('body-home-dark');
        $('.navbar').removeClass('navbar-light').addClass('navbar-dark');

        $('.text').each(function() {
            $(this).removeClass('text-dark').addClass('text-light');
        });

        $('.btn').each(function() {
            $(this).removeClass('btn-custom-light').addClass('btn-custom-dark');
        });

        $('.chart').each(function() {
            $(this).removeClass('bg-chart-light').addClass('bg-chart-dark');
        });
            localStorage.setItem('darkMode', 'enabled');
        } else {
            $('body').removeClass('body-home-dark').addClass('body-home-light');
        $('.navbar').removeClass('navbar-dark').addClass('navbar-light');

        $('.text').each(function() {
            $(this).removeClass('text-light').addClass('text-dark');
        });

        $('.btn').each(function() {
            $(this).removeClass('btn-custom-dark').addClass('btn-custom-light');
        });

        $('.chart').each(function() {
            $(this).removeClass('bg-chart-dark').addClass('bg-chart-light');
        });

            localStorage.setItem('darkMode', 'disabled');
        }


    $('#darkMode').on('change', function() {
        let isChecked = $(this).prop('checked');
        if (isChecked) {
        $('body').removeClass('body-home-light').addClass('body-home-dark');
        $('.navbar').removeClass('navbar-light').addClass('navbar-dark');

        $('.text').each(function() {
            $(this).removeClass('text-dark').addClass('text-light');
        });

        $('.btn').each(function() {
            $(this).removeClass('btn-custom-light').addClass('btn-custom-dark');
        });

        $('.chart').each(function() {
            $(this).removeClass('bg-chart-light').addClass('bg-chart-dark');
        });
            localStorage.setItem('darkMode', 'enabled');
        } else {
            $('body').removeClass('body-home-dark').addClass('body-home-light');
        $('.navbar').removeClass('navbar-dark').addClass('navbar-light');

        $('.text').each(function() {
            $(this).removeClass('text-light').addClass('text-dark');
        });

        $('.btn').each(function() {
            $(this).removeClass('btn-custom-dark').addClass('btn-custom-light');
        });

        $('.chart').each(function() {
            $(this).removeClass('bg-chart-dark').addClass('bg-chart-light');
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
