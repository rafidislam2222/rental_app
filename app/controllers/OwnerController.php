<?php
require_once "../core/Controller.php";

class OwnerController extends Controller {
    public function dashboard() {
        $this->view("owners/dashboard");
    }
}
?>
