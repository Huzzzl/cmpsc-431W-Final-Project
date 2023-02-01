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
    $sql = 'SELECT b.bid, b.date, p.iid, GROUP_CONCAT(DISTINCT d.fname), GROUP_CONCAT(DISTINCT d.lname), b.charge, p.fname, p.lname FROM doctors d, bill_doctor bd, bill b, patients p
WHERE d.did = bd.did
AND bd.bid = b.bid
AND b.pid = p.pid
AND p.pid = "' . $_POST["pid"] . '"
GROUP BY b.bid, b.date, p.iid, p.iid, b.charge, p.fname, p.lname;
';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bill printer>
    </head>
    <body>
        <div id="container">
            <h2>Bill of "' . $_POST["pid"] . '"</h2>
            <table border=1 cellspacing=5 cellpadding=5>
                <thead>
                    <tr>
                        <th>bill id</th>
                        <th>date</th>
                        <th>insurance id</th>
                        <th>doctor first name</th>
                        <th>doctor last name</th>
                        <th>charge amount</th>
                        <th>patient first name</th>
                        <th>patient last name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['b.bid']); ?></td>
                            <td><?php echo htmlspecialchars($row['b.date']) ?></td>
                            <td><?php echo htmlspecialchars($row['GROUP_CONCAT(DISTINCT d.fname)']); ?></td>
                            <td><?php echo htmlspecialchars($row['GROUP_CONCAT(DISTINCT d.lname)']); ?></td>
                            <td><?php echo htmlspecialchars($row['b.charge']); ?></td>
                            <td><?php echo htmlspecialchars($row['p.fname']); ?></td>
                            <td><?php echo htmlspecialchars($row['p.lname']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
		<form action="/start.php" method="post">
			</table>
			<input type="submit" value="back">