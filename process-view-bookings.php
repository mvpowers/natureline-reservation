<?php

try{
	require('mysqli_connect.php');

/* 	NEWLY BOOKED*/

if($_SESSION['user_level'] == 0){
	$query = "SELECT * from bookings INNER JOIN flight on bookings.flight_id = flight.flight_id WHERE bookings.user_id = ?";

		$q = mysqli_stmt_init($dbcon);
		mysqli_stmt_prepare($q, $query);
		mysqli_stmt_bind_param($q, 'i', $user_id);	 
		mysqli_stmt_execute($q); 
		$result = mysqli_stmt_get_result($q);
}

if($_SESSION['user_level'] == 1){
	$query = "SELECT * from bookings INNER JOIN flight on bookings.flight_id = flight.flight_id";
	$result = mysqli_query($dbcon, $query);
}


	if (mysqli_num_rows($result) != 0) {

		$recent_booking = true;

			echo '<table class="table recent">
		<tr>
		<th>first name</th>
		<th>last name</th>
		<th>sex</th>
		<th>age</th>
		<th>address</th>
		<th>booking_email</th>
		<th>seat number</th>
		<th>ticket id</th>
		<th>booking mode</th>
		<th>booking date</th>
		<th>flight name</th>
		<th>origin</th>
		<th>destination</th>
		<th>check_in_time</th>
		<th>check_in_date</th>
		<th>departure_time</th>
		<th>departure_date</th>
		<th>flight bill</th>
		<th>faa bill</th>
		<th>total cost</th>
		</tr>';	

	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

	$first_name = htmlspecialchars($row['first_name'], ENT_QUOTES);
	$last_name = htmlspecialchars($row['last_name'], ENT_QUOTES);
	$sex = htmlspecialchars($row['sex'], ENT_QUOTES);
	$age = htmlspecialchars($row['age'], ENT_QUOTES);
	$email = htmlspecialchars($row['booking_email'], ENT_QUOTES);
	$address = htmlspecialchars($row['address'], ENT_QUOTES);
	$phone = htmlspecialchars($row['phone'], ENT_QUOTES);
	$ticket_id = htmlspecialchars($row['ticket_id'], ENT_QUOTES);
	$seat_number = htmlspecialchars($row['seat_number'], ENT_QUOTES);
	$booking_mode = htmlspecialchars($row['booking_mode'], ENT_QUOTES);
	$booking_date = htmlspecialchars($row['booking_date'], ENT_QUOTES);
	//flight details
	$flight_name = htmlspecialchars($row['flight_name'], ENT_QUOTES);
	$origin = htmlspecialchars($row['origin'], ENT_QUOTES);
	$destination = htmlspecialchars($row['destination'], ENT_QUOTES);
	$check_in_time = htmlspecialchars($row['check_in_time'], ENT_QUOTES);
	$check_in_date = htmlspecialchars($row['check_in_date'], ENT_QUOTES);
	$departure_time = htmlspecialchars($row['departure_time'], ENT_QUOTES);
	$departure_date = htmlspecialchars($row['departure_date'], ENT_QUOTES);
	$flight_bill = htmlspecialchars($row['flight_bill'], ENT_QUOTES);
	$faa_bill = htmlspecialchars($row['faa_bill'], ENT_QUOTES);
	$cost = htmlspecialchars($row['total_cost'], ENT_QUOTES);

	echo '<tr>

	<td>' . $first_name . '</td>
	<td>' . $last_name . '</td>
	<td>' . $sex . '</td>
	<td>' . $age . '</td>
	<td>' . $address . '</td>
	<td>' . $email . '</td>
	<td>' . $seat_number . '</td>
	<td>' . $ticket_id . '</td>
	<td>' . $booking_mode . '</td>
	<td>' . $booking_date . '</td>

	<td>' . $flight_name . '</td>
	<td>' . $origin . '</td>
	<td>' . $destination . '</td>
	<td>' . $check_in_time . '</td>
	<td>' . $check_in_date . '</td>
	<td>' . $departure_time . '</td>
	<td>' . $departure_date . '</td>
	<td>' . $flight_bill . '</td>
	<td>' . $faa_bill . '</td>
	<td>' . $cost . '</td>
	</tr>';
	
	} // end of while statement

	echo '</table>';
	mysqli_free_result ($result); // Free up the resources.	
	
	}else { 
	
	$recent_booking = false;
	// Debugging message:
	'<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $query .'</p>'; 
	//Show $q is debug mode only
	}




	/* ARCHIVE BOOKINGS*/

	if($_SESSION['user_level'] == 0){

		$query = "SELECT * from users_archive INNER JOIN users ON users_archive.user_id = users.user_id WHERE users_archive.user_id = ?";	

		$q = mysqli_stmt_init($dbcon);
		mysqli_stmt_prepare($q, $query);
		mysqli_stmt_bind_param($q, 'i', $user_id);	 
		mysqli_stmt_execute($q); 

		$result = mysqli_stmt_get_result($q);
	
	}

	if($_SESSION['user_level'] == 1){
		$query = "SELECT * from users_archive INNER JOIN users ON users_archive.user_id = users.user_id";

		$result = mysqli_query($dbcon,$query);
	}


	if (mysqli_num_rows($result) != 0) {

		$archive_booking = true;

			echo '<table class="table archive">
		<tr>
		<th>first name</th>
		<th>last name</th>
		<th>sex</th>
		<th>age</th>
		<th>address</th>
		<th>booking_email</th>
		<th>seat number</th>
		<th>ticket id</th>
		<th>booking mode</th>
		<th>booking date</th>
		<th>flight name</th>
		<th>origin</th>
		<th>destination</th>
		<th>check_in_time</th>
		<th>check_in_date</th>
		<th>departure_time</th>
		<th>departure_date</th>
		<th>flight bill</th>
		<th>faa bill</th>
		<th>total cost</th>
		</tr>';	

	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

	$first_name = htmlspecialchars($row['first_name'], ENT_QUOTES);
	$last_name = htmlspecialchars($row['last_name'], ENT_QUOTES);
	$sex = htmlspecialchars($row['sex'], ENT_QUOTES);
	$age = htmlspecialchars($row['age'], ENT_QUOTES);
	$email = htmlspecialchars($row['booking_email'], ENT_QUOTES);
	$address = htmlspecialchars($row['address'], ENT_QUOTES);
	$phone = htmlspecialchars($row['phone'], ENT_QUOTES);
	$ticket_id = htmlspecialchars($row['ticket_id'], ENT_QUOTES);
	$seat_number = htmlspecialchars($row['seat_number'], ENT_QUOTES);
	$booking_mode = htmlspecialchars($row['booking_mode'], ENT_QUOTES);
	$booking_date = htmlspecialchars($row['booking_date'], ENT_QUOTES);
	//flight details
	$flight_name = htmlspecialchars($row['flight_name'], ENT_QUOTES);
	$origin = htmlspecialchars($row['origin'], ENT_QUOTES);
	$destination = htmlspecialchars($row['destination'], ENT_QUOTES);
	$check_in_time = htmlspecialchars($row['check_in_time'], ENT_QUOTES);
	$check_in_date = htmlspecialchars($row['check_in_date'], ENT_QUOTES);
	$departure_time = htmlspecialchars($row['departure_time'], ENT_QUOTES);
	$departure_date = htmlspecialchars($row['departure_date'], ENT_QUOTES);
	$flight_bill = htmlspecialchars($row['flight_bill'], ENT_QUOTES);
	$faa_bill = htmlspecialchars($row['faa_bill'], ENT_QUOTES);
	$cost = htmlspecialchars($row['total_cost'], ENT_QUOTES);

	echo '<tr>

	<td>' . $first_name . '</td>
	<td>' . $last_name . '</td>
	<td>' . $sex . '</td>
	<td>' . $age . '</td>
	<td>' . $address . '</td>
	<td>' . $email . '</td>
	<td>' . $seat_number . '</td>
	<td>' . $ticket_id . '</td>
	<td>' . $booking_mode . '</td>
	<td>' . $booking_date . '</td>

	<td>' . $flight_name . '</td>
	<td>' . $origin . '</td>
	<td>' . $destination . '</td>
	<td>' . $check_in_time . '</td>
	<td>' . $check_in_date . '</td>
	<td>' . $departure_time . '</td>
	<td>' . $departure_date . '</td>
	<td>' . $flight_bill . '</td>
	<td>' . $faa_bill . '</td>
	<td>' . $cost . '</td>
	</tr>';
	
	} // end of while statement

	echo '</table>';
	mysqli_free_result ($result); // Free up the resources.	
	
	}else { 
		$archive_booking = false;
	// Debugging message:
	//echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $query .'</p>'; 
	//Show $q is debug mode only
	} 


	// display the record msgs

	if($recent_booking === false and $archive_booking === false){

			echo "you have no booking record with us";
	}

} // try ends
catch(Exception $e) // We finally handle any problems here   
   {
     // print "An Exception occurred. Message: " . $e->getMessage();
     print "The system is busy please try later";
   }
   catch(Error $e)
   {
      //print "An Error occurred. Message: " . $e->getMessage();
      print "The system is busy please try again later.";
   }

?>