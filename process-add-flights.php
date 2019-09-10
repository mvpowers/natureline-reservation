<?php

// This script is a query that INSERTs a record in the users table.
// Check that form has been submitted:
try {

	
	$errors = array(); // Initialize an error array. 
	                    
    $flight_name = filter_var( $_POST['flight_name'], FILTER_SANITIZE_STRING);	
	if (empty($flight_name)) {
		$errors[] = 'You forgot to enter flight name.';
	}

	 $origin = filter_var( $_POST['origin'], FILTER_SANITIZE_STRING);	
	if (empty($origin)) {
		$errors[] = 'You forgot to enter origin.';
	}

	$destination = filter_var( $_POST['destination'], FILTER_SANITIZE_STRING);	
	if (empty($destination)) {
		$errors[] = 'You forgot to enter origin.';
	}

	$check_in_time = $_POST['check_in_time'];

	if (empty($check_in_time)) {
		$errors[] = 'You forgot to enter check_in_time';
	}

	$check_in_date = $_POST['check_in_date'];

	if (empty($check_in_date)) {
		$errors[] = 'You forgot to enter check_in_time';
	}

	$departure_time = $_POST['departure_time'];

	if (empty($departure_time)) {
		$errors[] = 'You forgot to enter departure_time';
	}

	$departure_date = $_POST['departure_date'];

	if (empty($departure_date)) {
		$errors[] = 'You forgot to enter departure_date';
	}


	$flight_bill = (double) $_POST['flight_bill'];

	if (empty($flight_bill)) {
		$errors[] = 'You forgot to enter the flight_bill';
	}


	$faa_bill = (double) $_POST['faa_bill'];

	if (empty($faa_bill)) {
		$errors[] = 'You forgot to enter the faa_bill';
	}

	$total = $flight_bill + $faa_bill;

	if ($total < 250) {
		$errors[]  = 'paystack collects 250 naira for this transaction';
	}

	$max_seat = (int) $_POST['max_seat'];

	if (empty($max_seat)) {
		$errors[] = 'You forgot to enter the max_seat';
	}

	$status = filter_var( $_POST['status'], FILTER_SANITIZE_STRING);	
	if (empty($status)) {
		$errors[] = 'You forgot to enter the status';
	}

	
	if (empty($errors)) { // If everything's OK.  
	
		require ('mysqli_connect.php'); // Connect to the db.     
		// Make the query:                                               
		$query = "INSERT INTO flight (flight_name, origin, destination, check_in_time,check_in_date, departure_time, departure_date, max_seat, flight_bill, faa_bill, total_cost, status) ";
		$query .="VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";		                
        $q = mysqli_stmt_init($dbcon);                                  
        mysqli_stmt_prepare($q, $query);
        // use prepared statement to insure that only text is inserted
        // bind fields to SQL Statement
        mysqli_stmt_bind_param($q, 'sssssssiddds', $flight_name, $origin, $destination, $check_in_time, $check_in_date, $departure_time, $departure_date, $max_seat, $flight_bill, $faa_bill, $total, $status);
     // execute query
        mysqli_stmt_execute($q);
        if (mysqli_stmt_affected_rows($q) == 1) {
        	header("location: flight-added.php");
		exit();
		}else{
			echo mysqli_error($dbcon);
		}

	} else{

		echo "<h1>there are still errors</h1>";

			foreach ($errors as $value) {
				echo "<h3>$value</h3>";
			}
		} // end of try								
	}
   catch(Exception $e) // We finally handle any problems here   
   {
      print "An Exception occurred. Message: " . $e->getMessage();
     print "The system is busy please try later";
   }
   catch(Error $e)
   {
     // print "An Error occurred. Message: " . $e->getMessage();
      print "The system is busy please try again later.";
   }

?>