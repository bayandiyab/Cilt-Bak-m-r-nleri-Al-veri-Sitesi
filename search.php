<?php
$conn = new mysqli("localhost", "root", "", "ecom_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = isset($_GET['q']) ? trim($_GET['q']) : '';

$stmt = $conn->prepare("SELECT * FROM products_tb WHERE name LIKE ?");
$like = "%" . $search . "%";
$stmt->bind_param("s", $like);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search: <?= htmlspecialchars($search) ?></title>
    <link rel="stylesheet" href="searches.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<h2 style="text-align:center; padding-top: 20px;">Search Results for “<?= htmlspecialchars($search) ?>”</h2>

<?php if ($result->num_rows === 0): ?>
    <p style="text-align: center; margin: 40px;">No products found matching “<?= htmlspecialchars($search) ?>”.</p>
<?php else: ?>
           <div class="container">
	<?php
$rows = [];
while($product = $result->fetch_assoc()): 
    $rows[] = [
        'image' => $product['image'],
        'price' => $product['price'] . ' TL'
    ];
?>
    <div class="product">
        <div class="icons">
		<button class="icon-btn fav-btn" onclick="saveToFavorites('<?= $product['image'] ?>', '<?= $product['name'] ?>', '$<?= $product['price'] ?>')">❤️</button>
   
        </div>
        <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
        <h3 class="product-name"><?= $product['name'] ?></h3>
        <p class="price">$<?= $product['price'] ?></p>
		<button class="details-btn" onclick="window.location.href='details.php?id=<?= $product['id']; ?>';">Detaylar 🔍</button>
    </div>

<?php endwhile; ?>
  </div>

  
  
<?php endif; ?>

   <div id="notification" class="notification"></div>
    

    <script src="assets/js/javascript.js">
    </script>

</body>

</html>