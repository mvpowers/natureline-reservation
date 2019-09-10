<?php

if (isset($_GET['flight_id'])) {
	$flight_id = htmlspecialchars($_GET['flight_id'], ENT_QUOTES);
}

try{
	require'mysqli_connect.php';

	$query = "SELECT * from bookings INNER JOIN flight ON bookings.flight_id = flight.flight_id WHERE bookings.flight_id = ?";	

		$q = mysqli_stmt_init($dbcon);
		mysqli_stmt_prepare($q, $query);
		mysqli_stmt_bind_param($q, 'i', $flight_id);	 
		mysqli_stmt_execute($q); 

		$result = mysqli_stmt_get_result($q);

	if (mysqli_num_rows($result) != 0) {

		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	// Remove special characters that might already be in table to 
	// reduce the chance of XSS exploits
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
	$user_id = htmlspecialchars($row['user_id'], ENT_QUOTES);
	//flight details
	$flight_id = htmlspecialchars($row['flight_id'], ENT_QUOTES);
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


	$query = "INSERT INTO users_archive (first_name, last_name, age, sex, booking_email, address, phone, ticket_id, seat_number, booking_mode, booking_date, user_id, flight_id, flight_name, origin, destination, check_in_time, check_in_date, departure_time, departure_date, flight_bill, faa_bill, total_cost) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";		                
        $q = mysqli_stmt_init($dbcon);                                  
        mysqli_stmt_prepare($q, $query);
        // use prepared statement to insure that only text is inserted
        // bind fields to SQL Statement
        mysqli_stmt_bind_param($q, 'ssissssiiisiisssssssiii', $first_name, $last_name, $age, $sex, $email, $address, $phone, $ticket_id, $seat_number, $booking_mode, $booking_date, $user_id, $flight_id, $flight_name, $origin, $destination, $check_in_time, $check_in_date, $departure_time, $departure_date, $flight_bill, $faa_bill, $cost);
     // execute query
        mysqli_stmt_execute($q);
        if (!(mysqli_stmt_affected_rows($q) == 1)) {	// if One is not record inserted			
			// Public message:
		    $errorstring = "<p class='text-center col-sm-8' style='color:red'>";
			$errorstring .= "System Error<br />You could not insert into our archive due ";
			$errorstring .= "to a system error.</p>"; 
			echo "<p class=' text-center col-sm-2' style='color:red'>$errorstring</p>";
			// Debugging message below do not use in production
			//echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $query . '</p>';
		// include footer then close program to stop execution
			echo '<footer class="jumbotron text-center col-sm-12"
	        style="padding-bottom:1px; padding-top:8px;">
            include("footer.php"); 
            </footer>';

            exit();
		}
	
	
	} // end of while statement



		$query = "DELETE FROM bookings WHERE flight_id = ?";		                
        $q = mysqli_stmt_init($dbcon);                                  
        mysqli_stmt_prepare($q, $query);
        // use prepared statement to insure that only text is inserted
        // bind fields to SQL Statement
        mysqli_stmt_bind_param($q, 'i', $flight_id);
     // execute query
        mysqli_stmt_execute($q);
        if (!(mysqli_stmt_affected_rows($q) >=1)) {	// One record deleted			
			// Public message:
		    $errorstring = "<p class='text-center col-sm-8' style='color:red'>";
			$errorstring .= "System Error<br />could not delete";
			$errorstring .= "due to a system error.</p>"; 
			echo "<p class=' text-center col-sm-2' style='color:red'>$errorstring</p>";
			// Debugging message below do not use in production
			//echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $query . '</p>';
		// include footer then close program to stop execution
			echo '<footer class="jumbotron text-center col-sm-12"
	        style="padding-bottom:1px; padding-top:8px;">
            include("footer.php"); 
            </footer>';
		} 
	
	}else { 
	echo "<p>problem fetching result, check if you selected the right flight</p>";
	// Debugging message:
	//echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $query . '</p>'; 
	//Show $q is debug mode only
	exit();
	} 

	header("location: archive-success.php");

} // try ends
catch(Exception $e) // We finally handle any problems here   
   {
     // print "An Exception occurred. Message: " . $e->getMessage();
     //print "The system is busy please try later";
   }
   catch(Error $e)
   {
      //print "An Error occurred. Message: " . $e->getMessage();
      //print "The system is busy please try again later.";
   }

?>