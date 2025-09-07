<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<style>
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background: #f4f6f8;
        margin: 0;
        padding: 0;
    }
    .properties-list-container { max-width: 1200px; margin: 40px auto 0 auto; padding: 0 16px; }
    .properties-list-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; }
    .properties-list-header h2 { margin: 0; font-weight: 700; color: #2d3a4b; letter-spacing: 1px; }
    .search-form { background: #fff; border-radius: 10px; box-shadow: 0 2px 12px rgba(44,62,80,0.07); padding: 18px 24px 10px 24px; margin-bottom: 28px; display: flex; flex-wrap: wrap; gap: 18px 24px; align-items: flex-end; }
    .search-form label { font-size: 15px; color: #34495e; font-weight: 500; margin-bottom: 4px; display: block; }
    .search-form input[type="text"], .search-form input[type="number"], .search-form input[type="date"] { padding: 8px 10px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 15px; background: #f9fafb; width: 160px; transition: border 0.2s; }
    .search-form input:focus { border-color: #4f8cff; outline: none; background: #fff; }
    .search-form button, .search-form a { padding: 9px 22px; border-radius: 6px; border: none; font-size: 15px; font-weight: 600; cursor: pointer; background: linear-gradient(90deg, #4f8cff 0%, #38b6ff 100%); color: #fff; text-decoration: none; margin-right: 6px; transition: background 0.2s, transform 0.2s; box-shadow: 0 2px 8px rgba(79,140,255,0.08); display: inline-block; }
    .search-form button:hover, .search-form a:hover { background: linear-gradient(90deg, #357ae8 0%, #1fa2ff 100%); transform: translateY(-2px) scale(1.04); }
    .properties-grid { display: flex; flex-wrap: wrap; gap: 24px; justify-content: flex-start; }
    .property-card { background: #fff; border: 1.5px solid #e5e7eb; border-radius: 12px; box-shadow: 0 2px 10px rgba(44,62,80,0.07); width: 290px; display: flex; flex-direction: column; overflow: hidden; margin: 0; padding: 0 0 14px 0; min-height: 370px; }
    .property-card img { width: 100%; height: 170px; object-fit: contain; background: #f3f4f6; border-bottom: 1.5px solid #e5e7eb; display: block; margin: 0; border-radius: 0; }
    .property-card-content { padding: 14px 14px 0 14px; flex: 1; display: flex; flex-direction: column; }
    .property-card h3 { margin: 0 0 6px 0; color: #0284ff; font-size: 1.08rem; font-weight: 700; }
    .property-card p { margin: 0 0 5px 0; color: #444; font-size: 14px; }
    .property-card .property-desc { color: #6b7280; font-size: 13px; margin-bottom: 8px; }
    .property-card form { margin-top: auto; background: #f9fafb; border-radius: 7px; padding: 8px 8px 6px 8px; box-shadow: 0 1px 3px rgba(44,62,80,0.03); }
    .property-card form label { font-size: 12px; color: #34495e; font-weight: 500; margin-bottom: 2px; display: block; }
    .property-card form input[type="date"] { width: 100%; margin-bottom: 6px; padding: 6px 7px; font-size: 13px; }
    .property-card form button { width: 100%; padding: 8px 0; background: linear-gradient(90deg, #4f8cff 0%, #38b6ff 100%); color: #fff; border: none; border-radius: 5px; font-size: 14px; font-weight: 600; cursor: pointer; transition: background 0.2s; margin-top: 3px; }
    .property-card form button:hover { background: linear-gradient(90deg, #357ae8 0%, #1fa2ff 100%); }
    .property-card .login-hint { color: #ef4444; font-size: 13px; margin-top: 8px; text-align: center; }

    /* Wishlist button */
    .wishlist-btn {
        margin-top: 8px;
        display: block;
        width: 100%;
        padding: 7px 0;
        border-radius: 5px;
        border: 1px solid #e5e7eb;
        background: #fff;
        color: #ef4444;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s, transform 0.2s;
        text-align: center;
        text-decoration: none;
    }
    .wishlist-btn:hover {
        background: #ffe5e5;
        transform: translateY(-1px);
    }

    /* Booked state */
    .booked-label {
        margin-top: auto;
        background: #ffecec;
        color: #d32f2f;
        padding: 8px;
        border-radius: 6px;
        text-align: center;
        font-weight: 600;
        font-size: 14px;
    }
    .reviews-box {
        margin-top: 10px;
        font-size: 13px;
        color: #555;
        padding: 6px;
        background: #f9fafb;
        border: 1px solid #eee;
        border-radius: 6px;
    }
    .review-item {
        margin-bottom: 6px;
        border-bottom: 1px dashed #ddd;
        padding-bottom: 4px;
    }
    .review-item strong { color: #333; }
</style>

<div class="properties-list-container">
    <?php if (!empty($_SESSION['error'])): ?>
        <div style="background:#ffe5e5; color:#b91c1c; border:1px solid #fca5a5; padding:10px; border-radius:7px; margin-bottom:18px; font-weight:600;">
            <?= htmlspecialchars($_SESSION['error']) ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <div class="properties-list-header">
        <h2>Properties</h2>
    </div>

    <!-- Search Form -->
    <form class="search-form" method="GET" action="/rental_system/public/index.php">
        <input type="hidden" name="url" value="PropertyController/listAll">
        <div>
            <label>Location:</label>
            <input type="text" name="location" value="<?= htmlspecialchars($_GET['location'] ?? '') ?>">
        </div>
        <div>
            <label>Min Price:</label>
            <input type="number" name="min_price" value="<?= htmlspecialchars($_GET['min_price'] ?? '') ?>">
        </div>
        <div>
            <label>Max Price:</label>
            <input type="number" name="max_price" value="<?= htmlspecialchars($_GET['max_price'] ?? '') ?>">
        </div>
        <div>
            <label>Bedrooms:</label>
            <input type="number" name="bedrooms" value="<?= htmlspecialchars($_GET['bedrooms'] ?? '') ?>">
        </div>
        <div>
            <button type="submit">Search</button>
            <a href="/rental_system/public/index.php?url=PropertyController/listAll">Reset</a>
        </div>
    </form>

    <hr>

    <?php if (!empty($data['properties'])): ?>
        <div class="properties-grid">
            <?php foreach ($data['properties'] as $property): ?>
                <div class="property-card">
                    <?php if (!empty($property['images'])): ?>
                        <?php foreach ($property['images'] as $img): ?>
                            <img src="/rental_system/<?= htmlspecialchars($img['image_path']) ?>" 
                                 alt="<?= htmlspecialchars($property['title']) ?>">
                        <?php endforeach; ?>
                    <?php else: ?>
                        <img src="/rental_system/public/images/no-image.jpg" alt="No Image">
                    <?php endif; ?>
                    
                    <div class="property-card-content">
                        <h3>
                            <?= htmlspecialchars($property['title']) ?>
                            <?php
                                // Calculate average rating
                                $avg = 0;
                                if (!empty($property['reviews'])) {
                                    $sum = 0;
                                    $count = 0;
                                    foreach ($property['reviews'] as $review) {
                                        $sum += (int)$review['rating'];
                                        $count++;
                                    }
                                    $avg = $count ? round($sum / $count, 1) : 0;
                                }
                                $fullStars = floor($avg);
                                $halfStar = ($avg - $fullStars) >= 0.5 ? 1 : 0;
                                $emptyStars = 5 - $fullStars - $halfStar;
                                echo '<span style="margin-left:8px; vertical-align:middle; color:#fbbf24; font-size:1.05em;">';
                                for ($i = 0; $i < $fullStars; $i++) echo '★';
                                if ($halfStar) echo '☆';
                                for ($i = 0; $i < $emptyStars; $i++) echo '☆';
                                if ($avg > 0) echo ' <span style="color:#888; font-size:0.98em;">(' . $avg . ')</span>';
                                echo '</span>';
                            ?>
                        </h3>
                        <p><strong>Location:</strong> <?= htmlspecialchars($property['location']) ?></p>
                        <p><strong>Price:</strong> $<?= htmlspecialchars($property['price']) ?></p>
                        <p><strong>Bedrooms:</strong> <?= htmlspecialchars($property['bedrooms']) ?></p>
                        <div class="property-desc"><?= nl2br(htmlspecialchars($property['description'])) ?></div>

                        <?php if (!empty($property['is_booked']) && $property['is_booked'] == 1): ?>
                            <div class="booked-label">Already Booked</div>
                        <?php else: ?>
                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'renter'): ?>
                                <form method="POST" action="/rental_system/public/index.php?url=PropertyController/book">

                                    <input type="hidden" name="property_id" value="<?= $property['id'] ?>">
                                    <label>Start Date:</label>
                                    <input type="date" name="start_date" required>
                                    <label>End Date:</label>
                                    <input type="date" name="end_date" required>
                                    <button type="submit">Book Now</button>
                                </form>

                                <a href="/rental_system/public/index.php?url=WishlistController/add/<?= $property['id'] ?>" 
                                   class="wishlist-btn">♥ Add to Wishlist</a>
                            <?php else: ?>
                                <div class="login-hint"><em>Login as a renter to book this property.</em></div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <div class="reviews-box">
                            <strong>⭐ Reviews & Ratings:</strong><br>
                            <?php if (!empty($property['reviews'])): ?>
                                <?php foreach ($property['reviews'] as $review): ?>
                                    <div class="review-item">
                                        <strong><?= htmlspecialchars($review['reviewer_name']) ?></strong> 
                                        (
                                        <?php
                                            $rating = (int)$review['rating'];
                                            $stars = str_repeat('★', $rating) . str_repeat('☆', 5 - $rating);
                                            echo $stars;
                                        ?>):
                                        <?= htmlspecialchars($review['comment']) ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <em>No reviews yet.</em>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No properties found.</p>
    <?php endif; ?>
</div>   do i need any changes in the list.php? 