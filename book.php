<?php

	ini_set("session.cookie_lifetime", 3600 );
	session_start();
	require './include/url.php';

	if (!isset($_SESSION['user_level'])) {
		header("location: login.php");
		exit();
	}

	$user_name = $_SESSION['user_name'];
	$user_id = $_SESSION['user_id'];
	$user_level = $_SESSION['user_level'];

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<header>
		<?php

			if ($_SESSION['user_level'] == 1) {
				require './include/header-admin.php';
			}
			if ($_SESSION['user_level'] == 0) {
				require './include/header-members.php';
			}

		?>
	</header>

	<h1>welcome to the booking page</h1>

		<?php

			if ((isset($_GET['flight_id'])) ) { // From search.php
			$flight_id = $_GET['flight_id'];
			}elseif((isset($_POST['flight_id']))) { // Form submission.
			$flight_id = $_POST['flight_id'];
			}else{

				echo '<p>This page has been accessed in error.</p>';
				exit();
			}

			if (isset($_POST['submit'])) {
				require 'process-book-users.php';
			}

			function input($fieldValue){

					if (isset($_POST[$fieldValue])) {

						echo $_POST[$fieldValue];
					}
			}

			function setChecked($fieldName, $fieldValue ){
				if (isset($_POST[$fieldName]) and $_POST[$fieldName] == $fieldValue) {
					echo "checked=checked";
				}
			}


			function setSelected($fieldName, $fieldValue ){
				if (isset($_POST[$fieldName]) and $_POST[$fieldName] == $fieldValue) {
					echo "selected=selected";
				}
			}
		?>
		<form action="book.php" method="post">
		<label for="booking_mode">who are you booking for</label>
		<select id="booking_mode" name="booking_mode">
			<option>select person</option>
			<option value="1" style="display:<?php if($_SESSION['user_level'] == 1){echo 'none';}else{echo 'block';}?>;" <?php setSelected('booking_mode' , 1);?> >for me</option>
			<option value="2" style="display:<?php if($_SESSION['user_level'] == 1){echo 'none';}else{echo 'block';}?>;" <?php setSelected('booking_mode' , 2);?>>for another</option>
			<option value="3" style="display:<?php if($_SESSION['user_level'] == 1){echo 'block';}else{echo 'none';}?>;" <?php setSelected('booking_mode' , 3);?>>customer</option>
		</select><br>
		<label for="first_name">first name</label><input type="text" name="first_name" id="first_name" value="<?php input('first_name') ?>"><br>
		<label for="last_name">last name</label><input type="text" name="last_name" id="last_name" value="<?php input('last_name') ?>"><br>
		<label for="email">email:</label><input type="email" name="email" id="email" value="<?php input('email') ?>"><br>
		<label for="phone">phone:</label><input type="text" name="phone" id="phone" value="<?php input('phone') ?>"><br>


		<label for="male">male</label>
		<input type="radio" name="sex" value="m" id="male" <?php if(!isset($_POST['sex'])){ echo "checked"; } setChecked('sex' , 'm')?> ><br>
		<label for="female">female</label>
		<input type="radio" name="sex" value="f" id="female" <?php setChecked('sex' , 'f')?>><br>

		<label for="age">age</label><input type="number" name="age" id="age" value="<?php input('age') ?>"><br>
		<label for="address">address:</label><input type="text" name="address" id="address" value="<?php input('address') ?>"><br>
		<input type="hidden" name="flight_id" value="<?php echo $flight_id?>">
		<input type="submit" name="submit" value="book">
	</form>
</body>
</html>