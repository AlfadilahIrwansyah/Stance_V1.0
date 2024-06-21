$(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            $.ajax({
                url: '/customers/paginate',
                success: function(data) {
                    $('#selectCustModalBody').html(data);
                }
            });
        });

        function selectCustomer(name, cust_id) {
            $('#customer_name').val(name);
            $('#ref_cust_id').val(name);
            $('#selectCustModal').modal('hide');
        }
