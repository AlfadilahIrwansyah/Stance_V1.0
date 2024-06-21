$(document).ready(function() {
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
                    console.log(response);
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        }

        $('#period-start, #period-end').on('change', updatePeriod);
});
