<<<<<<< HEAD
<?php
require_once "../core/Controller.php";

class ChatController extends Controller {

    public function __construct() {
        // Make sure session is started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        // Always pass question and answer to the view
        $this->view("chat/index", [
            'question' => isset($_SESSION['last_question']) ? $_SESSION['last_question'] : '',
            'answer'   => isset($_SESSION['last_answer']) ? $_SESSION['last_answer'] : ''
        ]);
    }

    public function ask() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $question = trim($_POST['question']);
            $answer = "Sorry, I didn’t quite get that. Try asking about booking, wishlist, or canceling.";

            if (stripos($question, 'book') !== false) {
                $answer = "To book a property:\n1. Go to 'Browse Properties'.\n2. Choose a property.\n3. Enter start & end dates.\n4. Click 'Book Now'.";
            } elseif (stripos($question, 'wishlist') !== false) {
                $answer = "To add to wishlist: Open a property and click ♥ 'Add to Wishlist'.";
            } elseif (stripos($question, 'cancel') !== false) {
                $answer = "To cancel: Go to 'My Bookings' and click 'Cancel'.";
            }

            // Save to session
            $_SESSION['last_question'] = $question;
            $_SESSION['last_answer']   = $answer;

            // Redirect back to index
            header("Location: /rental_system/public/index.php?url=ChatController/index");
            exit;
        }
    }
}
=======
<?php
require_once "../core/Controller.php";

class ChatController extends Controller {

    public function __construct() {
        // Make sure session is started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        // Always pass question and answer to the view
        $this->view("chat/index", [
            'question' => isset($_SESSION['last_question']) ? $_SESSION['last_question'] : '',
            'answer'   => isset($_SESSION['last_answer']) ? $_SESSION['last_answer'] : ''
        ]);
    }

    public function ask() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $question = trim($_POST['question']);
            $answer = "Sorry, I didn’t quite get that. Try asking about booking, wishlist, or canceling.";

            if (stripos($question, 'book') !== false) {
                $answer = "To book a property:\n1. Go to 'Browse Properties'.\n2. Choose a property.\n3. Enter start & end dates.\n4. Click 'Book Now'.";
            } elseif (stripos($question, 'wishlist') !== false) {
                $answer = "To add to wishlist: Open a property and click ♥ 'Add to Wishlist'.";
            } elseif (stripos($question, 'cancel') !== false) {
                $answer = "To cancel: Go to 'My Bookings' and click 'Cancel'.";
            }

            // Save to session
            $_SESSION['last_question'] = $question;
            $_SESSION['last_answer']   = $answer;

            // Redirect back to index
            header("Location: /rental_system/public/index.php?url=ChatController/index");
            exit;
        }
    }
}
>>>>>>> 8b217becc59d3f20ff10da4eacf0d566e47aa5db
