<?php
session_start();

$conn = new mysqli("localhost", "root", "", "ecom_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$product = null;
$sizes = []; // array to hold all available sizes of this product name

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM products_tb WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
   // 2. If product is found, fetch all available sizes with the same product name
    if ($product) {
#for the more products part
		$sql2 = "SELECT id,size,price,image,stok,name FROM products_tb ORDER BY RAND() LIMIT 4;";
		$result2 = $conn->query($sql2);

        $sizeStmt = $conn->prepare("SELECT size,price FROM products_tb WHERE name = ?");
        $sizeStmt->bind_param("s", $product['name']);
        $sizeStmt->execute();
        $sizeResult = $sizeStmt->get_result();

        while ($row = $sizeResult->fetch_assoc()) {
            $sizes[] = $row['size'];
			$prices[] = $row['price'];
			$pricesBySize[$row['size']] = $row['price'];
        }
		$jsonPrices = json_encode($pricesBySize);
    } else {
        echo "<script>alert('Product not found.'); window.location.href = 'index.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Product ID is missing.'); window.location.href = 'index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:400,300italic,300,400italic">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
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
            animation: movingBorders 3s infinite;
        }

        :root {
            --salmon-pink: #ff7675;
            --eerie-black: #262626;
            --fs-7: 18px;
            --border-radius-medium: 10px;
        }

@import url(https://fonts.googleapis.com/css?family=Muli:400,300italic,300,400italic);
        body,
        html {
          margin: 0;
          font-family: muli;
          height: 100%;
          padding: 0;
          overflow-x:hidden;
           background:rgb(243, 241, 239);
        }
        
        h1,
        h2 {
          margin: 0;
        }
       
        .containeer {
        
          display: flex;
          height: 100%;
          -webkit-box-pack: center;
          -webkit-justify-content: center;
              -ms-flex-pack: center;
                  justify-content: center;
          -webkit-box-align: center;
          -webkit-align-items: center;
              -ms-flex-align: center;
                  align-items: center;
                  background:rgb(243, 241, 239);        }
        
        .window {
          background: #fff;
          width: 500px;
          display: -webkit-box;
          display: -webkit-flex;
          display: -ms-flexbox;
          display: flex;
          min-height: 450px;
          position: relative;
          box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.2);
        }
       
        .main-content {
          padding:50px 46px 25px 20px;
          box-sizing: border-box;
          display: -webkit-box;
          display: -webkit-flex;
          display: -ms-flexbox;
          display: flex;
          color: #222;
          width: 100%;
          height: 100%;
          -webkit-flex-flow: column;
              -ms-flex-flow: column;
                  flex-flow: column;
        }
        
        h1 {
          letter-spacing: 0px;
          letter-spacing: .02rem;
          font-size: 48px;
          font-size: 3rem;
        }
        
        h3 {
          color: #666;
          font-size: 19px;
          font-size: 1.2rem;
        }
        
        .description {
          margin-top: 20px;
          width: 100%;
        }
         
        .color {
          height: 30px;
          cursor:pointer;
          width: 30px;
          background: #eee;
          border: 1px solid #eee;
          position:relative;
        } 
        .highlight-window {
          height: 480px;
          width: 500px;
          background: #ccc;
          background: url('<?= $product['image'] ?>');
          background-size: cover;
          box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.2);
          z-index: 10;
          position:relative;
          background-position:center top;
        }
        .highlight-window.mobile {
          display:none;
        }
        .range-picker .active:hover {
          background:#fff;
        }
        .options {
          display:-webkit-box;
          display:-webkit-flex;
          display:-ms-flexbox;
          display:flex;
          margin-top:25px;
          -webkit-box-pack:justify;
          -webkit-justify-content:space-between;
              -ms-flex-pack:justify;
                  justify-content:space-between;
        } 
        .size-picker {
    display: flex; /* جعل العناصر تتوزع بشكل أفقي */
    align-items: center; /* محاذاة العناصر بشكل عمودي */
}

.size-label {
    font-size: 16px; /* حجم الخط للكلمة Size */
    font-weight: bold; /* جعل الكلمة بشكل عريض */
    margin-right: 10px; /* مسافة بين كلمة "Size" والقياسات */
}

.range-picker {
    display: flex; /* العناصر داخل range-picker تتوزع أفقيًا */
    align-items: center; /* محاذاة العناصر عموديًا */
    margin-top: 5px;
}

.range-picker div {
    display: flex;
    align-items: center;
    justify-content: center;
    border-right: 1px solid #bbb;
    border-top: 1px solid #bbb;
    border-bottom: 1px solid #bbb;
    color: #bbb;
    width: 30px;
    height: 30px;
    cursor: pointer;
    transition: background 0.5s ease;
}

.range-picker div.active {
    transform: scale(1.2);
    background: #fff;
    margin-right: 3px;
    margin-left: 2px;
    color: #333;
    border: 1px solid #666;
    z-index: 1;
}

.range-picker div:hover {
    background: #eee;
    transition: background 0.2s;
}

.range-picker div:first-child {
    border-left: 1px solid #bbb;
}

.range-picker div.active:first-child {
    border-left: 1px solid #333;
}

    
        .color.overlay {
          position:absolute;
          z-index:10;
          background:transparent;
          top:-1px;
          left:-1px;
          -webkit-transform:translateX(45px);
              -ms-transform:translateX(45px);
                  transform:translateX(45px);
          border:2px solid #fff;
          outline:2px solid #ccc;
          -webkit-transition:-webkit-transform .3s ease;
                  transition:transform .3s ease;
        }
        .color-a {
          background: #333;
          margin-right:14px;
        }
        
        .color-b {
          background: #457;
        
        }
        
        .color-picker {
          display: -webkit-box;
          display: -webkit-flex;
          display: -ms-flexbox;
          display: flex;
          width: 77px;
          margin-top:5px;
          position:relative;
        }
        a {
          text-decoration:none;
        }
        a:hover {
          text-decoration:underline;
          color:#666;
        }
        button.d {
    background:#333;
    border:none;
    font-weight:400;
    height:40px;
    margin-top:auto;
    margin-bottom:auto;
    padding-left:25px;
    padding-right:25px;
    box-sizing:border-box;
    color:#fff;
    cursor:pointer;
    transition:all .3s ease;
}
button.d:hover {
    background:#555;
    transition:all .3s ease;
}

        .divider {
          width:80%;
          height:1px;
          background:#ddd;
          margin-top:20px;
          margin-bottom:20px;
          margin-left:auto;
          margin-right:auto;
        }
        .color-options {
          display:-webkit-box;
          display:-webkit-flex;
          display:-ms-flexbox;
          display:flex;
          width:50%;
          -webkit-flex-flow:column;
              -ms-flex-flow:column;
                  flex-flow:column;
        }
       
       .purchase-info {
          -webkit-box-pack:justify;
          -webkit-justify-content:space-between;
              -ms-flex-pack:justify;
                  justify-content:space-between;
          display:-webkit-box;
          display:-webkit-flex;
          display:-ms-flexbox;
          display:flex;
        }
        .price {
          font-size: 40px;
          font-size:2.5rem;
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
            opacity: 1;
            /* يبدأ العنصر بشفافية */
            transform: translateY(0);
            /* يبدأ من أسفل */
        }

        .container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
                      gap: 10px;
            max-width: 800px;
            padding: 50px;

        }

        .product.in-view {
            opacity: 1;
            transform: translateY(0);
            /* يتحرك العنصر إلى مكانه */
        }

        .price {
            font-size: 22px;
            font-weight: bold;
            color: rgb(238, 124, 213);
            margin-top: -5px;
            /* ترك مسافة بين السعر والزِر */
        }

       
        .product img {
           
    height: 200px;
    object-fit: cover;
    border-radius: 6px;
    transition: box-shadow 0.3s ease;
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
    background-color:rgb(0, 0, 0);
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

.sq_box h4 {
    font-size: 18px;
    text-align: center;
    margin-top: 15px;
    margin-bottom: 10px !important;
}

.sq_box .price-box {
    margin-bottom: 15px !important;
}



.sq_box .price-box span.price {
    text-decoration: line-through;
    color: #6c757d;
}

.sq_box span {
    font-size: 14px;
    font-weight: 600;
    margin: 0px 10px;
    color: #28a745;
}




._p-qty {
  display: flex;
  margin-left: 10px;
  align-items: center;
  gap: 10px;
  margin-top: 10px;
}

.qty-label {
  color: black;

  margin-left: -100px; /* تحرك الكلمة لليسار شوي */
  white-space: nowrap;
  font-size: 16px; /* حجم الخط للكلمة Size */
}


        ._p-qty .value-button {
  display: inline-flex;
  justify-content: center;
  align-items: center;
  width: 30px;
  height: 30px;
  margin: 0;
  background-color:rgb(230, 157, 214);
  color: white;
  border: 1px solid rgb(230, 157, 214);
  border-radius: 4px;
  text-align: center;
  cursor: pointer;
  user-select: none;
  font-size: 18px;
}


        
        /* المكان يلي رح يزيد فيه العدد */
        ._p-qty input#number {
  text-align: center;

  width: 50px;
  font-size: 18px;
  border: 1px solid #999;
  border-radius: 4px;
  padding: 4px 0;
}
        ._p-add-cart {
            margin-left: 100px;
            margin-bottom: 0px;
        }
        .p-list {
            margin-bottom: 20px;
        }
        ._p-features > span {
            display: block;
            font-size: 16px;
            color: #000;
            font-weight: 400;
        }
        ._p-add-cart .buy-btn {
            background-color: #cadbcd;
            color: #fff;
        }
        ._p-add-cart .btn {
            text-transform: capitalize;
            padding: 6px 20px;
            border-radius: 52px;
        }
        ._p-add-cart .btn {
            margin: 0px 8px;
        }


@media (max-width: 750px) {
          body {
            background:#fff;
            overflow:auto;
          }
          h1 {
            font-size:2rem;
          }
          h3,h2 {
            font-size:1rem;
          }
          .container {
            height:auto;
            background:#fff;
            overflow:auto;
          }
          .background-element {
            display:none;
          }
          .main-content {
            overflow:auto;
            height:auto;
            padding-right:25px;
          }
          .options {
            -webkit-flex-flow:column;
                -ms-flex-flow:column;
                    flex-flow:column;
          }
          .highlight-window {
            position:fixed;
            left:0;
            height:100%;
            width:50%;
          }
          .window {
            overflow:auto;
            width:50%;
            height:auto;
            position:absolute;
            box-shadow:none;
          }
          .price {
            margin-bottom:15px;
          }
          .button {
            width:100%;
          }
          .color-options {
            margin-bottom:15px;
          }
          .align-right {
            -webkit-align-self:flex-start;
                -ms-flex-item-align:start;
                    align-self:flex-start;
          }
          .purchase-info {
            -webkit-flex-flow:column;
                -ms-flex-flow:column;
                    flex-flow:column;
          }
        }
.back-to-top {
    position: fixed;
    top: 10px;
    left: 10px;
    width: 30px;
    height: 30px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: transparent; /* خلفية شفافة */
    border: none; /* إزالة الحدود */
    cursor: pointer;
    z-index: 1000;
    padding: 0;
}

.arrow {
    border-top: 5px solid transparent;
    border-bottom: 5px solid transparent;
    border-right: 10px solid #000; /* السهم باللون الأسود */
    width: 0;
    height: 0;
}

.back-to-top:hover .arrow {
    border-bottom-color: #5f60cf; /* تغيير لون السهم عند المرور */
}


    </style>
</head>

<body>

  <button class="back-to-top" onclick="window.location.href='index.php';">
    <div class="arrow"></div>
</button>

    <div class='containeer'>

        <div class='background-element' id='background-element'></div>


		    <div class='highlight-window' id='product-img');><div class='highlight-overlay' id='highlight-overlay'>          <div id="notification" class="notification"></div></div></div>
        <div class='window'>
		
            <div class='main-content'>
<h2><?= $product['type'] ?></h2>
<h1><?= $product['name'] ?></h1>
     
                <div class='description' id='description'>
    <?= $product['description'] ?>
</div>
                <div class='highlight-window mobile' id='product-img'><div class='highlight-overlay' id='highlight-overlay-mobile'></div></div>
                <div class='options'>
                    <div class='size-picker'>
                        Size:
                        <div class='range-picker' id="range-picker">
    <?php foreach (array_unique($sizes) as $size): ?>
        <?php $isActive = ($size === $product['size']) ? 'active' : ''; ?>
        <div class="<?= $isActive ?>" id="<?= $isActive === 'active' ? 'available' : '' ?>">
            <?= htmlspecialchars($size) ?>
        </div>
    <?php endforeach; ?>
</div>

                        <div class="_p-add-cart"> 
                         
                          <div class="_p-add-cart"> 
                            <div class="_p-qty">
                              <span class="qty-label">Add Quantity:</span>
                              <div class="value-button decrease_" onclick="decreaseValue()">-</div>
                              <input type="number" name="qty" id="number" value="1" min="1" />
                              <div class="value-button increase_" onclick="increaseValue()">+</div>
                            </div>
                          </div>
                          
                      </div>
                    </div>  
                </div>
                <div class='divider'></div>
                <div class='purchase-info'>
                    <div class='price' id="price">					
					<?= $product['price'] ?></div>
                    

			<?php if (isset($_SESSION['id'])): ?>
                    <button class="d" onclick="saveToCarts('<?= $product['id'] ?>','<?= $product['name'] ?>', '<?= $product['price'] ?>', '<?= $product['image'] ?>','<?= $product['size'] ?>','<?= $product['stok'] ?>')">Add to cart  🛒</button>
				<?php else: ?>
				
				                    <button class="d" onclick="window.location.href='login.php'">Add to cart 🛒</button>

    <?php endif; ?>
               
			   </div>
            </div>
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
		<?php if (isset($_SESSION['id'])): ?>	

            <button class="icon-btn fav-btn" onclick="saveToFavorites('<?= $product['image'] ?>', '<?= $product['name'] ?>', '$<?= $product['price'] ?>')">❤️</button>
            <button class="icon-btn cart-btn" onclick="saveToCarts('<?= $product['id'] ?>','<?= $product['image'] ?>', '<?= $product['name'] ?>', '<?= $product['price'] ?>')">🛒️</button>
		<?php else: ?>
    <?php endif; ?>     
	 </div>
        <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
        <h3 class="product-name"><?= $product['name'] ?></h3>
        <p class="price"><?= $product['price'] ?></p>
        <button class="details-btn" onclick="window.location.href='details.php?id=<?= $product['id']; ?>';">Detaylar 🔍</button>
		
    </div>

<?php endwhile; ?>
</div>
      <script>
  const sizePrices = <?= $jsonPrices ?>;
	  
	  let currentSize = parseInt(document.getElementById('price').innerText); // لحفظ الحجم الحالي

document.getElementById('range-picker').addEventListener('click', function(e) {
    let sizeList = document.getElementById('range-picker').children;
    for (let i = 0; i < sizeList.length; i++) {
        sizeList[i].classList.remove('active');
    }

    if (e.target && e.target.textContent) {
        e.target.classList.add('active');

        currentSize = e.target.textContent.trim();
        console.log("الحجم المختار:", currentSize); // ✅ للتأكد
    updatePrice(currentSize); // ✅ Add this line

    }
});

function updatePrice(currentSize) {
	    const price = sizePrices[currentSize];
		document.querySelector('.price').innerText = `${price}`;
    if (sizePrices[currentSize]) {
                document.querySelector('.price').textContent = `${price}`;
        console.log("تم تحديث السعر إلى:", sizePrices[currentSize]); // ✅ للتأكيد
    } else {
        console.log("⚠ الحجم غير موجود في القائمة:", currentSize);
    }
}

window.addEventListener('DOMContentLoaded', () => {
    const activeSize = document.querySelector('#range-picker .active');
    if (activeSize) {
        currentSize = activeSize.textContent.trim();
        console.log("الحجم الفعلي عند التحميل:", currentSize); // ✅ للتأكد
        updatePrice(currentSize);
    }
});

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


	    function saveToCarts2(id, name, price,image,size,stok) {
		let quantity = document.getElementById('number').value
    const newCartProduct = {
		id:id,
        name: name,
        price: price,
		image:image,
		size:size,
		quantity:quantity
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


//single product add to Cart  
	    function saveToCarts(id, name, price,image,size,stok) {
		const activeSize = document.querySelector('.range-picker .active')
		let newsize = activeSize.innerText
		let quantity = document.getElementById('number').value
		let pricez = parseFloat(document.getElementById('price').innerText)
    const newCartProduct = {
		id:id,
        name: name,
        price: pricez,
		image:image,
		size:newsize,
		quantity:quantity
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

function increaseValue() {
    let value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 1 : value;
    document.getElementById('number').value = value + 1;
  }

  function decreaseValue() {
    let value = parseInt(document.getElementById('number').value, 10);
    if (!isNaN(value) && value > 1) {
      document.getElementById('number').value = value - 1;
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
       
       function goToDetails() {
        window.location.href = "cart.php"; // الانتقال إلى صفحة الكارت
  }



//


</script>




</body>
</html>
