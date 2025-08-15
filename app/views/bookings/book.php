<h2>Book Property</h2>
<?php if (!empty($data['error'])): ?>
    <p style="color:red;"><?php echo $data['error']; ?></p>
<?php endif; ?>

<form method="POST">
    <label>Start Date:</label><br>
    <input type="date" name="start_date" required><br>

    <label>End Date:</label><br>
    <input type="date" name="end_date" required><br><br>

    <button type="submit">Confirm Booking</button>
</form>
