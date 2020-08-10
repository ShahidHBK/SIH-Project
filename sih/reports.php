<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'sih');
 
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
</head>
<body>
<header class="site-header">
         <nav class="navbar navbar-expand-md navbar-dark bg-steel fixed-top">
             <div class="container">
                  <a class="navbar-brand mr-4" href="#">Our Website</a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                  </button>
               <div class="collapse navbar-collapse" id="navbarToggle">
                  <div class="navbar-nav mr-auto">
                       <a class="nav-item nav-link" href="reports.php">Home</a>
                      <a class="nav-item nav-link" href="new report.php">New Report</a>
                  </div>
                   <div class="navbar-nav">
                           <a class="nav-item nav-link" href="#">Login</a>
                           <a class="nav-item nav-link" href="#">Register</a>
                   </div>
               </div>
             </div>
         </nav>
    </header>
<main role="main" class="container">

  <div class="row">

    <div class="col-md-8">
      <?php
$sql = "SELECT id, user, title, content, time FROM reports ORDER BY time DESC";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) 
{
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) 
    {
        echo '<article class="media content-section">';
	echo '<div class="media-body">';
	echo '<div class="article-metadata">';
	echo '<a class="mr-2" href="#">'.$row["user"].'</a>';
	echo '<small class="text-muted">'.$row["time"].'</small>';
	echo '</div>';
	echo '<h2><a class="article-title" href="#">'.$row["title"].'</a></h2>';
	echo '<p class="article-content">'.$row["content"].'</p>';
	echo '<form name="upvote" action="#" method="post">';
	echo '<input type=submit value="upvote" name="up_submit"/>';
	echo '</form>';
	if(isset($_POST['up_submit']))
	{
		$sql="update reports set upvote=upvote+1 where id=".$row["id"]."";
		echo $sql;
	}
	echo '</div>';
	echo '</article>';
    }
} 
else 
{
    echo "0 results";
}

mysqli_close($link);
?>

    </div>

    <div class="col-md-4">

      <div class="content-section">

        <h3>Our Sidebar</h3>

        <p class='text-muted'>You can put any information here you'd like.

          <ul class="list-group">

            <li class="list-group-item list-group-item-light">Latest Posts</li>

            <li class="list-group-item list-group-item-light">Announcements</li>

            <li class="list-group-item list-group-item-light">Calendars</li>

            <li class="list-group-item list-group-item-light">etc</li>

          </ul>

        </p>

      </div>

    </div>

  </div>

</main>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"  crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"  crossorigin="anonymous"></script>
</body>
</html>
