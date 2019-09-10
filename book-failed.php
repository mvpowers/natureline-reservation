<?php

	ini_set("session.cookie_lifetime", 3600 );
	session_start();

	$user_name = $_SESSION['user_name'];
	$user_id = $_SESSION['user_id'];
	$user_level = $_SESSION['user_level'];

?>
<!DOCTYPE html>
<html>
<head>
	<title>booking failed</title>
</head>
<body>

	<header>
		<?php

			if (isset($_SESSION['user_level']) and $_SESSION['user_level'] == 1) {
				
				require './include/header-admin.php';
			}
			if (isset($_SESSION['user_level']) and $_SESSION['user_level'] == 0) {
				
				require './include/header-members.php';
			}

		?>
	</header>

		<h3>booking failed because all the seats have been booked</h3>
		<a href="members-page.php">back to account page</a>
	
</body>
</html>