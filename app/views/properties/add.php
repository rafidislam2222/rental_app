<?php if (!empty($data['error'])): ?>
    <p style="color:red;"><?php echo $data['error']; ?></p>
<?php endif; ?>

<style>
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background: #f4f6f8;
        margin: 0;
        padding: 0;
    }
    .property-card {
        background: #fff;
        max-width: 500px;
        margin: 48px auto 0 auto;
        padding: 36px 32px 28px 32px;
        border-radius: 14px;
        box-shadow: 0 6px 32px rgba(44, 62, 80, 0.09);
    }
    .property-card h2 {
        margin-top: 0;
        margin-bottom: 20px;
        font-weight: 700;
        color: #2d3a4b;
        text-align: center;
        letter-spacing: 1px;
    }
    .property-card label {
        display: block;
        margin-bottom: 6px;
        color: #34495e;
        font-size: 15px;
        font-weight: 500;
    }
    .property-card input[type="text"],
    .property-card input[type="number"],
    .property-card textarea {
        width: 100%;
        padding: 10px 12px;
        margin-bottom: 18px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 15px;
        background: #f9fafb;
        transition: border 0.2s;
        resize: vertical;
    }
    .property-card input[type="file"] {
        margin-bottom: 18px;
    }
    .property-card input:focus,
    .property-card textarea:focus {
        border-color: #4f8cff;
        outline: none;
        background: #fff;
    }
    .property-card button {
        width: 100%;
        padding: 13px;
        background: linear-gradient(90deg, #4f8cff 0%, #38b6ff 100%);
        color: #fff;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
        box-shadow: 0 2px 8px rgba(79,140,255,0.08);
        margin-top: 8px;
    }
    .property-card button:hover {
        background: linear-gradient(90deg, #357ae8 0%, #1fa2ff 100%);
    }
    .property-card .error-message {
        color: #e74c3c;
        background: #fdecea;
        border: 1px solid #f5c6cb;
        padding: 10px 14px;
        border-radius: 5px;
        margin-bottom: 18px;
        font-size: 14px;
        text-align: center;
    }
</style>

<div class="property-card">
    <?php if (!empty($data['error'])): ?>
        <div class="error-message"><?php echo $data['error']; ?></div>
    <?php endif; ?>

    <h2>Add New Property</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Title:</label>
        <input type="text" name="title" required>

        <label>Location:</label>
        <input type="text" name="location" required>

        <label>Price:</label>
        <input type="number" step="0.01" name="price" required>

        <label>Bedrooms:</label>
        <input type="number" name="bedrooms" required>

        <label>Amenities:</label>
        <textarea name="amenities"></textarea>

        <label>Description:</label>
        <textarea name="description"></textarea>

        <label>Images:</label>
        <input type="file" name="images[]" multiple>

        <button type="submit">Add Property</button>
    </form>
</div>
