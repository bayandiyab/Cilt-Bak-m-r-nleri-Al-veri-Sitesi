<?php
session_start();
if (isset($_POST['user']) && isset($_POST['password'])) {
    $user = $_POST["user"];
    $password = $_POST["password"];

    if (!empty($user) && !empty($password)) {

        $a = mysqli_connect("localhost", "root", "", "ecom_db");

        if (!$a) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $user = mysqli_real_escape_string($a, $user);
        $password = mysqli_real_escape_string($a, $password);

        $sorgu = "select * from admins_tb where user='$user' and password='$password'";
        $sonuc = mysqli_query($a, $sorgu);

        if (mysqli_num_rows($sonuc) > 0) {
            $_SESSION['user'] = $user;

            header("Location:product.php");
            exit();
        } else {
            echo "<div id='errorMessage' class='error-message'>❌ Hatalı kullanıcı adı veya şifre!</div>";
            echo "<script>
                setTimeout(function() {
                    document.getElementById('errorMessage').style.display = 'none';
                }, 3000);
            </script>";
        }
        mysqli_close($a);
    }
}
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login as admin</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: "Poppins", sans-serif;
            background:  rgb(245, 213, 241);
            text-align: center;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #fff;
        }

        .wrapper {
            width: 100%;
            max-width: 400px;
            margin-top: 100px;
        }
        #formContent {
            background: #fff;
            /* شفافية */
            border-radius: 20px;
            box-shadow: 0 30px 60px 0 rgba(0, 0, 0, 0.2);
            padding: 45px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        h2 {
            font-size: 24px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 20px;
            color: #333;
            cursor: pointer;
        }

        h2.admin {
            color:rgb(0, 0, 0);
            font-size: 28px;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
        }

        input[type="text"],
        input[type="password"] {
            background-color: #f6f6f6;
            border: 2px solid #f6f6f6;
            color: #333;
            padding: 15px;
            text-align: center;
            font-size: 16px;
            margin: 15px 0;
            width: 85%;
            border-radius: 10px;
            transition: all 0.4s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            background-color: #fff;
            border-color:rgb(248, 245, 244);
            /* تغيير اللون عند التحديد */
        }

        input[type="submit"] {
            background-color: #ff66b3;
            border: none;
            color: white;
            padding: 15px 80px;
            font-size: 16px;
            border-radius: 30px;
            box-shadow: 0 8px 15px rgba(255, 126, 95, 0.3);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #ff3385;
            box-shadow: 0 10px 20px  rgba(255, 105, 180, 0.5);
        }

        .error-message {
            font-size: 18px;
            margin-bottom: 20px;
            background-color: #dc3545;
            /* لون أحمر جميل */
            color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 10px 30px 0 rgba(9, 105, 153, 0.4);
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            animation: slideDown 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideDown {
            from {
                top: -50px;
            }

            to {
                top: 20px;
            }
        }
  
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: transparent;
            box-shadow: none;
            z-index: 100;
            transition: background-color 0.4s ease, box-shadow 0.4s ease;
        }

        nav.scrolled {
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .info-text {
        font-size: 14px;
        color: #333;
        margin-bottom: 15px;
    }

        .containerr {
            max-width: 1200px;
            margin: 0 auto;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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

.navbar-top:hover {
    background-color: white;
    box-shadow: none;
    animation: none;
}

        .navbar-top.scrolled {
            background-color: rgb(245, 213, 241);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
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

    </style>
</head>
<body>
    <div class="wrapper">
        <div id="formContent">
            <h2 id="loginTab" class="active" onclick="switchForm('login')">
                <h2 class="admin">admin login</h2>
                <form id="loginForm" action="admin.php" method="POST" class="active fadeIn">
                    <input type="text" name="user" placeholder="User" required><br>
                    <input type="password" name="password" placeholder="Password" required><br>
                    <input type="submit" value="Log in">
                </form>
        </div>
    </div>

</body>

</html>