<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = 'zjh5265';
$password = 'Hzl0109309752';
$host = 'localhost';
$dbname = 'zjh5265_431W';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>PHP Hospital project</title>
    </head>
    <body>
		<p>
			<?php 
				echo "Canceling The appointment of bill: " . $_POST["bid"] . " ..."; 
				$sql = 'UPDATE bill SET arrive = 'N', charge = 5 WHERE bid = " . $_POST["bid"] . "';
				try {
					$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$conn->exec($sql);
					echo "Appointment Canceled successfully";
			?>
				<p>You will be redirected in 3 seconds</p>
				<script>
					var timer = setTimeout(function() {
						window.location='start.php'
					}, 3000);
				</script>
			<?php
				} catch(PDOException $e) {
					echo $sql . "<br>" . $e->getMessage();
				}
				$conn = null;
			?>
		</p>
    </body>
</div>
</html>