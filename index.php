<?php



if( $_POST ) {

	if( $_POST['send_wishes'] ) {
	// Require the main classes
	require('include/class.api.php');
	require('include/class.send.php');

	// Declare all classes
	$api = new API_Calls();
	$sendMessage = new Send_Message();

	// Get data from API
	$employees = $api->getEmployeeList();
	$exclusions = $api->getExclusionList();

	foreach ($employees as $employee) :

		// Send only to employees not in exclusion list
		if( ! in_array($employee->id, $exclusions) ){ 

			// Check if employee has left company
			if( $employee->employmentEndDate == null ) {

				$now = new DateTime(); // Get now date
				$startDate = new DateTime($employee->employmentStartDate); // Get Employee Start Date
				$dob = new DateTime($employee->dateOfBirth); // Get employee Date of Birth

				$testDate = new DateTime('2016-06-01');

				// Check to see if employee has started working or not
				if( $startDate < $now ){

					//Send Birthday Wish
					if( $now->format('m') == $dob->format('m') && $now->format('Y') == $dob->format('Y') )
						$sendMessage->send_birthday_wish( $employee->name, $employee->lastname );

					//Send Anniversary Wish
					if( $testDate->format('m') == $startDate->format('m') && $testDate->format('Y') == $startDate->format('Y') )
						$sendMessage->send_anniversary( $employee->name, $employee->lastname );
					//echo (date('L', strtotime(date('2016-01-01'))) ? 'Yes' : 'No');
				}
			}
		}
		
	endforeach;
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
		<form method="post" action="">
			<input type="submit" name="send_wishes" value="Send Wishes">
		</form>
</body>
</html>





 	