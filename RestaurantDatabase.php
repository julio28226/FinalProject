<?php
class RestaurantDatabase
{
    private $host = "localhost";
    private $port = "3306";
    private $database = "restaurant_reservations";
    private $user = "root";
    private $password = "";
    private $connection;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database, $this->port);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
        // echo "Successfully connected to the database";
    }

    public function addReservation($customerId, $reservationTime, $numberOfGuests, $specialRequests)
    {
        $stmt = $this->connection->prepare(
            "INSERT INTO reservations (customerId, reservationTime, numberOfGuests, specialRequests) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("isis", $customerId, $reservationTime, $numberOfGuests, $specialRequests);
        $stmt->execute();
        $stmt->close();
        echo "Reservation added successfully";
    }

    public function getRow($table_name, $column, $Id)
    {
        $row = $this->connection->query("SELECT * FROM `$table_name` WHERE `$column`='$Id'");
        return $row->fetch_row();
    }

    public function delete($table_name, $column, $id)
    {
        $sql = "DELETE FROM `$table_name` WHERE `$column`='$id'";
        return $this->connection->query($sql);
    }

    public function findReservations($customerId)
    {
        $reservations = $this->connection->query("SELECT * FROM reservations JOIN `customers` ON customers.customerId=reservations.customerId WHERE reservations.customerId='$customerId'");
        return $reservations;
    }

    public function deleteReservation($reservationId)
    {
        $sql = "DELETE FROM `reservations` WHERE `reservationId`='$reservationId'";
        return $this->connection->query($sql);
    }

    public function addSpecialRequest($reservationId, $request)
    {
        $sql = "UPDATE `reservations` SET `specialRequests`='$request' WHERE `reservationId`='$reservationId'";
        return $this->connection->query($sql);
    }

    public function getAllReservations($join = '')
    {
        $result = $this->connection->query("SELECT * FROM reservations" . $join);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insert($table_name, $data)
    {
        $string = "INSERT INTO " . $table_name . " (";
        $string .= implode(",", array_keys($data)) . ') VALUES (';
        $string .= "'" . implode("','", array_values($data)) . "')";
        if ($this->connection->query($string)) {
            return $this->connection->insert_id;
        }
    }

    public function getResult($sql)
    {
        $result = $this->connection->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get($sql)
    {
        $result = $this->connection->query($sql);
        return $result->fetch_assoc();
    }

    public function getAllPreferences($join = '')
    {
        $result = $this->connection->query("SELECT * FROM diningpreferences" . $join);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function searchPreferences($customerId)
    {
        $preferences = $this->connection->query("SELECT * FROM diningpreferences JOIN `customers` ON customers.customerId=diningpreferences.customerId WHERE diningpreferences.customerId='$customerId'");
        return $preferences;
    }

    public function addCustomer($customerName, $contactInfo)
    {
        //Write Code here
        $customerId = $this->insert('customers', ['customerName' => $customerName, 'contactInfo' => $contactInfo]);

        return $customerId;
    }

    public function getCustomerPreferences($customerId)
    {
        $preferences = $this->connection->query("SELECT * FROM diningpreferences JOIN `customers` ON customers.customerId=diningpreferences.customerId WHERE diningpreferences.customerId='$customerId'");
        return $preferences;
    }

    public function deletePreference($preferenceId)
    {
        $preferences = $this->connection->query("DELETE FROM diningpreferences WHERE preferenceId='$preferenceId'");
        return $preferences;
    }

    public function deleteCustomer($customerId)
    {
        $customer = $this->connection->query("DELETE FROM customers WHERE customerId='$customerId'");
        return $customer;
    }
}
