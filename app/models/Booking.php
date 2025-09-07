<?php
require_once "../core/Model.php";

class Booking extends Model {

    // ================= FEATURE 1-6 ================= //

    // Create booking
    public function createBooking($propertyId, $renterId, $start_date, $end_date) {
        // Check if property already booked for that period (not cancelled)
        $stmt = $this->conn->prepare("
            SELECT * FROM bookings 
            WHERE property_id = ? 
            AND status != 'cancelled'
            AND (start_date <= ? AND end_date >= ?)
        ");
        $stmt->execute([$propertyId, $end_date, $start_date]);
        if ($stmt->rowCount() > 0) {
            return false; // Date conflict
        }

        // Create booking
        $stmt = $this->conn->prepare("
            INSERT INTO bookings (property_id, renter_id, start_date, end_date, status) 
            VALUES (?, ?, ?, ?, 'pending')
        ");
        return $stmt->execute([$propertyId, $renterId, $start_date, $end_date]);
    }

    // Get bookings by renter (with property details + one image)
    public function getBookingsByRenter($renterId) {
        $stmt = $this->conn->prepare("
            SELECT b.*, p.title, p.location, p.price, p.bedrooms
            FROM bookings b
            JOIN properties p ON b.property_id = p.id
            WHERE renter_id = ? AND b.status != 'cancelled'
        ");
        $stmt->execute([$renterId]);
        $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Attach images for each booking
        foreach ($bookings as &$booking) {
            $stmtImg = $this->conn->prepare("SELECT image_path FROM property_images WHERE property_id = ?");
            $stmtImg->execute([$booking['property_id']]);
            $booking['images'] = $stmtImg->fetchAll(PDO::FETCH_ASSOC);
        }

        return $bookings;
    }


    // ================= FEATURE 7 (NEW) ================= //

    // Get booking by ID
    public function getBookingById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM bookings WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update booking status (e.g. cancel, approve, complete)
    public function updateStatus($id, $status) {
        $stmt = $this->conn->prepare("UPDATE bookings SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }
}
?>
