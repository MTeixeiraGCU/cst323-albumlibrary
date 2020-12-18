<!-- 
    registrationComplete.php
    This is an HTML page that notifies the user that they have successfully registered to the site.
 -->

<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/autoloader.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/header.php';
?>

<!DOCTYPE html>
<html>

	<head>
		<link rel="stylesheet" type="text/css" href="/presentation/css/style.css">
		<title>Registration</title>
	</head>
	
	<body>
		<div class="page-heading">
			<h2>Registration Successful, Proceed to Login!</h2>
			<a href="/index.php">Go to Login</a>
		</div>
		
	</body>
	
	
</html>