<?php
require_once "../core/Model.php";

class Booking extends Model {

    public function createBooking($propertyId, $renterId, $start_date, $end_date) {
        // Check if property already booked for that period
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
        $stmt = $this->conn->prepare("INSERT INTO bookings (property_id, renter_id, start_date, end_date, status) VALUES (?, ?, ?, ?, 'pending')");
        return $stmt->execute([$propertyId, $renterId, $start_date, $end_date]);
    }

    public function getBookingsByRenter($renterId) {
        $stmt = $this->conn->prepare("
            SELECT b.*, p.title, p.location 
            FROM bookings b
            JOIN properties p ON b.property_id = p.id
            WHERE renter_id = ?
        ");
        $stmt->execute([$renterId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
