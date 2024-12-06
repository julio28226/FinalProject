<?php
require_once 'restaurantDatabase.php';

class RestaurantPortal
{
    private $db;

    public function __construct()
    {
        $this->db = new RestaurantDatabase();
    }

    public function handleRequest()
    {
        $action = $_GET['action'] ?? 'home';

        switch ($action) {
            case 'addReservation':
                $this->addReservation();
                break;
            case 'viewReservations':
                $this->viewReservations();
                break;
            case 'findReservations':
                $this->findReservations();
                break;
            case 'addSpecialRequest':
                $this->addSpecialRequest();
                break;
            case 'deleteReservation':
                $this->deleteReservation();
                break;
            case 'addPreference':
                $this->addPreference();
                break;
            case 'viewPreferences':
                $this->viewPreferences();
                break;
            case 'getCustomerPreferences':
                $this->getCustomerPreferences();
                break;
            case 'deletePreference':
                $this->deletePreference();
                break;
            case 'Customers':
                $this->Customers();
                break;
            case 'deleteCustomer':
                $this->deleteCustomer();
                break;
            default:
                $this->home();
        }
    }

    private function home()
    {
        include 'templates/home.php';
    }


    private function Customers()
    {
        $customers = $this->db->getResult("SELECT * FROM customers");
        include 'templates/customers.php';
    }

    private function deleteCustomer()
    {
        $customerId = $_GET['customerId'];
        $customer = $this->db->deleteCustomer($customerId);
        header("Location: index.php?action=Customers&message=Customer Deleted");
    }

    private function addReservation()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customerName =  $_POST['customerName'];
            $contactInfo = $_POST['contactInfo'];
            $customer = $this->db->getRow('customers', 'contactInfo', $customerName);
            $customerId = $_POST['customerId'];
            if (empty($customer)) {
                $customerId = $this->db->addCustomer($customerName, $contactInfo);
            }
            $reservationTime = $_POST['reservationTime'];
            $numberOfGuests = $_POST['numberOfGuests'];
            $specialRequests = $_POST['specialRequests'];
            if (!empty($customerId)) {
                $this->db->addReservation($customerId, $reservationTime, $numberOfGuests, $specialRequests);
            }
            header("Location: index.php?action=viewReservations&message=Reservation Added");
        } else {
            $customers = $this->db->getResult("SELECT * FROM customers");
            include 'templates/addReservation.php';
        }
    }

    private function addPreference()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customerId = $_POST['customerId'];
            $favoriteTable = $_POST['favoriteTable'];
            $dietaryRestrictions = $_POST['dietaryRestrictions'];
            if (!empty($customerId)) {
                $this->db->insert('diningpreferences', ['customerId' => $customerId, 'favoriteTable' => $favoriteTable, 'dietaryRestrictions' => $dietaryRestrictions]);
            }
            header("Location: index.php?action=viewPreferences&message=Preference Added");
        } else {
            $customers = $this->db->getResult("SELECT * FROM customers");
            include 'templates/addPreference.php';
        }
    }


    private function addSpecialRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reservationId = $_POST['reservationId'];
            $request = $_POST['specialRequests'];
            $reservations = $this->db->addSpecialRequest($reservationId, $request);
            header("Location: index.php?action=viewReservations&message=Reservation Requested!");
        } else {
            $reservationId = $_GET['reservationId'];
            $reservation = $this->db->get("SELECT * FROM reservations WHERE `reservationId`='$reservationId'");
            include 'templates/addSpecialRequest.php';
        }
    }

    private function deleteReservation()
    {
        $reservationId = $_GET['reservationId'];
        $reservations = $this->db->deleteReservation($reservationId);
        header("Location: index.php?action=viewReservations&message=Reservation Deleted!");
    }

    private function viewReservations()
    {
        $reservations = $this->db->getAllReservations(" JOIN customers ON customers.customerId=reservations.customerId");
        include 'templates/viewReservations.php';
    }


    private function viewPreferences()
    {
        $where = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['customerId'] != '') {
            $customerId = $_POST['customerId'];
            $preferences = $this->db->searchPreferences($customerId);
        } else {
            $preferences = $this->db->getAllPreferences(" JOIN customers ON customers.customerId=diningpreferences.customerId" . $where);
        }
        include 'templates/viewPreferences.php';
    }

    private function findReservations()
    {
        $customerId = $_GET['customerId'];
        $customer = $this->db->get("SELECT * FROM customers WHERE `customerId`='$customerId'");
        $reservations = $this->db->findReservations($customerId);
        include 'templates/reservations.php';
    }


    private function getCustomerPreferences()
    {
        $customerId = $_GET['customerId'];
        $customer = $this->db->get("SELECT * FROM customers WHERE `customerId`='$customerId'");
        $preferences = $this->db->getCustomerPreferences($customerId);
        include 'templates/preferences.php';
    }

    private function deletePreference()
    {
        $preferenceId = $_GET['preferenceId'];
        $preferences = $this->db->deletePreference($preferenceId);
        header("Location: index.php?action=viewPreferences&message=Preference Deleted");
    }
}

$portal = new RestaurantPortal();
$portal->handleRequest();
