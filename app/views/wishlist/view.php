<!-- Add Bootstrap CSS CDN for styling -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .wishlist-container {
        max-width: 700px;
        margin: 40px auto;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        padding: 32px 40px;
    }
    .wishlist-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 28px;
        letter-spacing: 1px;
        text-align: center;
    }
    .wishlist-list {
        list-style: none;
        padding: 0;
    }
    .wishlist-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #f8f9fa;
        border-radius: 8px;
        margin-bottom: 18px;
        padding: 18px 22px;
        transition: box-shadow 0.2s;
        box-shadow: 0 2px 8px rgba(44,62,80,0.03);
    }
    .wishlist-item strong {
        color: #007bff;
        font-size: 1.15rem;
    }
    .wishlist-details {
        flex: 1;
        margin-left: 18px;
        color: #555;
    }
    .wishlist-remove {
        color: #dc3545;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.2s;
    }
    .wishlist-remove:hover {
        color: #a71d2a;
        text-decoration: underline;
    }
    .wishlist-empty {
        text-align: center;
        color: #888;
        font-size: 1.15rem;
        margin-top: 30px;
    }
</style>

<div class="wishlist-container">
    <div class="wishlist-title">
        <i class="bi bi-heart-fill" style="color:#e74c3c;"></i> My Wishlist
    </div>

    <?php if (!empty($data['wishlist'])): ?>
        <ul class="wishlist-list">
            <?php foreach ($data['wishlist'] as $property): ?>
                <li class="wishlist-item">
                    <div>
                        <strong><?= htmlspecialchars($property['title']) ?></strong>
                        <div class="wishlist-details">
                            $<?= htmlspecialchars($property['price']) ?> &middot; 
                            <?= htmlspecialchars($property['location']) ?>
                        </div>
                    </div>
                    <a class="wishlist-remove" href="/rental_system/public/index.php?url=WishlistController/remove/<?= $property['id'] ?>">
                        <i class="bi bi-trash"></i> Remove
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <div class="wishlist-empty">
            <i class="bi bi-emoji-frown" style="font-size:2rem;"></i><br>
            Your wishlist is empty.
        </div>
    <?php endif; ?>
</div>

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
