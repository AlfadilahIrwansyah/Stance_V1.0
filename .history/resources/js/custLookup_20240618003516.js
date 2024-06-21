$(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var url = $(this).attr('href');
            $.ajax({
                url: '/customers/paginate',
                success: function(data) {
                    $('#selectCustModalBody').html(data);
                }
            });
        });

        function selectCustomer(name) {
            $('#customer_name').val(name);
            $('#selectCustModal').modal('hide');
        }
