<html>

<head>
    <title>View Preferences</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <h1 class="header">All Preferences</h1>
    <div class="container">
        <form action="index.php?action=viewPreferences" method="POST" class="pb-3">
            <div class="form-group pb-3">
                <label for="" class="fw-bold">Search Preferences: </label>
                <select name="customerId" id="customer" class="form-select">
                    <option value="">Select All</option>
                    <?php
                    $customers = $this->db->getResult("SELECT * FROM customers");
                    foreach ($customers as $customer) { ?>
                        <option value="<?= $customer['customerId'] ?>"><?= $customer['customerName'] ?></option>
                    <?php }
                    ?>
                </select><br>
            </div>
            <button class="btn btn-primary float-end mb-3" type="submit">Search</button>
        </form>
        <table border="1" class="table">
            <tr>
                <th>Reservation ID</th>
                <!-- <th>Customer ID</th> -->
                <th>Customer Name</th>
                <th>Favorite Table</th>
                <th>Dietary Restrictions</th>
                <th>Preferences</th>
                <th>Action</th>
            </tr>
            <?php
            foreach ($preferences as $preference): ?>
                <tr>
                    <td><?= htmlspecialchars($preference['preferenceId']) ?></td>
                    <!-- <td><?= htmlspecialchars($preference['customerId']) ?></td> -->
                    <td><?= htmlspecialchars($preference['customerName']) ?></td>
                    <td><?= htmlspecialchars($preference['favoriteTable']) ?></td>
                    <td><?= htmlspecialchars($preference['dietaryRestrictions']) ?></td>
                    <td><a href="index.php?action=getCustomerPreferences&customerId=<?= htmlspecialchars($preference['customerId']) ?>" class="">Get Customer Preferences</a></td>
                    <td><a onclick="return confirm('Are you sure?')" href="index.php?action=deletePreference&preferenceId=<?= htmlspecialchars($preference['preferenceId']) ?>" class="">Delete</a></td>
                    <!-- <td><a onclick="return confirm('Are you sure?')" href="index.php?action=deleteReservation&reservationId=<?= htmlspecialchars($preference['preferenceId']) ?>" class="">Delete</a></td> -->
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="index.php">Back to Home</a> |
        <a href="index.php?action=addPreference" class="">Add Preference</a>
    </div>


</body>

</html>