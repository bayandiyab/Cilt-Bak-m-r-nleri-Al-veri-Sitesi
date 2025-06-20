<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Favorites</title>
  <style>
    .filters {
      display: flex;
      gap: 10px;
      margin-left: 1100px;
    }

    .filter-btn {
      background: #ff4d79;
      color: white;
      border: none;
      padding: 8px 15px;
      font-size: 14px;
      cursor: pointer;
      border-radius: 20px;
      transition: 0.3s;
    }

    .filter-btn:hover {
      background: #ff0055;
      transform: scale(1.1);
    }

    .container {
  display: grid;
  grid-template-columns: repeat( 4, 1fr);
  gap: 20px;
  max-width: 1200px;
  margin: 50px auto;
  padding: 20px;
}

/* Individual product card */
.product {
  background: #fff0f5; /* very soft pink background */
  border: 1px solid #ffe0eb;
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  text-align: center;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* Hover effect for product */
.product:hover {
  transform: translateY(-5px);
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Product image */
.product img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 10px;
}

/* Product name */
.product-name {
  font-size: 18px;
  font-weight: bold;
  color: #cc5588; /* dark soft pink */
  margin: 10px 0 5px;
}

/* Price text */
.price {
  color: #ff4d79; /* vibrant pink */
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 10px;
}

/* Button (optional if you want small action button) */
.details-btn {
  background: #ff80ab;
  color: white;
  border: none;
  padding: 8px 15px;
  border-radius: 20px;
  cursor: pointer;
  transition: background 0.3s ease;
  font-size: 14px;
}

.details-btn:hover {
  background: #cc5588;
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
        .no-favorites-message {
  font-size: 24px;
  color: #555;
  text-align: center;
  padding: 50px 20px;
  font-weight: bold;
  animation: fadeIn 0.5s ease;

  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
        
  </style>
</head>
<body>
<?php include 'navbar.php'; ?>

  <div class="top-bar">
    <div class="filters">
      <button class="filter-btn" onclick="filterAll()">Show All</button>
      <button class="filter-btn" onclick="deleteAllFavorites()">Delete All</button>
    </div>
  </div>

  <div class="container" id="favorite-container" style="min-height: 60vh;"></div>

  <script>
  // ✅ Fixed search input logic
function submitSearch() {
    const query = document.getElementById('searchInput').value.trim();
    if (query !== '') {
        window.location.href = 'search.php?q=' + encodeURIComponent(query);
    }
}
document.getElementById("searchInput").addEventListener("keydown", function(e) {
    if (e.key === "Enter") submitSearch();
});
    let favorites = JSON.parse(localStorage.getItem("favoriteProducts")) || [];
    const container = document.getElementById("favorite-container");
    function renderFavorites() {
  container.innerHTML = "";

  if (favorites.length === 0) {
    container.innerHTML = `
      <div class="no-favorites-message">
        No favorite products yet!
      </div>
    `;
    return;
  }

      favorites.forEach((product, index) => {
        const productHTML = `
          <div class="product" style="position: relative;">
              <button onclick="removeFromFavorites(${index})" 
                  style="position: absolute; top: 10px; right: 10px; background: white; border: none; border-radius: 50%; width: 30px; height: 30px; cursor: pointer;">❌</button>

              <img src="${product.image}" alt="${product.name}">
              <h3 class="product-name">${product.name}</h3>
              <p class="price">${product.price}</p>
              <button class="details-btn" onclick="alert('Product details: ${product.name}')">Details 🔍</button>

              <button onclick="addToCart(${index})" 
                  style="margin-top: 10px; background: orange; color: white; border: none; padding: 10px 20px; border-radius: 20px; cursor: pointer;">🛒 Add to Cart</button>
          </div>
        `;
        container.innerHTML += productHTML;
      });
    }

    function removeFromFavorites(index) {
      favorites.splice(index, 1);
      localStorage.setItem("favoriteProducts", JSON.stringify(favorites));
      renderFavorites();
    }

    function addToCart(index) {
      const product = favorites[index];
      let cart = JSON.parse(localStorage.getItem("cartProducts")) || [];
      cart.push(product);
      localStorage.setItem("cartProducts", JSON.stringify(cart));
      window.location.href = "cart.php";
    }

    function deleteAllFavorites() {
      favorites = [];
      localStorage.removeItem("favoriteProducts");
      renderFavorites();
    }

    function filterAll() {
      renderFavorites();
    }

    renderFavorites();
    
  </script>
</body>
</html>
