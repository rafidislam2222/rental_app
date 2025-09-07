<?php
require_once "../core/Controller.php";

class ReviewController extends Controller {

    // Show add review form
    public function add($propertyId) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Only renters can leave reviews
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'renter') {
            header("Location: /rental_system/public/index.php?url=UserController/login");
            exit;
        }

        // Pass property_id into the form
        $this->view("reviews/add", ['property_id' => $propertyId]);
    }

    // Save review to database
    public function save() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $propertyId = $_POST['property_id'] ?? null;
            $rating     = $_POST['rating'] ?? null;
            $comment    = $_POST['comment'] ?? null;
            $renterId   = $_SESSION['user_id'] ?? null;

            // Validate
            if (!$propertyId || !$renterId || !$rating) {
                $_SESSION['error'] = "All fields are required!";
                header("Location: /rental_system/public/index.php?url=BookingController/myBookings");
                exit;
            }

            // Save to DB
            $reviewModel = $this->model("Review");
            $reviewModel->addReview($propertyId, $renterId, $rating, $comment);

            $_SESSION['success'] = "Review submitted successfully!";
            header("Location: /rental_system/public/index.php?url=BookingController/myBookings");
            exit;
        }
    }
}
?>
