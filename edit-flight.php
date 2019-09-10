<?php
	
	ini_set("session.cookie_lifetime", 3600);
	session_start();
	$user_name = $_SESSION['user_name'];
	
	if (!isset($_SESSION['user_level']) or $_SESSION['user_level'] != 1) {
		header("location: login.php");
		exit();
	}

	try
		{

			require_once('./mysqli_connect.php'); 

	if (isset($_GET['flight_id'])) {

		$flight_id = htmlspecialchars($_GET['flight_id'], ENT_QUOTES);

		$query = "SELECT * FROM flight WHERE flight_id=? ";	
		$q = mysqli_stmt_init($dbcon);
		mysqli_stmt_prepare($q, $query);
		mysqli_stmt_bind_param($q, 'i', $flight_id); 
		mysqli_stmt_execute($q); 
		$result = mysqli_stmt_get_result($q);

		if (mysqli_num_rows($result) == 1) {
		// Fetch and save the records
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

			$flight_name = htmlspecialchars($row['flight_name'], ENT_QUOTES);
			$origin = htmlspecialchars($row['origin'], ENT_QUOTES);
			$destination = htmlspecialchars($row['destination'], ENT_QUOTES);
			$check_in_time = htmlspecialchars($row['check_in_time'], ENT_QUOTES);
			$check_in_date = htmlspecialchars($row['check_in_date'], ENT_QUOTES);
			$departure_time = htmlspecialchars($row['departure_time'], ENT_QUOTES);
			$departure_date = htmlspecialchars($row['departure_date'], ENT_QUOTES);
			$max_seat = htmlspecialchars($row['max_seat'], ENT_QUOTES);
			$status = htmlspecialchars($row['status'], ENT_QUOTES);
			$flight_bill = htmlspecialchars($row['flight_bill'], ENT_QUOTES);
			$faa_bill = htmlspecialchars($row['faa_bill'], ENT_QUOTES);
			$cost = htmlspecialchars($row['total_cost'], ENT_QUOTES);
			$flight_id = htmlspecialchars($row['flight_id'], ENT_QUOTES);

			}                                                 
			mysqli_free_result ($result); // Free up the resources.	


		} // end of mysqli_num_rows()
		else { 

			echo '<p class="center-text">fetching problem.</p>';
			// Debugging message:
			echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>'; 
			//Show $q is debug mode only
		} // End of if ($result). 
		
	}// end of if  $_GET['flight_id']
	else{
		echo "<p>this page was accessed in error</p>";
		exit();
	}

		}// end of try
		catch(Exception $e)
		{
		print "The system is currently busy. Please try later.";
		//print "An Exception occurred.Message: " . $e->getMessage();
		}catch(Error $e)
		{
		print "The system us busy. Please try later.";
		//print "An Error occured. Message: " . $e->getMessage();
		}
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
			require 'process-edit-flight.php';
		}

		function input($fieldValue){

				if (isset($fieldValue)) {
					
					echo $fieldValue;
				}
		}

		function setSelected($fieldName, $fieldValue ){
				if (isset($_POST[$fieldName]) and $_POST[$fieldName] == $fieldValue) {
					echo "selected=selected";
				}
		}

?>
	
	<h1>edit flight details</h1>
	<form action="<?php echo $url?>" method = "post">
		<label>flight name : </label><input type="text" name="flight_name" value="<?php input($flight_name); ?>"><br><br>
		<label>flight origin</label><input type="text" name="origin" value="<?php input($origin); ?>"><br><br>
		<label>flight destination</label><input type="text" name="destination" value="<?php input($destination); ?>"><br><br>
		<label>check-in time</label><input type="time" name="check_in_time" value="<?php input($check_in_time); ?>"><br><br>
		<label>check-in date</label><input type="date" name="check_in_date" value="<?php input($check_in_date); ?>"><br><br>
		<label>departure time</label><input type="time" name="departure_time" value="<?php input($departure_time); ?>"><br><br>
		<label>depature date</label><input type="date" name="departure_date" value="<?php input($departure_date); ?>"><br><br>
		<label>max_seat</label><input type="number" name="max_seat" value="<?php input($max_seat); ?>"><br><br>
		<label>flight bill</label><input type="text" name="flight_bill" value="<?php input($flight_bill); ?>"><br><br>

		<label>faa</label><input type="text" name="faa_bill" value="<?php input($faa_bill); ?>"><br><br>
		<label for="status">availability</label>
		<select id="status" name="status">
			<option value="">select status</option>
			<option value="available" <?php setSelected('status' , 'available')?> >available</option>
			<option value="not available" <?php setSelected('status' , 'not available')?> >not available</option>
		</select><br><br>
		<input type="submit" name="submit" value="edit flight">
	</form>

</body>
</html>