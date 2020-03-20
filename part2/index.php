<?php 
session_start();
if(isset($_SESSION['msg']))
{
	echo "<h3>".$_SESSION['msg']."</h3>";
	session_unset();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Index Page</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="col-md-6">
			<h1>Please enter your message</h1>
	 <form action="" method="POST">
		  <div class="form-group">
		    <label for="user">Username</label>
		    <input type="text" class="form-control" name="user" id="user">
		  </div>
		  <div class="form-group">
		    <label for="msg">Message</label>
		    <input type="text" class="form-control" name="msg" id="msg">
		  </div>
		  <button type="button" class="btn btn-success" onclick="postData()">Submit</button>
	</form> 
</div>
<div class="col-md-6">
	<h1>Message results</h1>
	<div id="result"></div>
</div>
</div>
<script>
// function to get messages
function getmessage() {
  fetch('./messages.php', { method: 'get' })
                .then(response => response.text())
                .then(data => {
                    document.getElementById("result").innerHTML = data;
                });
}
// Function to post data 
function postData() {
            let user =  document.getElementById("user").value;
            let msg =  document.getElementById("msg").value;

            let formData = new FormData();
            formData.append('user', user);
            formData.append('msg', msg);

            fetch('./input.php', { method: 'post', body: formData});
    }

        setInterval(getmessage, 1000);
//getmessage();
</script>
</body>
</html>