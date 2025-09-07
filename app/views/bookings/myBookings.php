<h2 class="text-center mb-4">My Bookings</h2>

<?php if (!empty($data['bookings'])): ?>
    <?php foreach ($data['bookings'] as $booking): ?>
        <div class="card mb-3 p-3 shadow-sm">

            <!-- Bootstrap Carousel for Property Images -->
            <?php if (!empty($booking['images'])): ?>
                <div id="carousel-<?php echo $booking['id']; ?>" class="carousel slide mb-3" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($booking['images'] as $index => $img): ?>
                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <img src="/rental_system/<?php echo htmlspecialchars($img['image_path']); ?>" 
                                     class="d-block w-100" 
                                     alt="Property Image" 
                                     style="max-height: 250px; object-fit: cover; border-radius: 8px;">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- Carousel Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?php echo $booking['id']; ?>" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-<?php echo $booking['id']; ?>" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            <?php else: ?>
                <!-- Fallback if no images exist -->
                <img src="/rental_system/public/images/no-image.png" 
                     alt="No Image Available" 
                     class="img-fluid mb-3" 
                     style="max-height: 200px; object-fit: cover; border-radius: 8px;">
            <?php endif; ?>

            <!-- Property Details -->
            <h4><?php echo htmlspecialchars($booking['title']); ?></h4>
            <p><strong>Location:</strong> <?php echo htmlspecialchars($booking['location']); ?></p>
            <p><strong>Price:</strong> $<?php echo number_format($booking['price'], 2); ?></p>
            <p><strong>Bedrooms:</strong> <?php echo htmlspecialchars($booking['bedrooms']); ?></p>
            
            <p><strong>Status:</strong> 
                <span style="color: 
                    <?php echo $booking['status'] === 'pending' ? 'orange' : 
                                ($booking['status'] === 'cancelled' ? 'red' : 'green'); ?>">
                    <?php echo ucfirst($booking['status']); ?>
                </span>
            </p>
            
            <p><strong>From:</strong> <?php echo $booking['start_date']; ?> 
               <strong>to</strong> <?php echo $booking['end_date']; ?></p>

            <!-- Action Buttons -->
            <?php 
                $status = strtolower(trim($booking['status']));
                // Cancel Booking
                if ($status === 'pending' || $status === 'confirmed'): 
            ?>
                <a href="/rental_system/public/index.php?url=BookingController/cancel/<?php echo $booking['id']; ?>" 
                   class="btn btn-danger"
                   onclick="return confirm('Are you sure you want to cancel this booking?');">
                   Cancel Booking
                </a>
            <?php endif; ?>

            <!-- Leave Review (pending, confirmed, completed) -->
            <?php if ($status === 'pending' || $status === 'confirmed' || $status === 'completed'): ?>
                <a href="/rental_system/public/index.php?url=ReviewController/add/<?php echo $booking['property_id']; ?>" 
                   class="btn btn-primary mt-2">
                   Leave Review
                </a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p class="text-center">No bookings found.</p>
<?php endif; ?>

<style>
    body {
        background: #f6f8fa;
    }
    .card {
        border-radius: 18px !important;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08), 0 1.5px 6px rgba(0,0,0,0.04) !important;
        background: #fff;
        transition: box-shadow 0.2s, transform 0.2s;
    }
    .card:hover {
        box-shadow: 0 8px 32px rgba(0,0,0,0.12), 0 3px 12px rgba(0,0,0,0.06) !important;
        transform: translateY(-2px) scale(1.01);
    }
    .carousel-inner img, .img-fluid {
        border-radius: 12px !important;
        background: #e9ecef;
    }
    h4 {
        font-weight: 600;
        color: #22223b;
    }
    .btn-danger, .btn-primary {
        border-radius: 20px;
        font-weight: 500;
        padding: 0.4em 1.5em;
        margin-top: 0.5em;
        transition: background 0.2s, color 0.2s;
    }
    .btn-danger:hover {
        background: #c1121f;
        color: #fff;
    }
    .btn-primary {
        background: #007bff;
        border: none;
    }
    .btn-primary:hover {
        background: #0056b3;
        color: #fff;
    }
    .card p strong {
        color: #3a5a40;
    }
    .card p span {
        font-size: 1em;
        padding: 0.4em 1.1em;
        border-radius: 12px;
        margin-left: 0.5em;
        font-weight: 500;
        letter-spacing: 0.5px;
        background: #f1f1f1;
    }
    .card p span[style*="orange"] {
        background: #fff3cd;
        color: #856404 !important;
    }
    .card p span[style*="red"] {
        background: #f8d7da;
        color: #721c24 !important;
    }
    .card p span[style*="green"] {
        background: #d4edda;
        color: #155724 !important;
    }
    @media (max-width: 767px) {
        .card {
            padding: 1rem 0.5rem !important;
        }
        .carousel-inner img, .img-fluid {
            max-height: 160px !important;
        }
    }
</style>
