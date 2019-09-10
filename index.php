<?php
	ini_set("session.cookie_lifetime", 3600 );
	session_start();
	if (isset($_SESSION['user_level']) and ($_SESSION['user_level']) == 1) {
		header("location: admin.php");
	}

	if (isset($_SESSION['user_level']) and ($_SESSION['user_level']) == 0) {
		header("location: members-page.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>nature airline</title>
	<style type="text/css">
		body{
			background-color: #f9f9fa;
		}
	</style>
</head>
<body>

	<header>
		
		<nav>
			<a href="./login.php">login</a>
			<a href="./register.php">register</a>
		</nav>

	</header>

	<section>

		<h1>welcome to our airline</h1>

		<?php
			include './include/search-form.php';
		?>
	</section>
	
</body>
</html>