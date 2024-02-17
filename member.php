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

<!-- Displaying records in a table -->
<h2 style="text-align: center;">Task Records</h2>
        <br>
        <br>
        <table class="center">
            <thead>
                <tr>
                    <th>Team Member Name</th>
                    <th>Task Name</th>
                    <!-- Add other table headers as needed -->
                    <th>status</th>
                    <th>update</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $taskName = $row['name'];
                $highlightClass = $searchTerm != '' && stripos($taskName, $searchTerm) !== false ? 'highlight' : '';
                echo "<tr>";
                echo "<td>" . $row['tname'] . "</td>"; // Display Team Member Name
                echo "<td class='$highlightClass'>" . $taskName . "</td>";  // Display Task Name with highlighting
                echo "<td>" . $row['status'] . "</td>";  // Display Status
                echo '<td><a href="update.php">Update</td>'; // Placeholder for Update button/link
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</body>

</html>



