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
            $price = (int)$_POST['price'];
            $bedrooms = (int)$_POST['bedrooms'];
            $amenities = $_POST['amenities'];
            $description = $_POST['description'];

            $propertyModel = $this->model("Property");
            if ($price < 0 || $bedrooms < 0) {
                $error = "Price and Bedrooms cannot be negative!";
                $this->view("properties/add", ['error' => $error]);
                return; // stop execution
            }
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
            $price = (int)$_POST['price'];
            $bedrooms = (int)$_POST['bedrooms'];
            $amenities = $_POST['amenities'];
            $description = $_POST['description'];
            if ($price < 0 || $bedrooms < 0) {
                $error = "Price and Bedrooms cannot be negative!";
                $property = $propertyModel->getPropertyById($id);
                $images = $propertyModel->getImagesByProperty($id);
                $this->view("properties/edit", [
                    'error' => $error,
                    'property' => $property,
                    'images' => $images
                ]);
                return;
            }


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
    // Feature 4: List all properties (available + booked, with booked status)
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
        // 🔹 New function: getAllPropertiesWithStatus (includes booked ones too)
        $properties = $propertyModel->getAllPropertiesWithStatus($filters);
        foreach ($properties as &$prop) {
            $prop['reviews'] = $propertyModel->getReviewsByProperty($prop['id']);
            $prop['images']  = $propertyModel->getImagesByProperty($prop['id']); // 🔹 add this
        }

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
            $startDate  = $_POST['start_date'] ?? null;
            $endDate    = $_POST['end_date'] ?? null;

            if (!$propertyId || !$startDate || !$endDate) {
                $_SESSION['error'] = "All booking fields are required.";
                header("Location: /rental_system/public/index.php?url=PropertyController/listAll");
                exit;
            }

            // ✅ Check date validity
            if (strtotime($endDate) < strtotime($startDate)) {
                $_SESSION['error'] = "End date cannot be before start date.";
                header("Location: /rental_system/public/index.php?url=PropertyController/listAll");
                exit;
            }

            $propertyModel = $this->model("Property");
            $result = $propertyModel->addBooking($propertyId, $_SESSION['user_id'], $startDate, $endDate);

            if ($result) {
                $_SESSION['success'] = "Booking request sent!";
                header("Location: /rental_system/public/index.php?url=BookingController/myBookings");
                exit;
            } else {
                $_SESSION['error'] = "Failed to book the property.";
                header("Location: /rental_system/public/index.php?url=PropertyController/listAll");
                exit;
            }
        }
    

        // fallback → redirect to listAll
        header("Location: /rental_system/public/index.php?url=PropertyController/listAll");
        exit;
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
    // Add property to wishlist
    public function addToWishlist($propertyId) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'renter') {
            header("Location: /rental_system/public/index.php?url=UserController/login");
            exit;
        }

        $wishlistModel = $this->model("Wishlist");
        $wishlistModel->add($_SESSION['user_id'], $propertyId);

        header("Location: /rental_system/public/index.php?url=PropertyController/listAll");
        exit;
    }

    // Show my wishlist
    public function myWishlist() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'renter') {
            header("Location: /rental_system/public/index.php?url=UserController/login");
            exit;
        }

        $wishlistModel = $this->model("Wishlist");
        $properties = $wishlistModel->getByRenter($_SESSION['user_id']);

        $this->view("properties/wishlist", ['properties' => $properties]);
    }



    // Remove property from wishlist
    public function removeFromWishlist($propertyId) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'renter') {
            header("Location: /rental_system/public/index.php?url=UserController/login");
            exit;
        }

        $wishlistModel = $this->model("Wishlist");
        $wishlistModel->remove($_SESSION['user_id'], $propertyId);

        header("Location: /rental_system/public/index.php?url=PropertyController/myWishlist");
        exit;
    }

}        
?>
