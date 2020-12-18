<!-- 
    albumAdded.php
    This file is an HTML page notifying the user that they have added a new album to thier library.
 -->

<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/autoloader.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/header.php';
?>

<!DOCTYPE html>
<html>

	<head>
		<link rel="stylesheet" type="text/css" href="/presentation/css/style.css">
		<title>Album Added</title>
	</head>
	
	<body>
		<div class="page-heading">
			<?php 
			if(isset($_GET['AlbumName'])) {
			    echo "<h2>" . $_GET['AlbumName'] .  " has been added to your library!</h2>";
			} else {
			    echo "<h2>Could not add album to your library!</h2>";
			}
			?>
			<a href="/presentation/view/library.php">Return to Library</a>
		</div>
		
	</body>
	
	
</html>