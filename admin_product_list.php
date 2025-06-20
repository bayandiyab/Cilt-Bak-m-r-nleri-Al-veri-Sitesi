<?php
if (!defined('INSIDE_ADMIN')) {
    header("Location: index.php");
    exit();
} else {
    $conn = new mysqli('localhost', 'root', '', 'ecom_db');
    $sql2 = "SELECT * FROM products_tb";
    $result2 = $conn->query($sql2);
}
?>
<h2>Warehouse products</h2><br>

<input type="text" id="searchInput" placeholder="search for product.." style="padding:8px; width:250px; margin-top:20px;">

<table id="productsTable" border="1" cellpadding="10" cellspacing="0">
<tr>
    <th>ID</th>
    <th>Product name</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Type</th>
    <th>Size</th>
    <th>Available time</th>
</tr>
<?php while ($product = $result2->fetch_assoc()): ?>
<tr>
    <td><?= $product['id'] ?></td>
    <td><?= $product['name'] ?></td>
    <td><?= $product['price'] ?></td>
    <td><?= $product['stok'] ?></td>
    <td><?= $product['type'] ?></td>
    <td><?= $product['size'] ?></td>
    <td><?= $product['created_at'] ?></td>
</tr>
<?php endwhile; ?>
</table>

<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('#productsTable tr:not(:first-child)');
    rows.forEach(function(row) {
        let productName = row.cells[1].textContent.toLowerCase();
        if (productName.includes(filter)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>
