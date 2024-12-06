<html>

<head>
    <title>View Reservations</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <h1 class="header">All Reservations</h1>
    <div class="container">

        <table border="1" class="table">
            <tr>
                <th>Reservation ID</th>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Reservation Time</th>
                <th>Number of Guests</th>
                <th>Special Requests</th>
                <th>Reservations</th>
                <th>Action</th>
            </tr>
            <?php
            foreach ($reservations as $reservation): ?>
                <tr>
                    <td><?= htmlspecialchars($reservation['reservationId']) ?></td>
                    <td><?= htmlspecialchars($reservation['customerId']) ?></td>
                    <td><?= htmlspecialchars($reservation['customerName']) ?></td>
                    <td><?= htmlspecialchars($reservation['reservationTime']) ?></td>
                    <td><?= htmlspecialchars($reservation['numberOfGuests']) ?></td>
                    <td><?= htmlspecialchars($reservation['specialRequests']) ?></td>
                    <td><a href="index.php?action=findReservations&customerId=<?= htmlspecialchars($reservation['customerId']) ?>" class="">View</a></td>
                    <td>
                        <a href="index.php?action=addSpecialRequest&reservationId=<?= htmlspecialchars($reservation['reservationId']) ?>" class="">Request</a> |
                        <a onclick="return confirm('Are you sure?')" href="index.php?action=deleteReservation&reservationId=<?= htmlspecialchars($reservation['reservationId']) ?>" class="">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="index.php">Back to Home</a>
    </div>
</body>

</html>