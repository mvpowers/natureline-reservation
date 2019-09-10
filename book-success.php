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
	<title></title>
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

<section>
	<?php



			$curl = curl_init();

			if (isset($_GET['reference']) and $_SESSION['mytracker'] == true) {

					$reference = $_GET['reference'];

					curl_setopt_array($curl, array(
					  CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_HTTPHEADER => [
					    "accept: application/json",
					    "authorization: Bearer ", // key here
					    "cache-control: no-cache"
					  ],
					));

					$response = curl_exec($curl);
					$err = curl_error($curl);

					if($err){
						// there was an error contacting the Paystack API
					  die('Curl returned error: ' . $err .' kindly refresh the browser');
					}

					$tranx = json_decode($response);

					if(!$tranx->status){
					  // there was an error from the API
					  die('API returned error: ' . $tranx->message .' kindly refresh the browser');
					}

					if('success' == $tranx->data->status){

					  // transaction was successful...
					  // please check other things like whether you already gave value for this ref
					  // if the email matches the customer who owns the product etc
					  // Give value

							$ticket_id = $reference;    //recall that this is unique on the database
							$first_name = $_SESSION['first_name'];
							$last_name = $_SESSION['last_name']; 
							$age = $_SESSION['age'];
							$sex = $_SESSION['sex'];
							$email = $_SESSION['email'];
							$address = $_SESSION['address'];
							$phone = $_SESSION['phone'];
							$seat_number = $_SESSION['seat_number'];
							$booking_mode = $_SESSION['booking_mode'];
							$flight_id = $_SESSION['flight_id'];

							//variable $user_id has already been created.

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


				        //  get number of booked spaces

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

							$query = "INSERT INTO bookings (first_name, last_name, age, sex, booking_email, address, phone, ticket_id, seat_number, booking_mode, flight_id, user_id, booking_date ) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,NOW())";		                
					        $q = mysqli_stmt_init($dbcon);                                  
					        mysqli_stmt_prepare($q, $query);
					        mysqli_stmt_bind_param($q, 'ssisssssiiii', $first_name, $last_name, $age, $sex, $email, $address, $phone, $ticket_id, $seat_number, $booking_mode, $flight_id, $user_id);
					        mysqli_stmt_execute($q);

					        if (mysqli_stmt_affected_rows($q) == 1) {	// One record inserted
									
						        	/*
						        	checks to see if the new booked spaces is >= to max seat..if so change the flight status to 'not available'
						        	*/
						        	
								$query = "SELECT COUNT(*) FROM bookings WHERE flight_id = ?"; 
								$q = mysqli_stmt_init($dbcon);                                  
						        mysqli_stmt_prepare($q, $query);
						        mysqli_stmt_bind_param($q, 'i', $flight_id);
						        mysqli_stmt_execute($q);
						        $result = mysqli_stmt_get_result($q);

						        if(mysqli_num_rows($result) == 1){

						     	 	$row = mysqli_fetch_array($result,MYSQLI_NUM);
									$booked_spaces = $row[0];

										if ($booked_spaces >= $max_seat) {  // leave the '>' sign cuz developer can overbook the space left
										
											$new_status = 'not available';
											$query = "UPDATE flight SET status = ?";
											$q = mysqli_stmt_init($dbcon);
											mysqli_stmt_prepare($q, $query);
											mysqli_stmt_bind_param($q, 's', $new_status);
						        			mysqli_stmt_execute($q);

						        			if (mysqli_stmt_affected_rows($q) != 1) {
						        				echo mysqli_error($dbcon);
						        			}
										}
						        }

								echo "<h1>booking successful : we have sent your reference to the email you provided for booking... you can also view your ticket id from view booking link in your account page.. thank you for choosing nature line<h1>";
								$_SESSION['mytracker'] = false;
								$_SESSION['first_name'] = '';
								$_SESSION['last_name'] = '';
								$_SESSION['age'] = '';
								$_SESSION['sex'] = '';
								$_SESSION['email'] = '';
								$_SESSION['address'] = '';
								$_SESSION['phone'] = '';
								$_SESSION['seat_number'] = '';
								$_SESSION['booking_mode'] = '';
								$_SESSION['flight_id'] = '';

							} else { // If there was no booking.
							// Public message:
							    $errorstring = "<p class='text-center col-sm-8' style='color:red'>";
								$errorstring .= "System Error<br />You could not be book due ";
								$errorstring .= "to a system error. We apologize for any inconvenience. please refresh your browser</p>"; 
								echo "<p class=' text-center col-sm-2' style='color:red'>$errorstring</p>";
								// Debugging message below do not use in production
								echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $query . '</p>';
							    mysqli_close($dbcon); // Close the database connection.
							// include footer then close program to stop execution
								echo '<footer class="jumbotron text-center col-sm-12"
						        style="padding-bottom:1px; padding-top:8px;">
					            include("footer.php"); 
					            </footer>';
							
							}			

					}  // end of check if there is space remaining
					else{

						echo 'falure cus booked_spaces is ' .$booked_spaces .'and' .'max_seat is' .$max_seat;
						echo "we will refund your money in two days";
						//header("location: book-failed.php");
						exit();
					}
							
			}//end of the if success statement

		} // end of checking reference and if the user have completed the first booking stage
		elseif(!$_SESSION['mytracker'] == true) {
			echo "page accessed in error  or <br> you might have booked successfully, kindly check your bookings or your email";
			exit();
		}else{
			echo "there is no reference_id";
			exit();
		}		

	?>
</section>

</body>
</html>