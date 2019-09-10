<?php
try
{
                        
require_once('./mysqli_connect.php'); 

function status($status , $flight_id){  // to the link
			if ($status == 'available') {
				$string = '<a href="book.php?flight_id=' . $flight_id . '">book flight</a>';
			}else{
				$string = '';
			}
			return $string;
		}

function archive($flight_id){

	if (isset($_SESSION['user_level']) AND ($_SESSION['user_level'] == 1) ) {
		$string = '<a href="process-archive.php?flight_id=' . $flight_id . '">archive</a>';
	}else{
		$string = '';
	}
	return $string;
}


function edit_flight($flight_id){

	if (isset($_SESSION['user_level']) AND ($_SESSION['user_level'] == 1) ) {
		$string = '<a href="edit-flight.php?flight_id=' . $flight_id . '">edit</a>';
	}else{
		$string = '';
	}
	return $string;
}



$flight_name = htmlspecialchars($_POST['flight_name'], ENT_QUOTES);
$origin = htmlspecialchars($_POST['origin'], ENT_QUOTES);
$destination = htmlspecialchars($_POST['destination'], ENT_QUOTES);
$query = "SELECT flight_id, flight_name, origin, destination, check_in_time,check_in_date, departure_time, departure_date,total_cost, status , flight_bill, faa_bill FROM flight where flight_name=? OR origin=? OR destination =?";	
$q = mysqli_stmt_init($dbcon);
mysqli_stmt_prepare($q, $query);
mysqli_stmt_bind_param($q, 'sss', $flight_name, $origin, $destination);
mysqli_stmt_execute($q); 

$result = mysqli_stmt_get_result($q);

if (mysqli_num_rows($result) != 0) {

// If it ran, display the records.
// Table header.
echo '<table class="table table-striped">
<tr>
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
<th>status</th>
<th>book</th>
<th></th>
<th></th>
</tr>';	
// Fetch and display the records:
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	// Remove special characters that might already be in table to 
	// reduce the chance of XSS exploits
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
	$status = htmlspecialchars($row['status'], ENT_QUOTES);
	$flight_id = htmlspecialchars($row['flight_id'], ENT_QUOTES);



	// <td><a href="edit_user.php?id=' . $user_id . '">Edit</a></td>  use query string book flight
	echo '<tr>
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
	<td>' . $status . '</td>
	<td>' . status($status , $flight_id) . '</td>
	<td>' . archive($flight_id) . '</td>
	<td>' . edit_flight($flight_id) . '</td>
	</tr>';
	}
	echo '</table>'; // Close the table.                                                           
	mysqli_free_result ($result);	

}
else { 

	echo '<p class="center-text">the flight you entered is not ready or does not exist.';
	echo ' We apologize for any inconvenience.</p>';
	
	// Debugging message:
	//echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>'; 
	//Show $q is debug mode only
} // End of if ($result). Now display the total number of records/members.
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