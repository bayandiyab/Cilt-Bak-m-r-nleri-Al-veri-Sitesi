<?php
session_start();

// Ensure user is admin
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Allow access only to these sub-pages
$allowed_pages = [
    'admin_add_products',
    'admin_product_list',
    'admin_user_tables',
    'admin_edit_tables'
];

$page = $_GET['page'] ?? '';

?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Panel</title>
</head>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Work+Sans:wght@300;400;700;900&display=swap">
    <style>
        * {
            outline-width: 0;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background: rgb(255, 240, 245);
            /* لون خلفية هادئ من الوردي الفاتح */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100%;
            margin: 0;
        }

        #container {
            height: 100vh;
            width: 100%;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #inviteContainer {
            position: relative;
            display: flex;
            border-radius: 10px;
            overflow: hidden;
            width: 100%;
            box-shadow: 0px 6px 30px rgba(255, 105, 180, 0.3);
            /* ظل وردي */
            background: rgba(255, 182, 193, 0.8);
            /* خلفية وردية */
        }

        .logoContainer {
            position: relative;
            width: 100%;
            padding: 30px 35px;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            opacity: 0;
            transform: scale(0.8);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .logoContainer.show {
            opacity: 1;
            transform: scale(1);
        }

        .logoContainer h1 {
            color: #FF66B2;
            /* لون وردي قوي */
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 10px;
            text-align: center;
            opacity: 0;
            transition: opacity 0.8s ease;
        }

        .logoContainer h1.show {
            opacity: 1;
        }

        .acceptContainer {
            width: 100%;
            padding: 45px 5px;
            box-sizing: border-box;
            height: 0;
            opacity: 0;
            overflow: hidden;
            transition: height 0.5s ease, opacity 0.5s ease;
        }

        .acceptContainer.show {
            height: 650px;
            opacity: 1;
        }

        form {
            width: 100%;
            text-align: center;
        }

        .formContainer {
            text-align: left;
        }

        .formDiv {
            margin-bottom: 10px;
            opacity: 0;
            transition: opacity 0.5s ease, left 0.5s ease;
            position: relative;
            left: -25px;
        }

        .formDiv.show {
            opacity: 1;
            left: 0;
        }

        p {
            color: #FF66B2;
            /* اللون الوردي */
            font-weight: 600;
            font-size: 20px;
            margin: 0;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 5px;
            margin-top: 20px;
            border: none;
            background: transparent;
            box-shadow: inset 0 -1px 0 rgba(255, 105, 180, 0.15);
            /* ظل خفيف بلون وردي */
            color: #FF66B2;
            /* نص بلون وردي */
            font-size: 20px;
            transition: box-shadow 0.3s ease;
        }

        input:focus,
        textarea:focus {
            box-shadow: inset 0 -2px 0 #FF66B2;
            /* ظل وردي عند التركيز */
        }

        button {
            width: 100%;
            padding: 18px;
            margin-top: 25px;
            background: linear-gradient(45deg, #FF66B2, #FF3385);
            /* تدرج من الوردي الفاتح إلى الداكن */
            border: none;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        button:hover {
            background: linear-gradient(45deg, #FF3385, #FF66B2);
            /* تدرج مع تأثير hover */
        }

        .message {
            font-size: 18px;
            margin-bottom: 20px;
            background-color: #28a745;
            /* اللون الأخضر */
            color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 10px 30px 0 rgba(9, 105, 153, 0.4);
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            animation: slideDown 0.5s ease-in-out;
        }

        @keyframes slideDown {
            from {
                top: -50px;
            }

            to {
                top: 20px;
            }
        }

        .message.success {
            background-color: #28a745;
            color: white;
        }

        .message.error {
            background-color: #dc3545;
            color: white;
        }
    </style>

<body>

<div id="container">
    <div id="inviteContainer">
        <div class="logoContainer show">
            <h1 class="show">Admin Dashboard</h1>
        </div>
        <div class="acceptContainer show">
            <form>
                <div class="formContainer">
                    <div class="formDiv show">
                        <p>Choose an action:</p>
                        <ul style="list-style: none; padding-left: 0;">
                            <li><a href="product.php?page=admin_add_products"><button type="button">➕ Add New Product</button></a></li>
                            <li><a href="product.php?page=admin_product_list"><button type="button">📦 View Products</button></a></li>
                            <li><a href="product.php?page=admin_user_tables"><button type="button">👥 View Users</button></a></li>
                            <li><a href="product.php?page=admin_edit_tables"><button type="button">✏️ Edit/Delete Products</button></a></li>
                            <li><a href="login.php"><button type="button">Log in</button></a></li>

                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Content Display Area -->
<div style="padding: 30px; width: 90%; margin: auto;">
    <?php
    if (in_array($page, $allowed_pages) && file_exists("$page.php")) {
        define('INSIDE_ADMIN', true);
        include("$page.php");
    } elseif ($page !== '') {
        echo '<div class="message error">❌ Page not found or unauthorized access.</div>';
    }
    ?>
</div>
</body>
</html>