<?php
// Check if the user is logged in, if so allow them to access their profile page
if(!isset($_COOKIE["userID"])){
  header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
<title>Settings</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

    /* Class for switch */
    .switch {
      position: relative;
      display: inline-block;
      width: 50px;
      height: 24px;
    }

    /* Hide default HTML checkbox */
    .switch input {display:none;}

    /* The slider within the switch */
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 16px;
      width: 16px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #66CD00;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }

		body{
			background-color: gainsboro;
		}

body, h1,h2,h3,h4,h5,h6 {font-family: "Montserrat", sans-serif}
.w3-row-padding img {margin-bottom: 12px}
/* Set the width of the sidebar to 120px */
.w3-sidebar {width: 120px;background: #222;}
/* Add a left margin to the "page content" that matches the width of the sidebar (120px) */
#main {margin-left: 120px}
/* Remove margins from "page content" on small screens */
@media only screen and (max-width: 600px) {#main {margin-left: 0}}
</style>


<!-- Icon Bar (Sidebar - hidden on small screens) -->
<nav class="w3-sidebar w3-bar-block w3-small w3-hide-small w3-center">
  <a href="homePage.php" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-home w3-xxlarge"></i>
    <p>HOME</p>
  </a>
  <a href="profilePage.php" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-user w3-xxlarge"></i>
    <p>PROFILE</p>
  </a>
  <a href="submitContentPage.php" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-globe w3-xxlarge"></i>
    <p>SUBMIT CONTENT</p>
  </a>

  <a href="../scriptsPHP/logoutForm.php" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-sign-in w3-xxlarge"></i>
    <p>LOGOUT</p>
  </a>
</nav>

<!-- Page Content -->
<div class="w3-padding-large" id="main">
  <!-- Header/Home -->
  <header class="w3-container w3-padding-32 w3-center w3-black" id="home">
    <h1 class="w3-jumbo"><span class="w3-hide-small"></span> FaceIt</h1>
    <p>Facilitate conversation, share knowledge, and connect like minded people.</p>
  </header>

  <!-- Settings -->
  <h2 class="w3-text-black">Settings</h2>
    <ul class="w3-ul">
      <li>Name</li>
      <hr style="width:200px" class="w3-text-black">
      <li>Username</li>
      <hr style="width:200px" class="w3-text-black">
      <li>Contact</li>
        
    
</div>

  <div style="position: fixed; top: 93%; left: 92%;">
      <p>FaceIt © 2017</p>
  </div>
    
</div>




</body>
</html>