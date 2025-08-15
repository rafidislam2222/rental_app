<?php
require_once "../core/Controller.php";

class BookingController extends Controller {
    public function book($propertyId) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'renter') {
            header("Location: /rental_system/public/index.php?url=UserController/login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];

            $bookingModel = $this->model("Booking");
            if ($bookingModel->createBooking($propertyId, $_SESSION['user_id'], $start_date, $end_date)) {
                header("Location: /rental_system/public/index.php?url=BookingController/myBookings");
                exit;
            } else {
                $error = "Booking failed!";
                $this->view("bookings/book", ['error' => $error, 'property_id' => $propertyId]);
            }
        } else {
            $this->view("bookings/book", ['property_id' => $propertyId]);
        }
    }

    public function myBookings() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $bookingModel = $this->model("Booking");
        $bookings = $bookingModel->getBookingsByRenter($_SESSION['user_id']);
        $this->view("bookings/myBookings", ['bookings' => $bookings]);
    }
}
?>
