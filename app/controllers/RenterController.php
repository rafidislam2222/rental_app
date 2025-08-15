<?php
require_once "../core/Controller.php";

class RenterController extends Controller {
    public function dashboard() {
        $this->view("renters/dashboard");
    }
}
?>
