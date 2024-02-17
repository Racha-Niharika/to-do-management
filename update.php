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
    <style>
    * {
    margin: 0;
    padding: 0;
    font-family: 'Roboto Slab', serif;
}


header{
    background: rgb(208, 225, 249);
    margin: 0px -3px;
    height: 50px;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px 40px;
    border: 0;
   
    
}


header li{
    list-style: none;
    padding: 0px 20px;
    display: inline-block;
    
}

header img{
    position: relative;
    height: 100px;
    width:300px;
    right:7%;
}

header a{
    text-decoration: none;
    color: black;
    transition: all 0.3s ease 0s;
}

header a:hover{
    color: whitesmoke;
}

#nav-title{
   font-size: 2.5rem;
   margin-right: 2%;
   color: black;
}

#page-1{
    height: 100%;
    width: 100%;
}

#task-container{
    position: absolute;
    height: 30px;
    width: 130px;
    background :#f06a6a;
    display: flex;
    align-items: center;
    justify-content: center;
    right: 25%;
    top: 3%;
    padding: 5px 4px;
    border-radius: 15px;
    outline: 0;
}

#task-container p{
    margin: 0px -5px;
    padding: 3px 4px;
}

#task-container:hover{
    cursor: pointer;
}


#task-container i{
    padding: 3px 4px;
    size: 30px; 
}

#search-bar{
    position: absolute;
    width: 220px;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 30px;
    right: 7%;
    top: 3%;
    background: whitesmoke;
    padding: 7px 5px;
    border-radius: 20px;    



}

#search-bar #s-bar{
    background: transparent;
    border: 0;
    outline: 0;
    padding: 3px 4px;
   
}


<style>
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
