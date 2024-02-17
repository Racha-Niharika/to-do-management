<?php
session_start();
include 'connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve task name and status from the form submission
    $taskName = isset($_POST["taskName"]) ? $_POST["taskName"] : '';
    $status = isset($_POST["status"]) ? $_POST["status"] : '';

    // Update the status in the database
    $updateQuery = "UPDATE tform SET status = '$status' WHERE name = '$taskName'";
    $updateResult = mysqli_query($con, $updateQuery);

    if (!$updateResult) {
        die("Update query failed: " . mysqli_error($con));
    }

    // Redirect to member.php after updating
    header("Location: member.php");
    exit();
}

// Fetch task names from the database
$query = "SELECT DISTINCT name FROM tform";
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
    <title>Status Form</title>
    <link rel="stylesheet" href="status.css">
</head>
  
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: center;
            padding: 10px;
        }

        th {
            background-color: #3B9EBF;
        }

        tr:nth-child(even) {
            background-color: #90EE90;
        }
        tr:nth-child(odd) {
            background-color: #cbcccb;
        }

        .search-container {
            margin: 40px 0;
        }

        input[type=text] {
    width: 200px; /* Adjust the width as needed */
    padding: 10px; /* Adjust the padding as needed */
    margin: 8px 0;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #cbcccb;
    font-size: 16px;
}


        input[type=text]:focus {
            outline: none;
            border-color: #0066cc;
        }
        .center {
  margin-left: auto;
  margin-right: auto;
}

.highlight {
            background-color: yellow; /* You can change this color */
        }
</style>
<body>
    <div class="wrapper">
        <h2>Status Form</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h3>Task Name</h3>
            <div id="input1">
                <!-- Dropdown to select task name -->
                <select id="taskName" name="taskName" required>
                    <?php
                    // Populate dropdown list with tasks
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . htmlspecialchars($row['name']) . "'>" . htmlspecialchars($row['name']) . "</option>";
                    }
                    ?>
                </select>
            </div>

            <h3>Task Status</h3>
            <label for="status">Select status:</label>
            <select id="status" name="status">
                <option value="completed">Completed</option>
                <option value="in-progress">In-Progress</option>
            </select>

            <div id="button">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
