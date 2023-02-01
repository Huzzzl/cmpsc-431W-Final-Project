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
				$exists = 0;
				$sql = 'SELECT did FROM doctors WHERE did = "' . $_POST["did"] . '"';				$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
				$q = $conn->query($sql);
				$q->setFetchMode(PDO::FETCH_ASSOC);

				if($row = $q->fetch()) {
					$exists = 1;
				}
				else {
					$exists = 0;
				}
				$conn = null;

                        if ($exists){
					echo "Updating user: " . $_POST["did"] . " " . $_POST["fname"] . " " . $_POST["mname"] . " " . $_POST["lname"] . " " . $_POST["spec"] . " " . $_POST["phone"] . "..."; 
					$sql = 'UPDATE doctors SET fname = "' . $_POST["fname"] . '", mname=  "' . $_POST["mname"] . '", lname ="'.$_POST["lname"] . '", spec = "'.$_POST["spec"] . '", phone = "'.$_POST["phone"] . '" WHERE did = "'.$_POST["did"] . '" ';
					try {
						$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$conn->exec($sql);
						echo "Doctor updated successfully";
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
				}
				else {
					echo "Inserting new doctor: " . $_POST["did"] . " " . $_POST["fname"] . " " . $_POST["mname"] . " " . $_POST["lname"] . " " . $_POST["spec"] . " " . $_POST["phone"] . "..."; 
					$sql = 'INSERT INTO doctors (did, fname, mname, lname, spec, phone) ';
					$sql = $sql . 'VALUES ("'.$_POST["did"] . '","' . $_POST["fname"] . '","' . $_POST["mname"] . '","'.$_POST["lname"] . '","'.$_POST["spec"] . '","'.$_POST["phone"] . '")';
					try {
						$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$conn->exec($sql);
						echo "Doctor inserted successfully";
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
				}
			?>
		</p>
    </body>
</div>
</html>