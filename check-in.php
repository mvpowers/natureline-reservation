<?php
	ini_set("session.cookie_lifetime", 3600 );
	session_start();
	if (!isset($_SESSION['user_level']) or $_SESSION['user_level'] != 1) {
		header("location: login.php");
		exit();
	}
	$user_name= $_SESSION['user_name'];
	$user_id = $_SESSION['user_id'];
	$user_level = $_SESSION['user_level'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>check-in</title>
</head>
<body>

	<header>
		<?php
			require './include/header-admin.php';
		?>
	</header>

	<h3>check-in</h3>

	<?php
		if (isset($_POST['submit'])) {
			require 'process-check-in.php';
		}

		require './include/url.php';
	?>

	<form action="<?php echo $url?>" method="post">
		<input type="text" name="ticket_id" placeholder="ticket id"><br>
		<input type="submit" name="submit" value="check">
	</form>
	
</body>
</html>