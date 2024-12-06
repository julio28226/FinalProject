<html>

<head>
    <title>Add Special Request</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <h1 class="header">Add Special Request</h1>
    <div class="container">
        <form method="POST" action="index.php?action=addSpecialRequest">
            <input type="hidden" name="reservationId" value="<?= $_GET['reservationId'] ?>">
            <label for="" class="fw-bold">Special Requests:</label> <textarea name="specialRequests" rows="5" class="form-control" required><?= $reservation['specialRequests'] ?></textarea><br>
            <button type="submit" class="btn btn-primary float-end">Submit</button>
        </form>
        <a href="index.php" class="mt-5">Back to Home</a>

    </div>

    <script>
        $(function() {
            var customer = $('#customer').val();
            if (customer == '') {
                $('.hasCustomer').hide();
            } else {
                $('.hasCustomer').show();
            }

            $('#customer').change(function(e) {
                e.preventDefault();
                var customer = $('#customer').val();
                var customerName = $('option:selected', this).attr('customerName');
                var contactInfo = $('option:selected', this).attr('contactInfo');
                console.log(customerName);

                if (customer == '') {
                    $('.hasCustomer').hide();
                    $('input[name=customerId]').val('');
                    $('input[name=customerName]').val('');
                    $('input[name=contactInfo]').val('');
                } else {
                    $('input[name=customerId]').val(customer);
                    $('input[name=customerName]').val(customerName);
                    $('input[name=contactInfo]').val(contactInfo);
                    $('.hasCustomer').show();
                }
            });
        });
    </script>
</body>

</html>