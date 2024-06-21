$(function() {
        // Function to update the period when either date input is changed
        function updatePeriod() {
            // Get the date values from the input fields
            let periodStart = $('#period-start').val();
            let periodEnd = $('#period-end').val();

            // Perform an AJAX request to your route
            $.ajax({
                url: '/', // Replace with your route
                type: 'POST',
                data: {
                    period_start: periodStart,
                    period_end: periodEnd,
                    _token: '{{ csrf_token() }}' // CSRF token for security
                },
                success: function(response) {
                    // Handle the response data
                    console.log(response);
                    // Optionally update the UI with the response data
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        }

        $('#period-start, #period-end').on('change', updatePeriod);
});
