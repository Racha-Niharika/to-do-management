<?php

include("connect.php");

// SQL query to delete all records from the tform table
$sql = "DELETE FROM user1";

if ($con->query($sql)) {
    echo "All records deleted successfully";
} else {
    echo "Error deleting records: " . $con->error;
}

// Close the connection
$con->close();

?>
