<?php
	
	ini_set("session.cookie_lifetime", 3600);
	session_start();
	if (!isset($_SESSION['user_level']) or $_SESSION['user_level'] != 1) {
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
	<title>add flights</title>
</head>
<body>

	<header>
		<?php
			require './include/header-admin.php';
		?>
	</header>

<?php

		require './include/url.php';

		if (isset($_POST['submit'])) {
			require 'process-add-flights.php';
		}

		function input($fieldName){

				if (isset($_POST[$fieldName])) {
					
					echo $_POST[$fieldName];
				}
		}

		function setSelected($fieldName, $fieldValue ){
				if (isset($_POST[$fieldName]) and $_POST[$fieldName] == $fieldValue) {
					echo "selected=selected";
				}
		}
?>
	
	<h1>available fights</h1>
	<form action="<?php echo $url?>" method = "post">
		<label>flight name : </label><input type="text" name="flight_name" value="<?php input('flight_name')?>"><br><br>
		<label>flight origin</label><input type="text" name="origin" value="<?php input('origin')?>"><br><br>
		<label>flight destination</label><input type="text" name="destination" value="<?php input('destination')?>"><br><br>
		<label>check-in time</label><input type="time" name="check_in_time" value="<?php input('check_in_time')?>"><br><br>
		<label>check-in date</label><input type="date" name="check_in_date" value="<?php input('check_in_date')?>"><br><br>
		<label>departure time</label><input type="time" name="departure_time" value="<?php input('departure_time')?>"><br><br>
		<label>depature date</label><input type="date" name="departure_date" value="<?php input('departure_date')?>"><br><br>
		<label>max_seat</label><input type="number" name="max_seat" value="<?php input('max_seat')?>"><br><br>
		<label>flight bill</label><input type="text" name="flight_bill" value="<?php input('flight_bill')?>">
		<label>faa</label><input type="text" name="faa_bill" value="<?php input('faa_bill')?>"><br><br>
		<label for="status">availability</label>
		<select id="status" name="status">
			<option value="">select status</option>
			<option value="available" <?php setSelected('status' , 'available')?> >available</option>
			<option value="not available" <?php setSelected('status' , 'not available')?> >not available</option>
		</select><br><br>
		<input type="submit" name="submit" value="add flight">
	</form>

</body>
</html>