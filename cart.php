<?php
session_start();
?>

<style>
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
            /* يبدأ من أسفل */
        }

        .product.in-view {
            opacity: 1;
            transform: translateY(0);
            /* يتحرك العنصر إلى مكانه */
        }

        .price {
            font-size: 22px;
            font-weight: bold;
            color: #25181f;
            margin-top: -5px;
            /* ترك مسافة بين السعر والزِر */
        }

        .product img {
           
    height: 200px;
    object-fit: cover;
    border-radius: 6px;
    transition: box-shadow 0.3s ease;
        }
     
        .product-img-custom {
    width: 100%;              /* تغطي عرض الكرت */
    aspect-ratio: 1 / 1;      /* مستطيلة عمودية – تقدر تغيرها مثلاً لـ 1 / 1 للمربع */
    object-fit: cover;        /* تقص الصورة لتغطي كل المساحة */
    object-position: center;  /* تركز الصورة في الوسط */
    border-radius: 6px;
    transition: box-shadow 0.3s ease;
    display: block;           /* تمنع أي فراغ تحت الصورة */
}


        /* تأثير الهالة عند التمرير على الصورة */
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


	   :root {
            --salmon-pink: #ff7675;
            --eerie-black: #262626;
            --fs-7: 18px;
            --border-radius-medium: 10px;
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

        /* الشريط العلوي عند التمرير */
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

        /* عند التمرير للأسفل */
        .navbar-top.scrolled {
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
        }

        /* تأثير عند مرور الماوس */
        .navbar-top:hover {
            background-color: rgba(255, 255, 255, 1);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        /* تأثير Glow عند المرور */
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

       
        html,
        body {
            overflow-x: hidden;
            margin: 50px auto;
            padding: 0;
            width: 100%;
            background:rgb(243, 241, 239);

            
          
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

        /* الشريط العلوي عند التمرير */
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

        /* عند التمرير للأسفل */
        .navbar-top.scrolled {
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
        }

        /* تأثير عند مرور الماوس */
        .navbar-top:hover {
            background-color: rgba(255, 255, 255, 1);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        /* تأثير Glow عند المرور */
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
            top: 30%;
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

    
.cart-container {
    width: 80%;
    margin:  100px auto;
    padding:30px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.cart-item {
    display: flex;
    align-items: center;
    border-bottom: 1px solid #ddd;
    padding: 15px 0;
}

.product-image {
    width: 100px;
    height: 100px;
    object-fit: cover;
    margin-right: 20px;
}

.product-details {
    flex: 1;
}

.price {
    font-size: 18px;
    color: #333;
}

.quantity-control {
    display: flex;
    align-items: center;
    margin-top: 10px;
}

.btn {
    padding: 5px 10px;
    background: #ddd;
    
    border-radius: 5px;
    margin: 0 5px;
    text-decoration: none;
    color: #333;
}
.buy-btn {
    transition: background 0.3s ease, transform 0.2s ease;
}

.buy-btn:hover {
    background: #e64a19;
    transform: scale(1.05);
}
.cart-summary {
    text-align: center;
    margin-top: 20px;
}

.checkout-btn, .continue-btn {
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.checkout-btn:hover, .continue-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

.checkout-btn, .continue-btn {
    display: inline-block;
    padding: 10px 20px;
    margin: 10px;
    text-decoration: none;
    color: #fff;
    background-color: rgb(233, 168, 219);
    border-radius: 5px;
}

.continue-btn {
    background-color: rgb(230, 157, 214);
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
        .info-text {
        font-size: 14px;
        color: #333;
        margin-bottom: 15px;
    }

 

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #333;
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

       
        /* الشريط العلوي عند التمرير */
        .navbar-top {
    background-color: white;
    position: fixed;
    top: 0;
    width: 100%;
    box-shadow: none; /* إزالة الظل */
    z-index: 1000;
    padding: 15px 0;
    
    transition: none; /* تعطيل التأثيرات */
}

/* تعطيل تأثير الـ hover */
.navbar-top:hover {
    background-color: white;
    box-shadow: none;
    animation: none;
}

        /* عند التمرير للأسفل */
        .navbar-top.scrolled {
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
        }
  
        
        .iconss a {
            margin-left: 20px;
            font-size: 24px;
            color: #333;
        }

        .iconss a:hover {
            color: black;
        }
        
        .containeer {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            max-width: 800px;
            padding: 50px;

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
            /* بداية الحجم الطبيعي */
        }



        .details-btn:hover {
            background-color: #eee;
            transform: scale(1.05);
            /* تكبير الزر عند التمرير */
            animation: movingBorders 3s infinite;
        }


.section {
    padding: 70px 0;
    background:rgb(243, 241, 239);}

.title_bx {
    text-align: center;
    margin-bottom: 20px;
}

.title_bx .title {
    font-size: 28px;
    font-weight: 700;
    color: #333;
}

.title_bx h3.title {
    font-size: 22px;
    text-transform: capitalize;
    position: relative;
    color: rgb(238, 124, 213);
    font-weight: 700;
    line-height: 1.2em;
}

.title_bx h3.title:before {
    content: "";
    height: 2px;
    width: 20%;
    position: absolute;
    left: 0px;
    z-index: 1;
    top: 40px;
    background-color: #323163;
}

.title_bx h3.title:after {
    content: "";
    height: 2px;
    width: 100%;
    position: absolute;
    left: 0px;
    top: 40px;
    background-color: #000000;
}

        .empty-cart {
    position: absolute;
    top: 55%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 28px;
    font-weight: bold;
    color: #6c757d;
    padding: 10px 10px;
    border-radius: 20px;
  
    animation: fadeInUp 0.8s ease-out, floating 3s ease-in-out infinite;
    transition: all 0.3s ease;
    text-align: center;
}
@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translate(-50%, 20%);
    }
    100% {
        opacity: 1;
        transform: translate(-50%, -50%);
    }
}

@keyframes floating {
    0% {
        transform: translate(-50%, -50%);
    }
    50% {
        transform: translate(-50%, -55%);
    }
    100% {
        transform: translate(-50%, -50%);
    }
}


</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping cart</title>
</head>
<body>
    <!-- Navbar -->
<?php include 'navbar.php'; ?>
    <!-- محتوى الصفحة -->
<div class="cart-container">
    <h2>🛒 Shopping cart</h2>
    <div id="cart-container"></div>

    <div class="cart-summary" id="summary" style="display:none;">
        <h3 id="total-amount">Total amount: 0 TL</h3>
        <a href="odeme.php" class="checkout-btn">✅ Pay</a>
        <a href="index.php" class="continue-btn">🔙 Back to shopping</a>
    </div>
</div>
<section id="products" class="section">
      <div class="title_bx">
          <h3 class="title">More products</h3>
      </div>
  <div class="container">
        <!-- Product 1 -->
<?php 
$conn = new mysqli('localhost', 'root', '', 'ecom_db');
$sql = "SELECT * FROM products_tb ORDER BY id DESC LIMIT 8";
$result = $conn->query($sql);
if (!$result) {
    die("Query failed: " . $conn->error); // 
}

if ($result->num_rows === 0) {
    echo "<p>No products found.</p>"; // 
}
while($product = $result->fetch_assoc()): ?>
    <div class="product">
        <div class="icons">
            <button class="icon-btn fav-btn" onclick="saveToFavorites('<?= $product['image'] ?>', '<?= $product['name'] ?>', '$<?= $product['price'] ?>')">❤️</button>
            <button class="icon-btn cart-btn" onclick="saveToCarts('<?= $product['id'] ?>','<?= $product['image'] ?>', '<?= $product['name'] ?>', '$<?= $product['price'] ?>')">🛒️</button>
        </div>
        <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
        <h3 class="product-name"><?= $product['name'] ?></h3>
        <p class="price"><?= $product['price'] ?></p>
        <button class="details-btn" onclick="window.location.href='details.php?id=<?= $product['id']; ?>';">Detaylar 🔍</button>
   </div>

<?php endwhile; ?>
  </div>
 </section>

  <div id="notification" class="notification"></div>
  
		


</body>
<script>
     function saveToCarts(id,image, name, price) {
    const newCartProduct = {
		id: id,
        image: image,
        name: name,
        price: price
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
        showNotification("✅ Added to favorites!");
    } else {
        showNotification("⚠️ Already added to favorites");
    }
}
function showNotification(message) {
    alert(message); // يمكنك استخدام أي طريقة عرض إشعار تفضلها
}

function showNotification(message) {
            const notification = document.getElementById("notification");
            notification.textContent = message;
            notification.style.display = "block";
            setTimeout(() => {
                notification.style.display = "none";
            }, 2000);
        }
  const cartContainer = document.getElementById("cart-container");
  const summary = document.getElementById("summary");
  const totalAmount = document.getElementById("total-amount");

  const cart = JSON.parse(localStorage.getItem("cartProducts")) || [];

  if (cart.length === 0) {
    cartContainer.innerHTML = '<div class="empty-cart">🛒 There are no products';
} else {
    let total = 0;
cart.forEach(product => {
//	const price = parseFloat(product.price);  //
	
	const rawPrice = product.price;
	const cleanPrice = typeof rawPrice === 'string' ? rawPrice.replace(/[^\d.]/g, '') : rawPrice;
	const price = parseFloat(cleanPrice);

if (!isNaN(price)) {
    total += price * (product.quantity || 1);
}
  const item = document.createElement("div");
  item.className = "cart-item";
  item.innerHTML = `
    <img src="${product.image}" alt="${product.id}" class="product-image">
    <div class="product-details">
      <h3>${product.name}</h3>
      <p class="price">Price: ${product.price} TL</p>
	  
    </div>
    <button onclick="removeFromCart('${product.name}')" class="remove-btn">❌</button>
  `;
  cartContainer.appendChild(item);
});

    totalAmount.innerText = "TOTAL: " + total.toFixed(2) + " TL";
    summary.style.display = "block";
  }

  function removeFromCart(name) {
    let cart = JSON.parse(localStorage.getItem("cartProducts")) || [];
    cart = cart.filter(p => p.name !== name);
    localStorage.setItem("cartProducts", JSON.stringify(cart));
    location.reload(); // تحديث الصفحة
  }
  window.addEventListener("scroll", function () {
    const navbar = document.querySelector(".navbar-top");
    if (window.scrollY > 50) {
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
});
function submitSearch() {
    const query = document.getElementById('searchInput').value.trim();
    if (query !== '') {
        window.location.href = 'search.php?q=' + encodeURIComponent(query);
    }
}
document.getElementById("searchInput").addEventListener("keydown", function(e) {
    if (e.key === "Enter") submitSearch();
});
function submitSearch() {
    const query = document.getElementById('searchInput').value.trim();
    if (query !== '') {
        window.location.href = 'search.php?q=' + encodeURIComponent(query);
    }
}
document.getElementById("searchInput").addEventListener("keydown", function(e) {
    if (e.key === "Enter") submitSearch();
});
</script>

</html>
