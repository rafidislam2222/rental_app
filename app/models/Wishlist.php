<?php
require_once "../core/Model.php";

class Wishlist extends Model {

    public function addToWishlist($renterId, $propertyId) {
        $stmt = $this->conn->prepare("
            INSERT IGNORE INTO wishlists (renter_id, property_id) VALUES (?, ?)
        ");
        return $stmt->execute([$renterId, $propertyId]);
    }

    public function getWishlistByRenter($renterId) {
        $stmt = $this->conn->prepare("
            SELECT p.id, p.title, p.location, p.price,
                   COALESCE((
                        SELECT pi.image_path 
                        FROM property_images pi 
                        WHERE pi.property_id = p.id 
                        ORDER BY pi.id ASC LIMIT 1
                   ), '/rental_system/public/images/no-image.jpg') AS thumbnail
            FROM wishlists w
            JOIN properties p ON w.property_id = p.id
            WHERE w.renter_id = ?
        ");
        $stmt->execute([$renterId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function removeFromWishlist($renterId, $propertyId) {
        $stmt = $this->conn->prepare("
            DELETE FROM wishlists WHERE renter_id = ? AND property_id = ?
        ");
        return $stmt->execute([$renterId, $propertyId]);
    }
}
