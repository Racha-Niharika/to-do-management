<?php
include 'connect.php'; // Assuming this file contains your database connection

$query = "SELECT * FROM tform";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}
?>
<!-- Displaying records in a table -->
        <h2>Task Records</h2>
        <table>
            <thead>
                <tr>
                  
                    <th>Name</th>
                    <th>Email</th>
                    <th>Recipient Email</th>
                    <th>Task Type</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                 
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td>{$row['recipient_email']}</td>";
                    echo "<td>{$row['task_type']}</td>";
                    echo "<td>{$row['message']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>