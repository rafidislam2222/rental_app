<?php
require_once "../core/Controller.php";

class BookingController extends Controller {

    // ================= FEATURE 6 ================= //
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
            $end_date   = $_POST['end_date'];

            // ✅ Validate dates
            if (strtotime($end_date) < strtotime($start_date)) {
                $_SESSION['error'] = "End date cannot be before start date.";
                // redirect back to property listing page
                header("Location: /rental_system/public/index.php?url=PropertyController/listAll");
                exit;
            }

            $bookingModel = $this->model("Booking");
            if ($bookingModel->createBooking($propertyId, $_SESSION['user_id'], $start_date, $end_date)) {
                // success → go to myBookings
                header("Location: /rental_system/public/index.php?url=BookingController/myBookings");
                exit;
            } else {
                // fail → property unavailable, show property details with error
                $error = "Booking failed! The property may already be booked for these dates.";
                header("Location: /rental_system/public/index.php?url=PropertyController/show/$propertyId&error=" . urlencode($error));
                exit;
            }
        } else {
            // direct access → redirect back to listAll
            header("Location: /rental_system/public/index.php?url=PropertyController/listAll");
            exit;
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

    // ================= FEATURE 7 (NEW) ================= //
    public function cancel($id) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'renter') {
            header("Location: /rental_system/public/index.php?url=UserController/login");
            exit;
        }

        $bookingModel = $this->model("Booking");
        $propertyModel = $this->model("Property");

        // Get booking first
        $booking = $bookingModel->getBookingById($id);

        if ($booking && $booking['renter_id'] == $_SESSION['user_id']) {
            // Cancel booking
            $bookingModel->updateStatus($id, 'cancelled');

            // Make property available again
            $propertyModel->updateAvailability($booking['property_id'], 'available');
        }

        header("Location: /rental_system/public/index.php?url=BookingController/myBookings");
        exit;
    }
}
?>
