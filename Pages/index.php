<?php
if(isset($_COOKIE["userID"])){
  header('Location: profilePage.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>FaceIt Login</title>
<style>
body{
	background-color: gainsboro;
}
input[type="text"] {
  padding: 10px;
  border: solid 3px grey;
  transition: border 0.3s;
  border-radius: 4px;
}

input[type="password"] {
  padding: 10px;
  border: solid 3px grey;
  transition: border 0.3s;
  border-radius: 4px;
}

.button{
	background-color: gainsboro; 
    border: none;
    color: black;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border: 2px solid grey;
    border-radius: 4px;
}

</style>
</head>
<body>
<header>
	
  <CENTER>
  <img src="Images/faceit_mainlogo_grey.png" id="sslogo"/>
  <!-- Site logo -->
  <form method="post" id="loginForm" name="loginForm" action="../scriptsPHP/loginForm.php">
  <!-- Sends info to loginForm.php -->
  		<br>
  		<!-- Max 20 characters -->
  		<input type="text" name="username" placeholder="Username"><br> 
  		<!-- Username entry field -->
  		<br>
  		<input type="password" name="password" placeholder="Password">
  		<!-- Password entry field -->
  		<br>
  		<br><input type="Submit" class="button" value="Login" onclick="return validateForm()" /></input> 
  		<!-- Checks to see if fields are left empty -->
	</form>
	<br>
	<form action="createAccount.php">
		<input type="Submit" class="button" value="Create Account"></input>
		<!-- Sends to create account page -->
	</form>

    </CENTER>

</header> 
</body>
</html>

<script type="text/javascript">
// Checks to see if fields are blanks, alerts if they are
function validateForm()
{
	var a=document.forms["loginForm"]["username"].value;
    var b=document.forms["loginForm"]["password"].value;
    if(a==null || a=="",b==null || b=="")
    {
    	alert("Please fill all required fields");
    	return false;
    }
}
</script>