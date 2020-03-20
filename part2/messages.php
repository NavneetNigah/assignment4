<?php 
session_start(); // session start 
require('mysqli_oop_connect.php');
$query = "SELECT * FROM messages";
   
    $rows = $mysqli->query($query); 
 
    $num = $rows->num_rows;
    if ($num > 0) 
     { 
     	while ($row = $rows->fetch_assoc()) // Fething the results
    		{
    			echo "<h5> Username :". $row['username']."</h5>";
    			echo "<h5> Message :". $row['message']."</h5><br>";
    		}
     }
     else
     {
     	echo "No messages to show"; // If there is no data in database
     }
?>
