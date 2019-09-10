	<?php
			require 'url.php';
			
			if (isset($_POST['submit'])) {
				require 'process-search.php';
			}

	?>

	<h1>search for available flight</h1>
	<form action="<?php echo $url;?>" method="post">

		<label for="flight_name">flight name:</label><input type="text" name="flight_name" id = "flight_name">
		<label for="origin">origin:</label><input type="text" name="origin" id="origin">
		<label for="destination">destination</label><input type="text" name="destination" id="destination">
		<input type="submit" name="submit" id = "submit" value="search">
		
	</form>
