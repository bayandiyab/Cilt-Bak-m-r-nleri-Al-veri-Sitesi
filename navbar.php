<!-- navbar.php -->
<div class="navbar-top">
    <div class="containerr">
    <a href="index.php" class="logo">BAKIM IŞIĞI</a>
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="🔍Search product name..">
        </div>
        <div class="iconss">
            <?php if (isset($_SESSION['id'])): ?>	
			<a href="logout.php"  title="Çıkış yap" onclick="return confirm('Are you sure you want to log out?')">🚪</a>
            <a href="favorites.php">❤️</a>
            <a href="cart.php">🛒</a>
	<?php else: ?>
		<a href="admin.php" title="Admin Giriş">🔑</a>
		<a href="login.php" title=" Giriş yap">👤</a>
    <?php endif; ?>
        </div>
    </div>
</div>

<!-- Main nav menu -->
<div class="container">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="category.php?type=sun">Cream</a></li>
        <li><a href="category.php?type=cleanser">Cleansers</a></li>
        <li><a href="category.php?type=serum">Serum</a></li>
        <li><a href="category.php?type=body">Body</a></li>
        <li><a href="category.php?type=face">Face</a></li>
    </ul>
</div>