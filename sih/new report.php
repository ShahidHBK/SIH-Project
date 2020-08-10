<?php
session_start();
$name = $_SESSION['username'];
?>
<?php
define('DB_SERVER', '139.59.66.244');
define('DB_USERNAME', 'phpmyadmin');
define('DB_PASSWORD', 'Atharva@123');
define('DB_NAME', 'sih2020');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
else
{
	//echo "awesome<br>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"  crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
    <title>Reports</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="home.css">
    	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</head>
<body>
 <!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header">
      <div class="mdl-layout__header-row">
        <!-- Title -->
        <span class="mdl-layout-title">RahoSavdhan</span>
        <!-- Add spacer, to align navigation to the right -->
        <div class="mdl-layout-spacer"></div>
        <!-- Navigation. We hide it in small screens. -->
        <nav class="mdl-navigation mdl-layout--large-screen-only">
          <a class="mdl-navigation__link active" href="index.php">Home</a>
          <a class="mdl-navigation__link" href="">Maps</a>
          <a class="mdl-navigation__link" href="">LiveCrime</a>
          <a class="mdl-navigation__link" href="">SMS/SOS Feature</a>
          <a class="mdl-navigation__link" href="">About</a>

        </nav>
      </div>
    </header>
    <div class="mdl-layout__drawer">
      <span class="mdl-layout-title">RahoSavdhan</span>
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="">Home</a>
        <a class="mdl-navigation__link" href="">Maps</a>
        <a class="mdl-navigation__link" href="">LiveCrime</a>
        <a class="mdl-navigation__link" href="">SMS/SOS Feature</a>
        <a class="mdl-navigation__link" href="">About</a>
      </nav>
    </div>
    
  </div>
<br>
<br>
<br>
<br>
<br>
<main role="main" class="container">

  <div class="row">

    <div class="col-md-8">
	<div class="content-section">
        <form method="POST" action="#">
            <fieldset class="form-group">
                <legend class="border-bottom mb-4">Report the crime you see</legend>
		<div class="form-group">
  			<label for="pwd">Title:</label>
  			<input type="text" class="form-control" name="title">
		</div> 
		<div class="form-group">
  			<label for="comment">Description:</label>
  			<textarea class="form-control" rows="5" name="content"></textarea>
		</div> 
            </fieldset>
            <div class="form-group">
                <input class="btn btn-outline-info" type="submit" name="submit" value="Report"/>
            </div>
        </form>
	


<?php
if(isset($_POST['submit']))
{
	$user=$_SESSION['username'];
	$title=$_POST['title'];
	$desc=htmlspecialchars($_POST['content']);
	$sql="insert into posts(user,title,text) values('$name','$title','$desc')";
	mysqli_query($link,$sql);
	$message = "Your Request has been submitted. We will reply to you soon.";
	echo "<script type='text/javascript'>alert('$message');</script>";
	header("Location: index.php");
	
}
?>



    </div>

    </div>

    

</main>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"  crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"  crossorigin="anonymous"></script>
</body>
</html>
