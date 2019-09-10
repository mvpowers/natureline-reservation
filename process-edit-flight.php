<?php

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


		$query = "UPDATE flight SET flight_name=?, origin=?, destination=?, check_in_time=?, check_in_date=?, departure_time=?, departure_date=?, max_seat=?, status=?, flight_bill=?, faa_bill=?, total_cost=? WHERE flight_id = ?";		                
        $q = mysqli_stmt_init($dbcon);                                  
        mysqli_stmt_prepare($q, $query);
        // use prepared statement to insure that only text is inserted
        // bind fields to SQL Statement
        mysqli_stmt_bind_param($q, 'sssssssisdddi', $flight_name, $origin, $destination, $check_in_time, $check_in_date, $departure_time, $departure_date, $max_seat, $status, $flight_bill, $faa_bill, $total, $flight_id);
     // execute query
        mysqli_stmt_execute($q);
        if (mysqli_stmt_affected_rows($q) == 1) {
		   
        		echo '<h1 style = "color:green;">flight updated</h1>';
            
		}else{

			$errorstring = "<p class='text-center col-sm-8' style='color:red'>";
			$errorstring .= "System Error<br />You could not update due to";
			$errorstring .= "a system error.<br>"; 
			$errorstring .="or <br>";
			$errorstring .=" there was not a single change made to the previous details of the flight this is a common sql bug when update returns 0</p>";
			echo "<p class=' text-center col-sm-2' style='color:red'>$errorstring</p>";
			// Debugging message below do not use in production

			
			echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $query . '</p>';
		}


	}// if empty error array ends
	else{

		echo "<h1>there are still errors</h1>";

			foreach ($errors as $value) {
				echo "<h3 style = 'color:red;'>$value</h3>";
			}
		}

	} catch (Exception $e) {

		print "The system is currently busy. Please try later.";
		//print "An Exception occurred.Message: " . $e->getMessage();
		
	}catch (Error $e) {

		print "The system is currently busy. Please try later.";
		//print "An Exception occurred.Message: " . $e->getMessage();
		
	}

?>