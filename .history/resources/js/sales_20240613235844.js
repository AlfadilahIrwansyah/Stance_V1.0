$(document).ready(function() {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        function updatePeriod() {
            let periodStart = $('#period-start').val();
            let periodEnd = $('#period-end').val();

            $.ajax({
                url: '/SalesPersonal',
                type: 'POST',
                data: {
                    period_start: periodStart,
                    period_end: periodEnd,
                },
                success: function(response) {
                    console.log(periodStart);
                    console.log(periodEnd);
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        }

        $('#period-start, #period-end').on('change', updatePeriod);
});
