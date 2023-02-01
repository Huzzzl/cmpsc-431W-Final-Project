<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = 'zjh5265';
$password = 'Hzl0109309752';
$host = 'localhost';
$dbname = 'zjh5265_431W';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $sql = 'SELECT did, fname, mname, lname, spec, phone FROM doctors';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>PHP Hospital project</title>
    </head>
    <body>
        <div id="container">
            <h2>List of doctors</h2>
            <table border=1 cellspacing=5 cellpadding=5>
                <thead>
                    <tr>
                        <th>doctor ID</th>
                        <th>First name</th>
                        <th>Middle name</th>
                        <th>Last name</th>
                        <th>Specialization</th>
                        <th>phone number</th>
                        <th>Delete?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['did']); ?></td>
                            <td><?php echo htmlspecialchars($row['fname']) ?></td>
                            <td><?php echo htmlspecialchars($row['mname']); ?></td>
                            <td><?php echo htmlspecialchars($row['lname']); ?></td>
                            <td><?php echo htmlspecialchars($row['spec']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo '<form action="/delete.php" method="post"><input type="submit" value="DELETE"><input type="hidden" name="did" value="' . htmlspecialchars($row['did']) . '"></form>'; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
		<br><h2>Insert/Update a user:</h2>
		<form action="/insert_update.php" method="post">
			<table>
				<tr><td>doctor ID:</td><td><input type="text" id="did" name="did" value="required"></td></tr>
				<tr><td>First name:</td><td><input type="text" id="fname" name="fname" value="required"></td></tr>
				<tr><td>Middle name:</td><td><input type="text" id="mname" name="mname" value="optional"></td></tr>
				<tr><td>Last name:</td><td><input type="text" id="lname" name="lname" value="required"></td></tr>
				<tr><td>Specialization:</td><td><input type="text" id="spec" name="spec" value="required"></td></tr>
				<tr><td>Phone number:</td><td><input type="text" id="phone" name="phone" value="required"></td></tr>
			</table>
			<input type="submit" value="INSERT/UPDATE">
		</form>
		<br>
		<br><br><br>
		<br><h2>Bill printer:</h2>
		<form action="/billprint.php" method="post">
			<table>
				<tr><td>patient ID:</td><td><input type="text" id="pid" name="pid" value="required"></td></tr>
			</table>
			<input type="submit" value="GENERATE">
		</form>
		<br>
		<br><br><br>
		<br><h2>Medical history:</h2>
		<form action="/medicalhistory.php" method="post">
			<table>
				<tr><td>patient ID:</td><td><input type="text" id="pid" name="pid" value="required"></td></tr>
				<tr><td>description:</td><td><input type="text" id="history" name="history" value="describe medical hisotry"></td></tr>
			</table>
			<input type="submit" value="RECORD">
		</form>
		<br>
		<br><br><br>
		<br><h2>Depratment monthly income:</h2>
		<form action="/monthly income.php" method="post">
			<table>
				<tr><td>year:</td><td><input type="text" id="year" name="year" value="integer required"></td></tr>
				<tr><td>month:</td><td><input type="text" id="month" name="month" value="integer required"></td></tr>
				<tr><td>department:</td><td><input type="text" id="depart" name="depart" value="required"></td></tr>
			</table>
			<input type="submit" value="GENERATE">
		</form>
		<br>
		<br><br><br>
		<br><h2>Annual Bill report:</h2>
		<form action="/annul bill.php" method="post">
			<table>
				<tr><td>year:</td><td><input type="text" id="year" name="year" value="integer required"></td></tr>
			</table>
			<input type="submit" value="GENERATE">
		</form>
		<br>
		<br><br><br>
		<br><h2>Cancel appointment:</h2>
		<form action="/cancel.php" method="post">
			<table>
				<tr><td>bill ID:</td><td><input type="text" id="bid" name="bid" value="required"></td></tr>
			</table>
			<input type="submit" value="CANCEL">
		</form>
		<br>
		<br><br><br>
    </body>
</div>
</html>