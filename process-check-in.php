<?php
try
{
// This script retrieves records from the users table.                         
require ('./mysqli_connect.php'); // Connect to the db.

$ticket_id = filter_var($_POST['ticket_id'] , FILTER_SANITIZE_STRING);

// Since it's a prepared statement below this sanitizing is not needed
// However, to consistantly retrieve than sanitize is a good habit
$query = "SELECT * from bookings INNER JOIN flight ON bookings.flight_id = flight.flight_id WHERE ticket_id =?";	
// Prepared statement not needed because string is hard coded
$q = mysqli_stmt_init($dbcon);
mysqli_stmt_prepare($q, $query);

// bind values to SQL Statement
mysqli_stmt_bind_param($q, 's', $ticket_id);

// execute query	 
mysqli_stmt_execute($q); 

$result = mysqli_stmt_get_result($q);

if (mysqli_num_rows($result) != 0) {

// If it ran, display the records.
// Table header.
echo '<table class="table table-striped">
<tr>
<th>first name</th>
<th>last name</th>
<th>sex</th>
<th>age</th>
<th>seat number</th>
<th>booking mode</th>
<th>booking date</th>
<th>flight name</th>
<th>origin</th>
<th>destination</th>
<th>check_in_time</th>
<th>check_in_date</th>
<th>departure_time</th>
<th>departure_date</th>
<th>total cost</th>
</tr>';	
// Fetch and display the records:
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	// Remove special characters that might already be in table to 
	// reduce the chance of XSS exploits
	$first_name = htmlspecialchars($row['first_name'], ENT_QUOTES);
	$last_name = htmlspecialchars($row['last_name'], ENT_QUOTES);
	$sex = htmlspecialchars($row['sex'], ENT_QUOTES);
	$age = htmlspecialchars($row['age'], ENT_QUOTES);
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
	$cost = htmlspecialchars($row['total_cost'], ENT_QUOTES);

	echo '<tr>

	<td>' . $first_name . '</td>
	<td>' . $last_name . '</td>
	<td>' . $sex . '</td>
	<td>' . $age . '</td>
	<td>' . $seat_number . '</td>
	<td>' . $booking_mode . '</td>
	<td>' . $booking_date . '</td>

	<td>' . $flight_name . '</td>
	<td>' . $origin . '</td>
	<td>' . $destination . '</td>
	<td>' . $check_in_time . '</td>
	<td>' . $check_in_date . '</td>
	<td>' . $departure_time . '</td>
	<td>' . $departure_date . '</td>
	<td>' . $cost . '</td>
	</tr>';
	}
	echo '</table>'; // Close the table.
	//                                                            
	mysqli_free_result ($result); // Free up the resources.	

}
else { // If it did not run OK.
// Public message:
	echo "<p>pasenger with such ticket-id does not exist</p>";
	// Debugging message:
	//echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>'; 
	//Show $q is debug mode only
} // End of if ($result). Now display the total number of records/members.
mysqli_close($dbcon); // Close the database connection.
}
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