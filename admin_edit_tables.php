<?php
//done
if (!defined('INSIDE_ADMIN')) {
    // Prevent direct access from the URL
    header("Location: index.php");
    exit();
}

$mysqli = new mysqli("localhost", "root", "", "ecom_db");


// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM users_tb WHERE id=$id");

}

// Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $registration_time = $_POST['registration_time'];
    $registration_name = $_POST['registration_name'];
	$email = $_POST['email'];
	$Activate_user= $_POST['Activate_user'];
    $mysqli->query("UPDATE users_tb SET Activate_user='$Activate_user', registration_nickname='$registration_name',registration_time='$registration_time', email='$email' WHERE id=$id");
}
// Fetch user if editing
$edit_user = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $mysqli->query("SELECT * FROM users_tb WHERE id=$id");
    $edit_user = $result->fetch_assoc();
}
////////////////////////////

// Delete
if (isset($_GET['delete2'])) {
    $id2 = $_GET['delete2'];
	$mysqli->query("DELETE FROM products_tb WHERE id=$id2");

}
// Update
if (isset($_POST['update2'])) {
    $id2 = $_POST['id2'];
    $name2 = $_POST['name2'];
    $description2 = $_POST['description2'];
    $price2 = $_POST['price2'];
	 $stok2 = $_POST['stok2'];
    $type2 = $_POST['type2'];
    $size2 = $_POST['size2'];
	$mysqli->query("UPDATE products_tb SET type='$type2', size='$size2', name='$name2', description='$description2',price='$price2', stok='$stok2' WHERE id=$id2");
//$mysqli->query("UPDATE products_tb SET type='$type2', size='$size2' WHERE id=$id2");

}
// Fetch user if editing
$edit_user2 = null;
if (isset($_GET['edit2'])) {
    $id2 = $_GET['edit2'];
    $result2 = $mysqli->query("SELECT * FROM products_tb WHERE id=$id2");
    $edit_user2 = $result2->fetch_assoc();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP Table CRUD</title>
</head>
<body>
<h2>Users Table</h2>

<table border="1">
    <tr><th>registration_time</th><th>Name</th><th>Email</th><th>Activate_user</th><th>Action</th></tr>
    <?php
    $result = $mysqli->query("SELECT * FROM users_tb");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['registration_time']}</td>
            <td>{$row['registration_nickname']}</td>
            <td>{$row['email']}</td>
			<td>{$row['Activate_user']}</td>
            <td>
                <a href='?page=admin_edit_tables&edit={$row['id']}'>Edit</a> |
                <a href='?page=admin_edit_tables&delete={$row['id']}'>Delete</a>
            </td>
        </tr>";
    }
    ?>
</table>
<br>
<?php if ($edit_user): ?>
<h3>Edit User</h3>
<form method="post"action="product.php?page=admin_edit_tables">
    <input type="hidden" name="id" value="<?= $edit_user['id'] ?>">
	<b>Activate user:</b> <select name="Activate_user" id="Activate_user">
      <option value="1">Yes</option>
      <option value="0">No</option>
	  </select>
	  <br>
    Name: <input type="text" name="registration_name" value="<?= $edit_user['registration_nickname'] ?>"><br>
    Email: <input type="text" name="email" value="<?= $edit_user['email'] ?>"><br>
	register time: <input type="text" name="registration_time" value="<?= $edit_user['registration_time'] ?>"><br>
	
    <input type="submit" name="update" value="Update">
</form>
<?php endif; ?>


<br>
<?php if ($edit_user2): ?>
<h3>Edit Product</h3>
<form method="post" action="product.php?page=admin_edit_tables">
    <input type="hidden" name="id2" value="<?= $edit_user2['id'] ?>">
	name: <input type="text" name="name2" value="<?= $edit_user2['name'] ?>"><br>
    description: <input type="text" name="description2" value="<?= $edit_user2['description'] ?>"><br>
    price: <input type="text" name="price2" value="<?= $edit_user2['price'] ?>"><br>
	quantity: <input type="stok2" name="stok2" value="<?= $edit_user2['stok'] ?>"><br>
    type: <select name="type2"><br>
	      <option value="Sun">Sun cream</option>
      <option value="Serum">Serum set</option>
      <option value="Face">Face product</option>
	  	      <option value="Cleanser">Cleanser</option>
	      <option value="Body">Body lotion</option>
		  	      <option value="Background">Background</option>
	      <option value="banner">banner</option>

    </select><br>
	Size:<select name="size2" id="size2">
      <option value="100">100ml</option>
      <option value="150">150ml</option>
      <option value="200">200ml</option>
      <option value="250">250ml</option>
	</select>
	<br>
    <input type="submit" name="update2" value="Update">
</form>
<?php endif; ?>

<h2>Products Table</h2>

<table border="1">
    <tr><th>Name</th><th>Description</th><th>Price</th><th>Quantity</th><th>Type</th><th>Size</th></tr>
    <?php
    $result2 = $mysqli->query("SELECT * FROM products_tb");
    while ($row2 = $result2->fetch_assoc()) {
        echo "<tr>
            <td>{$row2['name']}</td>
            <td>{$row2['description']}</td>
            <td>{$row2['price']}</td>
			<td>{$row2['stok']}</td>
            <td>{$row2['type']}</td>
            <td>{$row2['size']}</td>
            <td>
                <a href='?page=admin_edit_tables&edit2={$row2['id']}'>Edit</a> |
                <a href='?page=admin_edit_tables&delete2={$row2['id']}'>Delete</a>
            </td>
        </tr>";
    }
    ?>
</table>
</body>
</html>
