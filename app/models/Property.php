<?php
require_once "../core/Model.php";

class Property extends Model {

    // ================= OWNER FUNCTIONS ================= //

    // Add new property
    public function addProperty($ownerId, $title, $location, $price, $bedrooms, $amenities, $description) {
        $stmt = $this->conn->prepare("
            INSERT INTO properties 
            (owner_id, title, location, price, bedrooms, amenities, description, availability) 
            VALUES (?, ?, ?, ?, ?, ?, ?, 'available')
        ");
        $stmt->execute([$ownerId, $title, $location, $price, $bedrooms, $amenities, $description]);
        return $this->conn->lastInsertId();
    }

    // Add property image
    public function addImage($propertyId, $imagePath) {
        $stmt = $this->conn->prepare("
            INSERT INTO property_images (property_id, image_path) VALUES (?, ?)
        ");
        return $stmt->execute([$propertyId, $imagePath]);
    }

    // Get properties by owner
    public function getPropertiesByOwner($ownerId) {
        $stmt = $this->conn->prepare("SELECT * FROM properties WHERE owner_id = ?");
        $stmt->execute([$ownerId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get single property by ID
    public function getPropertyById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM properties WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all images for a property
    public function getImagesByProperty($id) {
        $stmt = $this->conn->prepare("SELECT * FROM property_images WHERE property_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update property
    public function updateProperty($id, $title, $location, $price, $bedrooms, $amenities, $description) {
        $stmt = $this->conn->prepare("
            UPDATE properties 
            SET title = ?, location = ?, price = ?, bedrooms = ?, amenities = ?, description = ? 
            WHERE id = ?
        ");
        return $stmt->execute([$title, $location, $price, $bedrooms, $amenities, $description, $id]);
    }

    // Delete property (images + property record)
    public function deleteProperty($propertyId) {
        $stmt = $this->conn->prepare("DELETE FROM property_images WHERE property_id = ?");
        $stmt->execute([$propertyId]);

        $stmt = $this->conn->prepare("DELETE FROM properties WHERE id = ?");
        return $stmt->execute([$propertyId]);
    }

    // ================= RENTER FUNCTIONS ================= //

    /**
     * Get all available properties or filter based on search criteria.
     * Filters: location, min_price, max_price, bedrooms
     */
    public function getAvailableProperties($filters = []) {
        $sql = "
            SELECT p.*, 
            (SELECT image_path FROM property_images WHERE property_id = p.id LIMIT 1) AS thumbnail
            FROM properties p
            WHERE TRIM(availability) = 'available'
        ";

        $params = [];

        // Filter by location
        if (!empty($filters['location'])) {
            $sql .= " AND p.location LIKE ?";
            $params[] = "%" . trim($filters['location']) . "%";
        }

        // Filter by minimum price
        if (!empty($filters['min_price'])) {
            $sql .= " AND p.price >= ?";
            $params[] = $filters['min_price'];
        }

        // Filter by maximum price
        if (!empty($filters['max_price'])) {
            $sql .= " AND p.price <= ?";
            $params[] = $filters['max_price'];
        }

        // Filter by bedrooms
        if (!empty($filters['bedrooms'])) {
            $sql .= " AND p.bedrooms = ?";
            $params[] = $filters['bedrooms'];
        }

        // Sort newest first
        $sql .= " ORDER BY p.id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // ================= BOOKING FUNCTIONS ================= //

        // Create booking
        public function addBooking($propertyId, $renterId, $startDate, $endDate) {
        try {
            $this->conn->beginTransaction();

            // Insert booking
            $stmt = $this->conn->prepare("
                INSERT INTO bookings (property_id, renter_id, start_date, end_date, status, created_at)
                VALUES (?, ?, ?, ?, 'pending', NOW())
            ");
            $stmt->execute([$propertyId, $renterId, $startDate, $endDate]);

            // Update property status to booked
            $updateStmt = $this->conn->prepare("
                UPDATE properties SET availability = 'booked' WHERE id = ?
            ");
            $updateStmt->execute([$propertyId]);

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }


    // Get bookings by renter
    public function getBookingsByRenter($renterId) {
        $stmt = $this->conn->prepare("
            SELECT b.*, p.title, p.location, p.price, p.bedrooms,
                (SELECT image_path FROM property_images WHERE property_id = p.id LIMIT 1) AS thumbnail
            FROM bookings b
            JOIN properties p ON b.property_id = p.id
            WHERE b.renter_id = ?
            ORDER BY b.created_at DESC
        ");
        $stmt->execute([$renterId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>
