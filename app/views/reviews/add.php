<style>
    body {
        background: #f4f6f8;
        font-family: 'Segoe UI', Arial, sans-serif;
    }
    .review-card {
        background: #fff;
        max-width: 480px;
        margin: 48px auto 0 auto;
        border-radius: 18px;
        box-shadow: 0 6px 32px rgba(44, 62, 80, 0.09);
        padding: 36px 32px 28px 32px;
    }
    .review-card h2 {
        text-align: center;
        font-weight: 700;
        color: #0284ff;
        margin-bottom: 28px;
        letter-spacing: 1px;
    }
    .form-label {
        font-weight: 600;
        color: #2d3a4b;
        margin-bottom: 6px;
    }
    .form-select, .form-control, textarea {
        border-radius: 8px !important;
        border: 1.5px solid #d1d5db;
        font-size: 1rem;
        padding: 10px 12px;
        background: #f9fafb;
        transition: border 0.2s;
        margin-bottom: 18px;
    }
    .form-select:focus, .form-control:focus, textarea:focus {
        border-color: #4f8cff;
        background: #fff;
        outline: none;
    }
    .btn-primary {
        background: linear-gradient(90deg, #4f8cff 0%, #38b6ff 100%);
        border: none;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1.08rem;
        padding: 12px 0;
        width: 100%;
        box-shadow: 0 2px 8px rgba(79,140,255,0.08);
        transition: background 0.18s, transform 0.18s;
    }
    .btn-primary:hover {
        background: linear-gradient(90deg, #357ae8 0%, #1fa2ff 100%);
        transform: translateY(-2px) scale(1.03);
    }
</style>

<div class="review-card">
    <h2>Leave a Review</h2>
    <form method="POST" action="/rental_system/public/index.php?url=ReviewController/save">
        <input type="hidden" name="property_id" value="<?php echo htmlspecialchars($data['property_id']); ?>">

        <div class="mb-3">
            <label for="rating" class="form-label">Rating (1–5)</label>
            <select name="rating" id="rating" class="form-select" required>
                <option value="">Select rating</option>
                <option value="1">1 - Poor</option>
                <option value="2">2 - Fair</option>
                <option value="3">3 - Good</option>
                <option value="4">4 - Very good</option>
                <option value="5">5 - Excellent</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">Your Review</label>
            <textarea name="comment" id="comment" class="form-control" rows="4"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Review</button>
    </form>
</div>
