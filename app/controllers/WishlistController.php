<<<<<<< HEAD
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../../core/Controller.php";

class WishlistController extends Controller
{
    // Show wishlist
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /rental_system/public/index.php?url=UserController/login");
            exit;
        }

        $wishlistModel = $this->model('Wishlist');
        // ✅ call correct method from Wishlist.php
        $properties = $wishlistModel->getWishlistByRenter($_SESSION['user_id']);

        $this->view('properties/wishlist', ['properties' => $properties]);
    }

    // Add a property to wishlist
    public function add($propertyId = null)
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /rental_system/public/index.php?url=UserController/login");
            exit;
        }

        if (!$propertyId) {
            header("Location: /rental_system/public/index.php?url=PropertyController/listAll");
            exit;
        }

        $wishlistModel = $this->model('Wishlist');
        $wishlistModel->addToWishlist($_SESSION['user_id'], $propertyId);

        header("Location: /rental_system/public/index.php?url=WishlistController/index");
        exit;
    }

    // Remove a property from wishlist
    public function remove($propertyId = null)
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /rental_system/public/index.php?url=UserController/login");
            exit;
        }

        if (!$propertyId) {
            header("Location: /rental_system/public/index.php?url=WishlistController/index");
            exit;
        }

        $wishlistModel = $this->model('Wishlist');
        $wishlistModel->removeFromWishlist($_SESSION['user_id'], $propertyId);

        header("Location: /rental_system/public/index.php?url=WishlistController/index");
        exit;
    }
}
=======
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../../core/Controller.php";

class WishlistController extends Controller
{
    // Show wishlist
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /rental_system/public/index.php?url=UserController/login");
            exit;
        }

        $wishlistModel = $this->model('Wishlist');
        // ✅ call correct method from Wishlist.php
        $properties = $wishlistModel->getWishlistByRenter($_SESSION['user_id']);

        $this->view('properties/wishlist', ['properties' => $properties]);
    }

    // Add a property to wishlist
    public function add($propertyId = null)
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /rental_system/public/index.php?url=UserController/login");
            exit;
        }

        if (!$propertyId) {
            header("Location: /rental_system/public/index.php?url=PropertyController/listAll");
            exit;
        }

        $wishlistModel = $this->model('Wishlist');
        $wishlistModel->addToWishlist($_SESSION['user_id'], $propertyId);

        header("Location: /rental_system/public/index.php?url=WishlistController/index");
        exit;
    }

    // Remove a property from wishlist
    public function remove($propertyId = null)
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /rental_system/public/index.php?url=UserController/login");
            exit;
        }

        if (!$propertyId) {
            header("Location: /rental_system/public/index.php?url=WishlistController/index");
            exit;
        }

        $wishlistModel = $this->model('Wishlist');
        $wishlistModel->removeFromWishlist($_SESSION['user_id'], $propertyId);

        header("Location: /rental_system/public/index.php?url=WishlistController/index");
        exit;
    }
}
>>>>>>> 8b217becc59d3f20ff10da4eacf0d566e47aa5db
