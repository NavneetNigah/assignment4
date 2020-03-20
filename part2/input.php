<?php
session_start();
require('mysqli_oop_connect.php');
$_SESSION['msg']="";
$msg="";

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
$username=$_POST['user'];
$msg=$_POST['msg'];

if(empty($username) || empty($msg) )
    {
		$_SESSION['msg']="Please enter valid data";
        header("Location: index.php");
	}
    else
    {
        $qury = "INSERT INTO messages VALUES(? , ?)";   // preparing statement for insertion   
        $statmnt=$mysqli->prepare($qury);
        $statmnt->bind_param('ss',$username,$msg); // binding data 
        $username=($_POST['user']);
        $msg=($_POST['msg']);
        

        $statmnt->execute(); // executing the statement
        
        if($statmnt->affected_rows == 1)
        {
            $_SESSION['msg']= "Message has been submitted";
            header("Location: index.php");
        }
        else
        {
            echo '<h3>' . $statmnt->error . '</h3>';
        }
        
        $statmnt->close();
        unset($statmnt);
        
    }
}
 
?>