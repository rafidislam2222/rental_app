<style>
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background: #f4f6f8;
        margin: 0;
        padding: 0;
    }
    .bookings-container {
        max-width: 700px;
        margin: 48px auto 0 auto;
        padding: 0 16px;
    }
    .bookings-header {
        margin-bottom: 28px;
        text-align: center;
    }
    .bookings-header h2 {
        margin: 0;
        font-weight: 700;
        color: #2d3a4b;
        letter-spacing: 1px;
    }
    .booking-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 18px rgba(44, 62, 80, 0.09);
        border: 1.5px solid #e5e7eb;
        padding: 22px 24px 18px 24px;
        margin-bottom: 22px;
        display: flex;
        align-items: flex-start;
        gap: 18px;
    }
    .booking-card img {
        width: 210px;
        height: 160px;
        object-fit: contain;
        border-radius: 8px;
        background: #f3f4f6;
        border: 1px solid #e5e7eb;
        margin-right: 18px;
        flex-shrink: 0;
        display: block;
    }
    .booking-details {
        flex: 1;
    }
    .booking-details h3 {
        margin: 0 0 7px 0;
        color: #0284ff;
        font-size: 1.15rem;
        font-weight: 700;
    }
    .booking-details p {
        margin: 0 0 6px 0;
        color: #444;
        font-size: 14px;
    }
    .booking-details .status {
        font-weight: 600;
        color: #16a34a;
    }
    .booking-details .status[data-status="pending"] {
        color: #f59e42;
    }
    .booking-details .status[data-status="cancelled"] {
        color: #ef4444;
    }
    .no-bookings {
        text-align: center;
        color: #888;
        font-size: 1.08rem;
        margin-top: 40px;
    }
</style>

<div class="bookings-container">
    <div class="bookings-header">
        <h2>My Bookings</h2>
    </div>

    <?php if (!empty($data['bookings'])): ?>
        <?php foreach ($data['bookings'] as $booking): ?>
            <div class="booking-card">
                <?php if (!empty($booking['thumbnail'])): ?>
                    <img src="/rental_system/<?= htmlspecialchars($booking['thumbnail']) ?>" alt="Property Image">
                <?php endif; ?>
                <div class="booking-details">
                    <h3><?= htmlspecialchars($booking['title']) ?></h3>
                    <p><strong>Location:</strong> <?= htmlspecialchars($booking['location']) ?></p>
                    <p><strong>Price:</strong> $<?= htmlspecialchars($booking['price']) ?></p>
                    <p><strong>Bedrooms:</strong> <?= htmlspecialchars($booking['bedrooms']) ?></p>
                    <p>
                        <strong>Status:</strong>
                        <span class="status" data-status="<?= strtolower(htmlspecialchars($booking['status'])) ?>">
                            <?= htmlspecialchars($booking['status']) ?>
                        </span>
                    </p>
                    <p><strong>From:</strong> <?= htmlspecialchars($booking['start_date']) ?> 
                       to <?= htmlspecialchars($booking['end_date']) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-bookings">No bookings yet.</div>
    <?php endif; ?>
</div>
