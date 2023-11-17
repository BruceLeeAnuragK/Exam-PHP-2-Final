<?php


session_start();

// Check if the user is logged in, oth  erwise redirect to login page
if (!isset($_SESSION['UId'])) {
    header("Location: login.php");
    exit;
}

 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="style1.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
		
	<body class="loggedin">
	
		<nav class="navtop">
			<div>
				<h1>Wikipedia</h1>
				<a href="Chagepwd.php"><i class="fas fa-user-circle"></i>Change Password</a>
				<a href="login.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
			<br><br><br><br>
		</nav>
		<div class="content">
		     <h2>Welcome,  <?php echo $_SESSION['UEmail']; ?> !</h2>
		</div>
		<center>
		<!-- <image src="https://getmegiddy.com/sites/default/files/2021-12/The-Definitve-Restless-Legs-Syndrome-article_P_Hero.gif"   height="30%" width="55%"></image> -->
	</body>
</html>
</body>

</html>


			
			
			
	