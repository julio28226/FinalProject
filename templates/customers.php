<html>

<head>
    <title>Customers</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <h1 class="header">All Customers</h1>
    <div class="container">

        <table border="1" class="table">
            <tr>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Contact Info</th>
                <th>Action</th>
            </tr>
            <?php
            foreach ($customers as $customer): ?>
                <tr>
                    <td><?= htmlspecialchars($customer['customerId']) ?></td>
                    <td><?= htmlspecialchars($customer['customerName']) ?></td>
                    <td><?= htmlspecialchars($customer['contactInfo']) ?></td>
                    <td>
                        <a onclick="return confirm('Are you sure?')" href="index.php?action=deleteCustomer&customerId=<?= htmlspecialchars($customer['customerId']) ?>" class="">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="index.php">Back to Home</a>
    </div>
</body>

</html>