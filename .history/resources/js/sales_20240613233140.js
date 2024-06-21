$(function() {
        // Function to update the period when either date input is changed
        function updatePeriod() {
            // Get the date values from the input fields
            let periodStart = $('#period-start').val();
            let periodEnd = $('#period-end').val();

            // Perform an AJAX request to your route
            $.ajax({
                url: '/SalesFilter',
                type: 'POST',
                data: {
                    period_start: periodStart,
                    period_end: periodEnd,
                    _token: '{{ csrf_token() }}'
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
