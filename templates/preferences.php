<html>

<head>
    <title>Preferences of <?= $customer['customerName'] ?></title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <h1 class="header">All Preferences of <?= $customer['customerName'] ?></h1>
    <div class="container">

        <table border="1" class="table">
            <tr>
                <th>Reservation ID</th>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Favorite Table</th>
                <th>Dietary Restrictions</th>
                <!-- <th>Action</th> -->
            </tr>
            <?php
            foreach ($preferences as $preference): ?>
                <tr>
                    <td><?= htmlspecialchars($preference['preferenceId']) ?></td>
                    <td><?= htmlspecialchars($preference['customerId']) ?></td>
                    <td><?= htmlspecialchars($preference['customerName']) ?></td>
                    <td><?= htmlspecialchars($preference['favoriteTable']) ?></td>
                    <td><?= htmlspecialchars($preference['dietaryRestrictions']) ?></td>
                    <!-- <td><a onclick="return confirm('Are you sure?')" href="index.php?action=deleteReservation&reservationId=<?= htmlspecialchars($preference['preferenceId']) ?>" class="">Delete</a></td> -->
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="index.php">Back to Home</a> |
        <a href="index.php?action=viewPreferences" class="">View Preferences</a>
    </div>
</body>

</html>