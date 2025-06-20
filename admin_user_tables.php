<?php
//done
if (!defined('INSIDE_ADMIN')) {
    // Prevent direct access from the URL
    header("Location: index.php");
    exit();
}else{
$conn = new mysqli('localhost', 'root', '', 'ecom_db');
$sql = "SELECT * FROM users_tb ORDER BY id";
$result = $conn->query($sql);

$sql2 = "SELECT * FROM products_tb";
$result2 = $conn->query($sql2);
}

?>
	    <h2>Users Table</h2>
	<table>
<tr><th>Name</th><th>Registration time</th><th>Email</th><th>Credit owner name</th><th>Credit number</th></tr>
<?php while ($user = $result->fetch_assoc()): ?>
<tr>
    <td><?= $user['registration_nickname'] ?></td>

    <td><?= $user['registration_time'] ?></td>
    <td><?= $user['email'] ?></td>
	    <td><?= $user['credit_owner'] ?></td>
		    <td><?= $user['credit_number'] ?></td>
</tr>
<?php endwhile; ?>
</table>