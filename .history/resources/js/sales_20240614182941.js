$(function() {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        function updatePeriod() {
            let periodStart = $('#period-start').val();
            let periodEnd = $('#period-end').val();
            console.log('updatePeriod', periodStart, periodEnd);
            $.ajax({
                url: '/SalesInfo',
                type: 'POST',
                data: {
                    period_start: periodStart,
                    period_end: periodEnd,
                },
                success: function(response) {
                    $('#monthTableDetails').html(response.)
                }
            });
        }

        $('#period-start, #period-end').on('change', updatePeriod);
});
