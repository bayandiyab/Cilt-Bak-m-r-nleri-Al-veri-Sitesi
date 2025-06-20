<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ecom_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$type = isset($_GET['type']) ? $_GET['type'] : '';
$type_safe = htmlspecialchars($type);

$sql = "SELECT * FROM products_tb WHERE type = ? ORDER BY id DESC LIMIT 8";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $type);
$stmt->execute();
$result = $stmt->get_result();
//

$sql2 = "SELECT * FROM products_tb WHERE type = ? ORDER BY id DESC LIMIT 20 OFFSET 8";
$stmt = $conn->prepare($sql2);
$stmt->bind_param("s", $type);
$stmt->execute();
$result2 = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="tr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakım Işığı</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
     <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>         :root {
            --salmon-pink: #ff7675;
            --eerie-black: #262626;
            --fs-7: 18px;
            --border-radius-medium: 10px;
        }

       
        html,
        body {
            overflow-x: hidden;
            margin: 50px auto;
            padding: 0;
            width: 100%;
          
        }

        nav {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: transparent;
            /* شفاف في البداية */
            box-shadow: none;
            /* بدون ظل في البداية */
            z-index: 100;
            transition: background-color 0.4s ease, box-shadow 0.4s ease;
        }

        /* عند التمرير لأسفل، يتغير لون الخلفية ويظهر الظل */
        nav.scrolled {
            background-color: rgba(255, 255, 255, 0.95);
            /* لون أبيض شبه شفاف */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            /* إضافة ظل */
        }


        .containerr {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
    font-size: 24px;
    font-weight: bold;
    color:rgb(165, 78, 27); 
    text-decoration: none; 
    letter-spacing: 2px; 
    text-transform: uppercase; 
    
    transition: color 0.3s ease, transform 0.3s ease; 
}

.logo:hover {
    color:rgb(165, 78, 27); 
    transform: scale(1.1); 
}


a {
    text-decoration: none;
    color: inherit; 
}

        .search-bar {
            position: relative;
            width: 33%;
        }

        .search-bar input {
            width: 100%;
            padding: 10px;
            border-radius: 25px;
            border: 1px solid #ccc;
        }

        .search-bar span {
            position: absolute;
            left: 10px;
            top: 10px;
            color: #aaa;
        }

        .iconss a {
            margin-left: 20px;
            font-size: 24px;
            color: #333;
        }

        .iconss a:hover {
            color: black;
        }

        .nav-links {
            text-align: center;
            display: flex;
            justify-content: center;
            gap: 50px;
            margin-top: 15px;
            margin-left: 200px;
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        .navbar-top {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: transparent;
            box-shadow: none;
            z-index: 1000;
            padding: 15px 0;
            transition: background-color 0.5s ease, box-shadow 0.5s ease, padding 0.3s ease;
        }

        .navbar-top.scrolled {
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
        }

        .navbar-top:hover {
            background-color: rgba(255, 255, 255, 1);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        @keyframes glow {
            0% {
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            }

            50% {
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            }

            100% {
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            }
        }

        .navbar-top:hover {
            animation: glow 1.5s infinite alternate;
        }

        .promo-banner {
            width: 100%;
            background-color: #ad682f;
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            padding: 20px;
            margin: 30px 0;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            animation: pulse 2s infinite alternate;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(1.05);
            }
        }




        .slider-container {
            display: flex;
            align-items: center;
            gap: 10px;
            border-radius: var(--border-radius-medium);
            overflow: auto hidden;
            scroll-snap-type: inline mandatory;
            overscroll-behavior-inline: contain;
        }

        .slider-item {
            position: relative;
            min-width: 100%;
            max-height: 450px;
            aspect-ratio: 1 / 1;
            border-radius: var(--border-radius-medium);
            overflow: hidden;
            scroll-snap-align: start;
            animation: slideIn 0.7s ease-out forwards;
        }

        @keyframes slideIn {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(0);
            }
        }

        .slider-item .banner-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: right;
        }



        ul {
            margin: 0;
            padding: 0;
            position: absolute;
            top: 22%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
        }

        ul li {
            list-style: none;
            display: inline-block;
            margin: 0 5px;
        }

        ul li a {
            color: #262626;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 22px;
            display: block;
            padding: 10px 10px;
            position: relative;
            display: block;
            margin: 0 20px;
        }

        ul li a:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            transform: scaleX(2);
            width: 100%;
            height: 100%;
            border-left: 2px solid #333;
            border-right: 2px solid #333;
            transition: 0.5s;
            opacity: 0;
        }

        ul li a:after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transition: 0.5s;
            border-left: 2px solid #333;
            border-right: 2px solid #333;
            transform: scaleX(2);
            opacity: 0;
        }

        ul li a:hover:before {
            transform: scaleX(1);
            opacity: 1;
        }

        ul li a:hover:after {
            transform: scaleX(1);
            opacity: 1;
        }

        .banner-content {
            background: hsla(0, 0%, 100%, .5);
            position: absolute;
            bottom: 25px;
            left: 25px;
            right: 25px;
            padding: 20px 25px;
            border-radius: var(--border-radius-medium);
        }

        .banner-subtitle {
            color: var(--salmon-pink);
            font-size: var(--fs-7);
            font-weight: var(--weight-500);
            text-transform: capitalize;
            letter-spacing: 2px;
            margin-bottom: 10px;
            margin-left: 500px;
        }

        .banner-title {
            color: var(--eerie-black);
            font-size: var(--fs-1);
            text-transform: uppercase;
            line-height: 1;
            margin-bottom: 10px;
            margin-left: 500px;

        }

        .banner-text {
            display: none;
            margin-left: 500px;

        }

        .banner-btn {
            background: var(--salmon-pink);
            color: var(--white);
            width: max-content;
            font-size: var(--fs-11);
            font-weight: var(--weight-600);
            text-transform: uppercase;
            padding: 4px 10px;
            border-radius: var(--border-radius-medium);
            transition: var(--transition-timing);
            margin-left: 540px;

        }

        .banner-btn:hover {
            background: var(--eerie-black);
        }

        .container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            max-width: 800px;
            padding: 50px;

        }

        .product {
            position: relative;
            background: rgb(235, 217, 217);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            text-align: center;
            font-size: 14px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 350px;
            width: 270px;
            transition: transform 0.5s ease, box-shadow 0.5s ease;
            opacity: 0;
            transform: translateY(30px);
        }

        .product.in-view {
            opacity: 1;
            transform: translateY(0);
        }

        .price {
            font-size: 22px;
            font-weight: bold;
            color: #25181f;
            margin-top: -5px;
        }

        .product img {
           

    height: 200px;
    object-fit: cover;
    border-radius: 6px;
    transition: box-shadow 0.3s ease;
        }
     
        .product-img-custom {
    width: 100%;              
    aspect-ratio: 1 / 1;      
    object-fit: cover;      
    object-position: center;  
    border-radius: 6px;
    transition: box-shadow 0.3s ease;
    display: block;           
}


        .product:hover img {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }

        .icons {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .icon-btn {
            background: rgba(255, 255, 255, 0.7);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.3s;
        }

        .icon-btn:hover {
            background: rgba(255, 255, 255, 1);
        }

        .fav-btn.active {
            background-color: red;
            color: white;
        }

        .notification {
            position: fixed;
            top: 100px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            display: none;
            font-size: 14px;
            transition: all 0.5s;
			z-index: 9999; /* ✅ Make sure it's on top of everything */

        }

        .produc-name {
            font-size: 16px;
            font-weight: bold;
            color: #333;

        }

        .details-btn {
            display: flex;
            justify-content: center;
            margin-top: -15px;
            margin-left: 10px;
            padding: 10px;
            background-color: #e8e8e8;
            border-color: #ffe2e2;
            border-style: solid;
            border-width: 9px;
            border-radius: 35px;
            transition: transform 0.4s cubic-bezier(.68, -0.55, .27, 2.5),
                border-color 0.4s ease-in-out,
                background-color 0.4s ease-in-out;
            word-spacing: -2px;
            cursor: pointer;
            transform: scale(1);
        }

        .details-btn:hover {
            background-color: #eee;
            transform: scale(1.05);
            animation: movingBorders 3s infinite;
        }

        .banner {
            display: inline-block;
            background: white;
            color: black;
            font-size: 40px;
            font-weight: bold;
            padding: 20px 610px;
            position: relative;
            clip-path: polygon(5% 20%, 95% 0%, 100% 80%, 0% 100%);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .underline {
            width: 500px;
            height: 2px;
            background-color: gray;
            margin: 10px auto;
            position: relative;
        }

        .diamonds {
            display: flex;
            justify-content: center;
            margin-top: -5px;
        }

        .diamond {
            width: 10px;
            height: 10px;
            background-color: rgb(82, 57, 12);
            transform: rotate(45deg);
            margin: 0 5px;
        }

        .diamond.blue {
            background-color: rgb(170, 180, 190);
        }

.ads-container {
  display: flex;
  width: 100%;
  height: 40vh;
}

.ad-left {
  width: 68%;
  height: 100%;
}

.ad-right {
  width: 30%;
  height: 100%;
}

.ad-right img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.swiper-slide {
  display: flex;
  justify-content: center;
  align-items: center;
}

.swiper-slide img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

    @keyframes movingBorders {
            0% {
                border-color: #fce4e4;
            }

            50% {
                border-color: #ffd8d8;
            }

            90% {
                border-color: #fce4e4;
            }
        }

        
    </style>
</head>
	  <div id="notification" class="notification"></div>

<body>

<?php include 'navbar.php'; ?>

     </div>
<h3 class="showup firula-newsletter"><?= $type_safe ?> products</h3>

    <div class="container">
	<?php while($product = $result->fetch_assoc()): ?>
    <div class="product">
        <div class="icons">
		
			<?php if (isset($_SESSION['id'])): ?>	
            <button class="icon-btn fav-btn" onclick="saveToFavorites('<?= $product['image'] ?>', '<?= $product['name'] ?>', '$<?= $product['price'] ?>')">❤️</button>
                   <button class="icon-btn cart-btn" onclick="saveToCarts('<?= $product['id'] ?>','<?= $product['image'] ?>', '<?= $product['name'] ?>', '<?= $product['price'] ?>')">🛒️</button>
	<?php else: ?>
    <?php endif; ?>

		</div>
        <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
        <h3 class="product-name"><?= $product['name'] ?></h3>
        <p class="price">$<?= $product['price'] ?></p>
        <button class="details-btn" onclick="goToDetails('<?= $product['id'] ?>')">Detaylar 🔍</button>
		
    </div>

<?php endwhile; ?>


      
  </div>
<?php include 'ads.php' ?>

    <div class="container">
	<?php while($product = $result2->fetch_assoc()): ?>
    <div class="product">
    <div class="icons">
		
        <?php if (isset($_SESSION['id'])): ?>	
        <button class="icon-btn fav-btn" onclick="saveToFavorites('<?= $product['image'] ?>', '<?= $product['name'] ?>', '$<?= $product['price'] ?>')">❤️</button>
               <button class="icon-btn cart-btn" onclick="saveToCarts('<?= $product['id'] ?>','<?= $product['image'] ?>', '<?= $product['name'] ?>', '<?= $product['price'] ?>')">🛒️</button>
<?php else: ?>
<?php endif; ?>
</div>
        <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
        <h3 class="product-name"><?= $product['name'] ?></h3>
        <p class="price">$<?= $product['price'] ?></p>
        <button class="details-btn" onclick="goToDetails('<?= $product['id'] ?>')">Detaylar 🔍</button>
		
    </div>

<?php endwhile; ?>


      
  </div>

     <!-- Swiper JS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

     <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script src="assets/js/javascript.js">

	    function saveToCarts(id, name, price,image,size,stok) {
    const newCartProduct = {
		id:id,
        name: name,
        price: price,
		image:image,
		size:size,
		stock:stok
    };

    let myCarts = JSON.parse(localStorage.getItem("cartProducts")) || [];

    const alreadyExists = myCarts.some(p => p.name === newCartProduct.name);
    if (!alreadyExists) {
        myCarts.push(newCartProduct);
        localStorage.setItem("cartProducts", JSON.stringify(myCarts));
        showNotification("✅ Added to cart!");
    } else {
        showNotification("⚠️ Already added to cart");
    }
}
     function saveToFavorites(image, name, price) {
    const newProduct = {
        image: image,
        name: name,
        price: price
    };

    let favorites = JSON.parse(localStorage.getItem("favoriteProducts")) || [];

    const alreadyExists = favorites.some(p => p.name === newProduct.name);
    if (!alreadyExists) {
        favorites.push(newProduct);
        localStorage.setItem("favoriteProducts", JSON.stringify(favorites));
        showNotification("✅ rün favorilere eklendi!");
    } else {
        showNotification("⚠️ rün favorilere zetan var");
    }
}


        // وظيفة لتفعيل الحركة عند التمرير
        function handleScroll() {
            const products = document.querySelectorAll('.product');
            products.forEach(product => {
                const rect = product.getBoundingClientRect();
                if (rect.top <= window.innerHeight && rect.bottom >= 0) {
                    product.classList.add('in-view');
                }
            });
        }
        // إضافة حدث التمرير
        window.addEventListener('scroll', handleScroll);

        function showNotification(message) {
            const notification = document.getElementById("notification");
            notification.textContent = message;
            notification.style.display = "block";
            setTimeout(() => {
                notification.style.display = "none";
            }, 2000);
        }
        function toggleWishlist(element) {
            element.classList.toggle("active");
            let isActive = element.classList.contains("active");
            showNotification(isActive ? "Ürün favorilere eklendi!" : "Ürün favorilerden çıkarıldı!");
        }

        function goToDetails(productId) {
				    window.location.href = 'details.php?id=' + productId;
        }
        window.addEventListener("scroll", function () {
            const navbar = document.querySelector(".navbar-top");
            if (window.scrollY > 50) {
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }
        });
        /*الاعلان*/
      
  const swiper = new Swiper('.ad-left', {
    loop: true,
    slidesPerView: 1, // صورتين بالعرض
    spaceBetween: 10, // مسافة بينهم
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    grabCursor: true,
  });


    </script>


</body>
</html>