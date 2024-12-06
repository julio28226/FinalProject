<html>

<head>
    <title>Reservations of <?= $customer['customerName'] ?></title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <h1 class="header">All Reservations of <?= $customer['customerName'] ?></h1>
    <div class="container">

        <table border="1" class="table">
            <tr>
                <th>Reservation ID</th>
                <th>Customer ID</th>
                <th>Reservation Time</th>
                <th>Number of Guests</th>
                <th>Special Requests</th>
            </tr>
            <?php foreach ($reservations as $reservation):
            ?>
                <tr>
                    <td><?= htmlspecialchars($reservation['reservationId']) ?></td>
                    <td><?= htmlspecialchars($reservation['customerId']) ?></td>
                    <td><?= htmlspecialchars($reservation['reservationTime']) ?></td>
                    <td><?= htmlspecialchars($reservation['numberOfGuests']) ?></td>
                    <td><?= htmlspecialchars($reservation['specialRequests']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="index.php">Back to Home</a> |
        <a href="index.php?action=viewReservations" class="">View Reservations</a>
    </div>
</body>

</html>