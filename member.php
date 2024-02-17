<?php
session_start();

include 'connect.php';

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

$query = "SELECT tname, name, status FROM tform WHERE recipient_email = '$username'";
if (!empty($searchTerm)) {
    $searchTerm = mysqli_real_escape_string($con, $searchTerm);
    $query .= " AND name LIKE '%$searchTerm%'";
}

$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Page</title>
    <link rel="stylesheet" href="Home.css">
</head>
<body>
    <header>
        <img src="https://adoreearth.org/assets/images/ADORE.png" alt="" id="background">
        <nav>
            <form method="GET">
                <label for="s-bar">Search Task Name:</label>
                <input type="text" name="search" id="s-bar" placeholder="Enter task name" value="<?php echo htmlspecialchars($searchTerm); ?>">
                <button type="submit">Search</button>
            </form>
        </nav>
    </header>

    <h2 style="text-align: center;">Task Records</h2>
    <table>
        <thead>
            <tr>
                <th>Team Member Name</th>
                <th>Task Name</th>
                <th>Status</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['tname']) . "</td>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                echo '<td><a href="update.php">Update</a></td>';
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
