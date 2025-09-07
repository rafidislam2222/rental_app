<h2 class="text-center mb-4">My Wishlist</h2>

<?php if (!empty($data['properties'])): ?>
    <?php foreach ($data['properties'] as $property): ?>
        <div class="card mb-3 p-3 shadow-sm">
            <h4><?php echo htmlspecialchars($property['title']); ?></h4>
            <p><strong>Location:</strong> <?php echo htmlspecialchars($property['location']); ?></p>
            <p><strong>Price:</strong> $<?php echo number_format($property['price'], 2); ?></p>
            
            <?php if (!empty($property['thumbnail'])): ?>
                <img src="/rental_system/<?php echo htmlspecialchars($property['thumbnail']); ?>" 
                     class="img-fluid" style="max-height: 200px; object-fit: cover;">
            <?php endif; ?>

            <a href="/rental_system/public/index.php?url=WishlistController/remove/<?php echo $property['id']; ?>" 
               class="btn btn-danger mt-2">
               ❌ Remove
            </a>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p class="text-center">Your wishlist is empty.</p>
<?php endif; ?>
