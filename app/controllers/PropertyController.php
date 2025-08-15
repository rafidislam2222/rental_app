<?php
require_once "../core/Controller.php";

class PropertyController extends Controller {

    // ================= OWNER FUNCTIONS ================= //

    // Add property
    public function add() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'owner') {
            header("Location: /rental_system/public/index.php?url=UserController/login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $location = $_POST['location'];
            $price = $_POST['price'];
            $bedrooms = $_POST['bedrooms'];
            $amenities = $_POST['amenities'];
            $description = $_POST['description'];

            $propertyModel = $this->model("Property");
            $propertyId = $propertyModel->addProperty($_SESSION['user_id'], $title, $location, $price, $bedrooms, $amenities, $description);

            if ($propertyId) {
                // Upload images
                if (!empty($_FILES['images']['name'][0])) {
                    foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
                        $fileName = time() . "_" . $_FILES['images']['name'][$key];
                        $filePath = "public/images/" . $fileName;
                        move_uploaded_file($tmpName, "../" . $filePath);
                        $propertyModel->addImage($propertyId, $filePath);
                    }
                }
                header("Location: /rental_system/public/index.php?url=PropertyController/my_properties");
                exit;
            } else {
                $error = "Failed to add property!";
                $this->view("properties/add", ['error' => $error]);
            }
        } else {
            $this->view("properties/add");
        }
    }

    // Show owner's properties
    public function my_properties() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'owner') {
            header("Location: /rental_system/public/index.php?url=UserController/login");
            exit;
        }

        $propertyModel = $this->model("Property");
        $properties = $propertyModel->getPropertiesByOwner($_SESSION['user_id']);
        $this->view("properties/my_properties", ['properties' => $properties]);
    }

    // Edit property
    public function edit($id) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'owner') {
            header("Location: /rental_system/public/index.php?url=UserController/login");
            exit;
        }

        $propertyModel = $this->model("Property");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $location = $_POST['location'];
            $price = $_POST['price'];
            $bedrooms = $_POST['bedrooms'];
            $amenities = $_POST['amenities'];
            $description = $_POST['description'];

            $propertyModel->updateProperty($id, $title, $location, $price, $bedrooms, $amenities, $description);

            // Upload new images
            if (!empty($_FILES['images']['name'][0])) {
                foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
                    $fileName = time() . "_" . $_FILES['images']['name'][$key];
                    $filePath = "public/images/" . $fileName;
                    move_uploaded_file($tmpName, "../" . $filePath);
                    $propertyModel->addImage($id, $filePath);
                }
            }

            header("Location: /rental_system/public/index.php?url=PropertyController/my_properties");
            exit;
        } else {
            $property = $propertyModel->getPropertyById($id);
            $images = $propertyModel->getImagesByProperty($id);
            $this->view("properties/edit", ['property' => $property, 'images' => $images]);
        }
    }

    // Delete property
    public function delete($id) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'owner') {
            header("Location: /rental_system/public/index.php?url=UserController/login");
            exit;
        }

        $propertyModel = $this->model("Property");

        // Delete image files from server
        $images = $propertyModel->getImagesByProperty($id);
        foreach ($images as $img) {
            $filePath = "../" . $img['image_path'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $propertyModel->deleteProperty($id);
        header("Location: /rental_system/public/index.php?url=PropertyController/my_properties");
        exit;
    }

    // ================= RENTER FUNCTIONS ================= //

    // Feature 4: List all available properties (with optional filters in future)
    public function listAll() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Only keep filters if they have non-empty values
        $filters = [];
        if (!empty($_GET['location'])) {
            $filters['location'] = $_GET['location'];
        }
        if (!empty($_GET['min_price'])) {
            $filters['min_price'] = $_GET['min_price'];
        }
        if (!empty($_GET['max_price'])) {
            $filters['max_price'] = $_GET['max_price'];
        }
        if (!empty($_GET['bedrooms'])) {
            $filters['bedrooms'] = $_GET['bedrooms'];
        }

        $propertyModel = $this->model("Property");
        $properties = $propertyModel->getAvailableProperties($filters);

        $this->view("properties/list", ['properties' => $properties]);
    }
    // Book a property
    // Feature 6: Book a property
    public function book() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Only renters can book
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'renter') {
            header("Location: /rental_system/public/index.php?url=UserController/login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $propertyId = $_POST['property_id'] ?? null;
            $startDate = $_POST['start_date'] ?? null;
            $endDate = $_POST['end_date'] ?? null;

            if (!$propertyId || !$startDate || !$endDate) {
                $_SESSION['error'] = "All booking fields are required.";
                header("Location: /rental_system/public/index.php?url=PropertyController/listAll");
                exit;
            }

            $propertyModel = $this->model("Property");
            $result = $propertyModel->addBooking($propertyId, $_SESSION['user_id'], $startDate, $endDate);

            if ($result) {
                $_SESSION['success'] = "Booking request sent!";
            } else {
                $_SESSION['error'] = "Failed to book the property.";
            }

            header("Location: /rental_system/public/index.php?url=PropertyController/my_bookings");
            exit;
        }
    }
    // Show my bookings
    public function my_bookings() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'renter') {
            header("Location: /rental_system/public/index.php?url=UserController/login");
            exit;
        }

        $propertyModel = $this->model("Property");
        $bookings = $propertyModel->getBookingsByRenter($_SESSION['user_id']);

        $this->view("properties/my_bookings", ['bookings' => $bookings]);
    }
}        
?>
