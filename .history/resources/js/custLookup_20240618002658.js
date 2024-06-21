$(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var url = $(this).attr('href');
            $.ajax({
                url: url,
                success: function(data) {
                    $('#selectCustModalBody').html(data);
                }
            });
        });

        function selectCustomer(name, phone) {
            $('#customer_name').val(name);
            // Close the modal
            $('#selectCustModal').modal('hide');
        }
