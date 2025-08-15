<style>
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background: #f4f6f8;
        margin: 0;
        padding: 0;
    }
    .properties-card {
        background: #fff;
        max-width: 900px;
        margin: 48px auto 0 auto;
        padding: 36px 32px 28px 32px;
        border-radius: 14px;
        box-shadow: 0 6px 32px rgba(44, 62, 80, 0.09);
    }
    .properties-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }
    .properties-header h2 {
        margin: 0;
        font-weight: 700;
        color: #2d3a4b;
        letter-spacing: 1px;
    }
    .add-btn {
        background: linear-gradient(90deg, #4f8cff 0%, #38b6ff 100%);
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 10px 22px;
        font-size: 1rem;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s, transform 0.2s;
        box-shadow: 0 2px 8px rgba(79,140,255,0.08);
    }
    .add-btn:hover {
        background: linear-gradient(90deg, #357ae8 0%, #1fa2ff 100%);
        transform: translateY(-2px) scale(1.04);
    }
    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(44, 62, 80, 0.04);
    }
    th, td {
        padding: 14px 12px;
        text-align: left;
    }
    th {
        background: #f0f6ff;
        color: #2d3a4b;
        font-weight: 600;
        border-bottom: 2px solid #e3e8ee;
    }
    tr:nth-child(even) {
        background: #f9fafb;
    }
    tr:hover {
        background: #e8f0fe;
    }
    td {
        color: #444;
        font-size: 15px;
    }
    .action-links a {
        background: #4f8cff;
        color: #fff;
        border-radius: 5px;
        padding: 7px 16px;
        margin-right: 6px;
        text-decoration: none;
        font-size: 0.98rem;
        font-weight: 500;
        transition: background 0.18s, transform 0.18s;
        display: inline-block;
    }
    .action-links a:last-child {
        background: #ef4444;
        margin-right: 0;
    }
    .action-links a:hover {
        background: #357ae8;
        transform: translateY(-2px) scale(1.04);
    }
    .action-links a:last-child:hover {
        background: #b91c1c;
    }
</style>

<div class="properties-card">
    <div class="properties-header">
        <h2>My Properties</h2>
        <a class="add-btn" href="/rental_system/public/index.php?url=PropertyController/add">+ Add New Property</a>
    </div>
    <table>
        <tr>
            <th>Title</th>
            <th>Location</th>
            <th>Price</th>
            <th>Bedrooms</th>
            <th>Availability</th>
            <th>Action</th>
        </tr>
        <?php foreach ($data['properties'] as $property): ?>
        <tr>
            <td><?php echo htmlspecialchars($property['title']); ?></td>
            <td><?php echo htmlspecialchars($property['location']); ?></td>
            <td><?php echo $property['price']; ?></td>
            <td><?php echo $property['bedrooms']; ?></td>
            <td><?php echo $property['availability']; ?></td>
            <td class="action-links">
                <a href="/rental_system/public/index.php?url=PropertyController/edit/<?php echo $property['id']; ?>">Edit</a>
                <a href="/rental_system/public/index.php?url=PropertyController/delete/<?php echo $property['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
