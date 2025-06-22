<?php
// Include database connection
include 'classes/db1.php';

// Fetch the latest event along with its details from the event_info table
$query = "
    SELECT e.event_id, e.event_title, e.event_price, ei.Date, ei.time, ei.location
    FROM events e
    LEFT JOIN event_info ei ON e.event_id = ei.event_id
    ORDER BY e.event_id DESC LIMIT 1
";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Latest Event</title>
    <?php require 'utils/styles.php'; ?>
</head>
<body>
<?php require 'utils/header.php'; ?>

<div class="container">
    <h2>Latest Event</h2>
    <ul class="list-group">
        <?php
        if (mysqli_num_rows($result) > 0) {
            // Fetch the latest event details
            $row = mysqli_fetch_assoc($result);
            echo "<li class='list-group-item'>";
            echo "<strong>Event Name:</strong> {$row['event_title']} <br>";
            echo "<strong>Event Price:</strong> {$row['event_price']} <br>";
            echo "<strong>Event Date:</strong> {$row['Date']} <br>";
            echo "<strong>Event Location:</strong> {$row['location']} <br>";
            echo "<strong>Event Time:</strong> {$row['time']} <br>";
            echo "</li>";
        } else {
            echo "<li class='list-group-item'>No events found.</li>";
        }
        ?>
    </ul>
</div>

<?php require 'utils/footer.php'; ?>
</body>
</html>