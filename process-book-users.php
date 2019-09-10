<?php

try {

	$errors = array(); // Initialize an error array. 
	                      
    $first_name = filter_var( $_POST['first_name'], FILTER_SANITIZE_STRING);	
	if (empty($first_name)) {
		$errors[] = 'You forgot to enter your first_name.';
	}

	$last_name = filter_var( $_POST['last_name'], FILTER_SANITIZE_STRING);	
	if (empty($last_name)) {
		$errors[] = 'You forgot to enter your last_name.';
	}

	$age = (int) $_POST['age'];	
	if (empty($age)) {
		$errors[] = 'You forgot to enter age';
	}


	$sex = filter_var( $_POST['sex'], FILTER_SANITIZE_STRING);	
	if (empty($sex)) {
		$errors[] = 'You forgot to enter sex.';
	}

	$email = filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL);	
	if  ((empty($email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
		$errors[] = 'You forgot to enter your email address';
		$errors[] = ' or the e-mail format is incorrect.';
	}

	$address = filter_var( $_POST['address'], FILTER_SANITIZE_STRING);	
	if (empty($address)) {
		$errors[] = 'You forgot to enter your address';
	}

	$phone = filter_var( $_POST['phone'], FILTER_SANITIZE_STRING);	
	if (empty($phone)) {
		$errors[] = 'You forgot to enter your phone.';
	}

	$booking_mode = (int) filter_var( $_POST['booking_mode'], FILTER_SANITIZE_STRING);	
	if (empty($booking_mode)) {
		$errors[] = 'You forgot to enter booking_mode';
	}

	$flight_id = (int) filter_var($flight_id, FILTER_SANITIZE_STRING);
	if (empty($flight_id)) {
		$errors[] = 'no flight_id';
	}

	$user_id = $_SESSION['user_id'];

	if (empty($errors)) { // If validation is OK.   

		require 'mysqli_connect.php'; 

		// get max_seat
		$query = "SELECT max_seat,total_cost from flight where flight_id = ?";
		$q = mysqli_stmt_init($dbcon);                                  
        mysqli_stmt_prepare($q, $query);
        mysqli_stmt_bind_param($q, 'i', $flight_id);
        mysqli_stmt_execute($q);
        $result = mysqli_stmt_get_result($q);

        if($result){
        	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$max_seat = $row['max_seat'];
			$total_cost = $row['total_cost'];
        }else{
        	echo mysqli_error($dbcon);
        	exit(); // to make sure the script exits when no set of result is returned
        }

        //get number of booked spaces
		$query = "SELECT COUNT(*) FROM bookings WHERE flight_id = ?"; 
		$q = mysqli_stmt_init($dbcon);                                  
        mysqli_stmt_prepare($q, $query);
        mysqli_stmt_bind_param($q, 'i', $flight_id);
        mysqli_stmt_execute($q);
        $result = mysqli_stmt_get_result($q);

        if(mysqli_num_rows($result) == 1){

     	 	$row = mysqli_fetch_array($result,MYSQLI_NUM);
			$booked_spaces = $row[0];
			$seat_number = $booked_spaces + 1;

        }else{
        	echo mysqli_error($dbcon);
        	exit(); // to make sure the script exits when no set of result is returned
        }

		if($booked_spaces < $max_seat){ // check if there is space remaining

				$_SESSION['first_name'] = $first_name;
				$_SESSION['last_name'] = $last_name;
				$_SESSION['age'] = $age;
				$_SESSION['sex'] = $sex;
				$_SESSION['email'] = $email;
				$_SESSION['address'] = $address;
				$_SESSION['phone'] = $phone;
				$_SESSION['seat_number'] = $seat_number;
				$_SESSION['booking_mode'] = $booking_mode;
				$_SESSION['flight_id'] = $flight_id;
				//session of user_id has already been created.

				// tracker
				$_SESSION['mytracker'] = true;

				require 'process-paystack.php'; 

		}  // end of check if there is space remaining
		else{

			//echo 'falure cus booked_spaces is ' .$booked_spaces .'and' .'max_seat is' .$max_seat;
			header("location: book-failed.php");
			exit();
		}


	} // end of if (empty($errors))
	else { // Report the errors.                             
		$errorstring = "Error! <br /> The following error(s) occurred:<br>";
		foreach ($errors as $msg) { // Print each error.
			$errorstring .= " - $msg<br>\n";
		}
		$errorstring .= "Please try again.<br>";
		echo "<p class=' text-center col-sm-2' style='color:red'>$errorstring</p>";
		}// End of if (empty($errors)) IF.
		}							
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