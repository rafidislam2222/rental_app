<h2>My Bookings</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>Property</th>
        <th>Location</th>
        <th>Start</th>
        <th>End</th>
        <th>Status</th>
    </tr>
    <?php foreach ($data['bookings'] as $booking): ?>
    <tr>
        <td><?php echo htmlspecialchars($booking['title']); ?></td>
        <td><?php echo htmlspecialchars($booking['location']); ?></td>
        <td><?php echo $booking['start_date']; ?></td>
        <td><?php echo $booking['end_date']; ?></td>
        <td><?php echo $booking['status']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
