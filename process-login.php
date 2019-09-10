<?php

try {
    // Validate the email address
// Check for an email address:

	$errors = array(); //initialise array

	$email = filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL);	
	if  ((empty($email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
		$errors[] = 'You forgot to enter your email address';
		$errors[] = ' or the e-mail format is incorrect.';
	}
    // Validate the password
	$password = filter_var( $_POST['password'], FILTER_SANITIZE_STRING);	
	if (empty($password)) {
		$errors[] = 'You forgot to enter your password.';
	}


   if (empty($errors)) { // If everything's OK.         #1
// Retrieve the user_id, psword, first_name and user_level for that
// email/password combination

   require ('mysqli_connect.php'); // Connect to the db.  

 $query = "SELECT user_id, password, user_name, user_level FROM users WHERE email=?";
      $q = mysqli_stmt_init($dbcon);
      mysqli_stmt_prepare($q, $query);

        // bind $id to SQL Statement
	  mysqli_stmt_bind_param($q, "s", $email); 

       // execute query
	   
       mysqli_stmt_execute($q);

$result = mysqli_stmt_get_result($q);

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
if (mysqli_num_rows($result) == 1) {
//if one database row (record) matches the input:-
// Start the session, fetch the record and insert the 
// values in an array 
if (password_verify($password, $row['password'])) {          //#2
session_start();								
// Ensure that the user level is an integer. 
$_SESSION['user_level'] = (int) $row['user_level'];
$_SESSION['user_name'] = $row['user_name'];
$_SESSION['user_id'] = (int) $row['user_id'];
// Use a ternary operation to set the URL             #3
$url = ($_SESSION['user_level'] === 1) ? 'admin.php' :
 'members-page.php'; 
header('Location: ' . $url); 
// Make the browser load either the members or the admin page
} else { // No password match was made.
$errors[] = 'E-mail/Password entered does not match our records. ';
$errors[] = 'Perhaps you need to register, just click the Register ';
$errors[] = 'button on the header menu';
echo mysqli_error($dbcon);
}
} else { // No e-mail match was made.
$errors[] = 'E-mail/Password entered does not match our records. ';
$errors[] = 'Perhaps you need to register, just click the Register ';
$errors[] = 'button on the header menu';
echo mysqli_error($dbcon);
}


} // if (empty($errors)) ends
if(!empty($errors)){                     
		$errorstring = "Error! <br /> The following error(s) occurred:<br>";
		foreach ($errors as $msg) { // Print each error.
			$errorstring .= " $msg<br>\n";
		}
		$errorstring .= "Please try again.<br>";
		echo "<p class=' text-center col-sm-2' style='color:red'>$errorstring</p>";
}// End of if (!empty($errors)) IF.


}//end of try
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