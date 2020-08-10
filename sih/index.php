<?php 
  session_start();
$name = $_SESSION['username'];

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<?php 
	// connect to the database
	$con = mysqli_connect('139.59.66.244', 'phpmyadmin', 'Atharva@123', 'sih2020');

	if (isset($_POST['liked'])) {
		$postid = $_POST['postid'];
		$result = mysqli_query($con, "SELECT * FROM posts WHERE id=$postid");
		$row = mysqli_fetch_array($result);
		$n = $row['likes'];

		mysqli_query($con, "INSERT INTO likes (userid, postid) VALUES ('$name', $postid)");
		mysqli_query($con, "UPDATE posts SET likes=$n+1 WHERE id=$postid");

		echo $n+1;
		exit();
	}
	if (isset($_POST['unliked'])) {
		$postid = $_POST['postid'];
		$result = mysqli_query($con, "SELECT * FROM posts WHERE id=$postid");
		$row = mysqli_fetch_array($result);
		$n = $row['likes'];

		mysqli_query($con, "DELETE FROM likes WHERE postid=$postid AND userid='$name'");
		mysqli_query($con, "UPDATE posts SET likes=$n-1 WHERE id=$postid");
		
		echo $n-1;
		exit();
	}

	// Retrieve posts from the database
	$posts = mysqli_query($con, "SELECT * FROM posts ORDER BY time DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"  crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"  crossorigin="anonymous"></script>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"  crossorigin="anonymous">
    	<link rel="stylesheet" href="main.css">
	<title>Like and unlike system</title>
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
          <a class="mdl-navigation__link active" href="">Home</a>
          <a class="mdl-navigation__link" href="">Maps</a>
          <a class="mdl-navigation__link" href="">LiveCrime</a>
          <a class="mdl-navigation__link" href="">SMS/SOS Feature</a>
          <a class="mdl-navigation__link" href="index.php?logout='1'">Logout</a>

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
	<!-- display posts gotten from the database  -->
		<?php while ($row = mysqli_fetch_array($posts)) { ?>

		<article class="media content-section">
                
                  <div class="media-body">

                    <div class="article-metadata">

                      <a class="mr-2" href=""><?php echo $row['user']; ?></a>

                      <small class="text-muted"><?php echo $row['time']; ?></small>

                    </div>

                    <h2><a class="article-title" href=""><?php echo $row['title']; ?></a></h2>

                    <p class="article-content"><?php echo $row['text']; ?></p>
			<?php 
					// determine if user has already liked this post
					$a="SELECT * FROM likes WHERE userid='$name' AND postid=".$row['id']."";
					$results = mysqli_query($con, $a);

					if (mysqli_num_rows($results) == 1 ): ?>
						<!-- user already likes post -->
						<span class="unlike fa fa-thumbs-up" data-id="<?php echo $row['id']; ?>"></span> 
						<span class="like hide fa fa-thumbs-o-up" data-id="<?php echo $row['id']; ?>"></span> 
					<?php else: ?>
						<!-- user has not yet liked post -->
						<span class="like fa fa-thumbs-o-up" data-id="<?php echo $row['id']; ?>"></span> 
						<span class="unlike hide fa fa-thumbs-up" data-id="<?php echo $row['id']; ?>"></span> 
					<?php endif ?>

					<span class="likes_count"><?php echo $row['likes']; ?> upvotes</span>

                  </div>

            </article>

		<?php } ?>

    </div>

    <div class="col-md-4">

      <div class="content-section">
<div class="newbutton">
        <a href="new report.php"><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent mt-2 mb-2">
  New Report
</button>
</a></div>

        <p class='text-muted mt-2'>You can put any information here you'd like.

          This is the news feed of our website which you can use to contribute to our system by notifying others of crimes around you or otherwise.

        </p>

      </div>

    </div>

  </div>

</main>
<!-- Add Jquery to page -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		// when the user clicks on like
		$('.like').on('click', function(){
			var postid = $(this).data('id');
			    $post = $(this);

			$.ajax({
				url: 'index.php',
				type: 'post',
				data: {
					'liked': 1,
					'postid': postid
				},
				success: function(response){
					$post.parent().find('span.likes_count').text(response + " upvotes");
					$post.addClass('hide');
					$post.siblings().removeClass('hide');
				}
			});
		});

		// when the user clicks on unlike
		$('.unlike').on('click', function(){
			var postid = $(this).data('id');
		    $post = $(this);

			$.ajax({
				url: 'index.php',
				type: 'post',
				data: {
					'unliked': 1,
					'postid': postid
				},
				success: function(response){
					$post.parent().find('span.likes_count').text(response + " upvotes");
					$post.addClass('hide');
					$post.siblings().removeClass('hide');
				}
			});
		});
	});
</script>

<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	//echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
   
</div>

</body>
</html>