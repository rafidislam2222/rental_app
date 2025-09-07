<<<<<<< HEAD
<?php
require_once "../core/Model.php";

class Review extends Model {

    // Add new review
    public function addReview($propertyId, $renterId, $rating, $feedback) {
        $stmt = $this->conn->prepare("
            INSERT INTO reviews (property_id, renter_id, rating, feedback) 
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([$propertyId, $renterId, $rating, $feedback]);
    }

    // Get reviews by property
    public function getReviewsByProperty($propertyId) {
        $stmt = $this->conn->prepare("
            SELECT r.*, u.name as renter_name
            FROM reviews r
            JOIN users u ON r.renter_id = u.id
            WHERE r.property_id = ?
            ORDER BY r.created_at DESC
        ");
        $stmt->execute([$propertyId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get average rating for a property
    public function getAverageRating($propertyId) {
        $stmt = $this->conn->prepare("
            SELECT AVG(rating) as avg_rating 
            FROM reviews 
            WHERE property_id = ?
        ");
        $stmt->execute([$propertyId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
=======
<?php
require_once "../core/Model.php";

class Review extends Model {

    // Add new review
    public function addReview($propertyId, $renterId, $rating, $feedback) {
        $stmt = $this->conn->prepare("
            INSERT INTO reviews (property_id, renter_id, rating, feedback) 
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([$propertyId, $renterId, $rating, $feedback]);
    }

    // Get reviews by property
    public function getReviewsByProperty($propertyId) {
        $stmt = $this->conn->prepare("
            SELECT r.*, u.name as renter_name
            FROM reviews r
            JOIN users u ON r.renter_id = u.id
            WHERE r.property_id = ?
            ORDER BY r.created_at DESC
        ");
        $stmt->execute([$propertyId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get average rating for a property
    public function getAverageRating($propertyId) {
        $stmt = $this->conn->prepare("
            SELECT AVG(rating) as avg_rating 
            FROM reviews 
            WHERE property_id = ?
        ");
        $stmt->execute([$propertyId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
>>>>>>> 8b217becc59d3f20ff10da4eacf0d566e47aa5db
