


<?php
session_start();
include 'connect.php';

// Assuming the user is logged in, and their email is stored in the session
$username= isset($_SESSION["username"]) ? $_SESSION["username"] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve task name and status from the form submission
    $taskName = isset($_POST["taskName"]) ? $_POST["taskName"] : '';
    $status = isset($_POST["status"]) ? $_POST["status"] : '';

    // Update the status in the database
    $updateQuery = "UPDATE tform SET status = '$status' WHERE recipient_email = '$username' AND name = '$taskName'";
    $updateResult = mysqli_query($con, $updateQuery);

    if (!$updateResult) {
        die("Update query failed: " . mysqli_error($con));
    }

    // Redirect to member.php after updating
    header("Location: member.php");
    exit();
}

// Fetch task names associated with the logged-in team member's email
$query = "SELECT DISTINCT name FROM tform WHERE recipient_email = '$username'";
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Salsa&display=swap" rel="stylesheet">
    <style>
        body {
            background: #4070f4;
            font-family: "Kanit", sans-serif;
            }

        h2{
            color: rgb(95, 34, 156);
            text-align: center;
            font-size: 2rem;
            text-decoration: underline;
        }

        .wrapper{
           
            height: 65vh;
            width: 35%;
            /* background:rgb(147, 243, 51); */
            background: white;
            border-radius: 15px;
            border: 0;
            margin: auto;
            justify-content: center;
            align-items: center;
            /* box-shadow: 0 0 10px 5px rgba(245, 222, 179, 0.8); */
            box-shadow: 0 0 25px rgba(126, 245, 8, 0.8); 
            
        }
form{
    /* background: blue; */
    margin: -30px 4px;
    padding: 4px 50px;
}

h3{
    color: black;
    font-size: 1.4rem;
    margin: 20px 4px;
    
}
form > label{
    font-size: 1.3rem;
}
        #input1 input{
            height: 25px;
            width: 300px;
            margin: 0px 3px;
            padding: 3px 4px;
            border: 2px solid black;
            border-radius: 10px;
        }

     #status{
            height: 28px;
            width: 300px;
            margin: 2px 3px;
            padding: 3px 54px;
            font-size: 1rem;
            border-radius: 10px;
        }

        #status:hover{
            cursor: pointer;
        }
 
        .text{
           margin: 7px 50px;
        }

        .text a{
        color:rgb(28, 25, 25);
        transition: all ease 0.5s;
        }
        .text a:hover{
            color: red;
        }
        #button button {
        font-weight: bold;
    }
        
        button{
            margin: 30px 5px;
            padding: 2px 5px;
            border-radius: 10px;
            height: 40px;
            width: 110px;
            font-size: 1rem;
            font-weight: 500;
            background: lawngreen;
            color: black;
        }
        button:hover{
            cursor: pointer;
            background:limegreen;
            color: white;

        }

        
    </style>
</head>
<body>
<div class="wrapper">
        <h2>Status Form</h2>

        <form action="" method="post">
            <h3>Task Name</h3>
            <div id="input1">
                <!-- Dropdown to select task name -->
                <select id="taskName" name="taskName"  required>
                    
                <?php
            // Database connection details
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "to-do";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to fetch tasks from the database
            $sql = "SELECT distinct name FROM tform  ";
            $result = $conn->query($sql);

            // Populate dropdown list with tasks
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
            }

            // Close the database connection
            $conn->close();
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