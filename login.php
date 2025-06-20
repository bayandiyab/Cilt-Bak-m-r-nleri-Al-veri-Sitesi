<?php
session_start(); 

$message = "";  // Store the message


// Registration code
if (isset($_POST["email"]) && isset($_POST["registration_nickname"]) && isset($_POST["sifre"])) {
    $email = $_POST["email"];
    $ad = $_POST["registration_nickname"]; 
    $sifre = $_POST["sifre"];

    if (!empty($email) && !empty($ad) && !empty($sifre)) {
        $a = mysqli_connect("localhost", "root", "", "ecom_db");
        if (!$a) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Check if the email already exists
        $b = mysqli_query($a, "SELECT * FROM users_tb WHERE email = '$email'");
        $adet = mysqli_num_rows($b);
        if ($adet > 0) {
            $message = "This email is already registered!";
            $messageType = "error-message";  // Error message
        } else {
            // Insert new user
            $b = mysqli_query($a, "INSERT INTO users_tb (email, registration_nickname, sifre) VALUES ('$email', '$ad', '$sifre')");
            if ($b) {
                $_SESSION['email'] = $email;
                $message = "Your account has been created successfully!";
                $messageType = "message";  // Success message
            } else {
                $message = "An error occurred while creating your account!";
                $messageType = "error-message";  // Error message
            }
        }

        mysqli_close($a);
    } else {
        $message = "Please fill in all fields.";
        $messageType = "error-message";  // Error message
    }
}

// Login code
if (isset($_POST["email"]) && isset($_POST["sifre"]) && empty($ad)) {
    $email = trim($_POST["email"]);
    $sifre = trim($_POST["sifre"]);

    if (!empty($email) && !empty($sifre)) {
        $a = mysqli_connect("localhost", "root", "", "ecom_db");
        if (!$a) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Check if the email and password are correct
        $b = mysqli_query($a, "SELECT * FROM users_tb WHERE email = '$email' AND sifre = '$sifre'");
        $adet = mysqli_num_rows($b);
        $adet = mysqli_num_rows($b);

        if ($adet > 0) {
            $result = mysqli_fetch_assoc($b);
            $isActivated = $result['Activate_user'];
        
            if ($isActivated == 0) {
                session_unset(); 
                
                $message = "Your email is not activated yet!";
                $messageType = "error-message";
        
            } elseif ($isActivated == 1) {
                $_SESSION['id'] = $result['id']; 
                $_SESSION['email'] = $email;
        
                header("Location: index.php");
                exit();
			}
        } else {
            $message = "Incorrect email or password!";
            $messageType = "error-message";  // Error message
        }

        mysqli_close($a);
    } else {
        $message = "Please fill in all fields.";
        $messageType = "error-message";  // Error message
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: "Poppins", sans-serif;
            background-color: rgb(245, 213, 241);
            text-align: center;
             top: 100%;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .wrapper {
            width: 100%;
            max-width: 400px;
            margin-top: 100px;
        }
        #formContent {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 30px 60px 0 rgba(0, 0, 0, 0.3);
            padding: 45px;
            text-align: center;
        }
        h2 {
            font-size: 18px;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 20px;
            color: #cccccc;
            cursor: pointer;
            display: inline-block;
            margin: 10px 10px;
        }
        h2.active {
            color: #0d0d0d;
            border-bottom: 2px solid rgb(238, 238, 238);
        }
        
        input[type="text"], input[type="password"] {
            background-color: #f6f6f6;
            border: none;
            padding: 15px;
            text-align: center;
            font-size: 16px;
            margin: 10px 0;
            width: 85%;
            border-radius: 5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        input[type="text"]:focus, input[type="password"]:focus {
            background-color: #fff;
            border-bottom: 2px solid #ff66b3;
        }
        input[type="submit"] {
            background-color: #ff66b3;
            border: none;
            color: white;
            padding: 15px 80px;
            text-align: center;
            font-size: 16px;
            border-radius: 25px;
            box-shadow: 0 10px 30px rgba(255, 105, 180, 0.3);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #ff3385;
            box-shadow: 0 15px 40px rgba(255, 105, 180, 0.5);
        }

        .fadeIn {
            opacity: 0;
            animation: fadeIn ease-in 1s forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        form {
            display: none;
        }
        form.active {
            display: block;
        }
        .switch-btn {
            background: none;
            border: none;
            color: rgb(0, 0, 0);
            cursor: pointer;
            text-decoration: underline;
            margin-top: 10px;
        }
        
        .message {
            font-size: 18px;
            margin-bottom: 20px;
            background-color: #28a745;
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
        .error-message {
            background-color: #dc3545;
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
            /* شفاف في البداية */
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
            background-color: rgba(255, 255, 255, 0.95);
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
<p class="info-text">Merhaba, giriş yap veya hesap oluştur, indirimleri kaçırma!</p>

    <div id="formContent">
  
        <!-- Display message if any -->
        <?php if ($message): ?>
            <div id="message" class="message <?php echo isset($messageType) ? $messageType : ''; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <h2 id="loginTab" class="active" onclick="switchForm('login')">Log in</h2>
        <h2 id="signupTab" class="inactive" onclick="switchForm('signup')">Sign up</h2>

        <!-- Login Form -->
        <form id="loginForm" action=" " method="POST" class="active fadeIn">
            <input type="text" name="email" placeholder="Email" required><br>
            <input type="password" name="sifre" placeholder="Password" required><br>
            <input type="submit" value="Log in">
            <button type="button" class="switch-btn" onclick="switchForm('signup')">Don't have an account? Sign up</button>
            <button type="button" class="switch-btn" onclick="window.location.href='admin.php'">Click here for admin login</button>
        </form>

        <!-- Signup Form -->
        <form id="signupForm" action="" method="POST" class="fadeIn inactive">
            <input type="text" name="email" placeholder="Email" required><br>
            <input type="password" name="sifre" placeholder="Password" required><br>
            <input type="text" name="registration_nickname" placeholder="Username" required><br>
            <input type="submit" value="Sign Up">
            <button type="button" class="switch-btn" onclick="switchForm('login')">Do you have an account? Log in</button>
        </form>

    </div>
</div>

<script>
    // Function to hide the message after 3 seconds
    window.onload = function() {
        const message = document.getElementById('message');
        if (message) {
            setTimeout(function() {
                message.style.display = 'none';
            }, 2000); // 3 seconds
        }
    }

    function switchForm(form) {
        let loginForm = document.getElementById('loginForm');
        let signupForm = document.getElementById('signupForm');
        let loginTab = document.getElementById('loginTab');
        let signupTab = document.getElementById('signupTab');

        if (form === 'login') {
            loginForm.classList.add('active');
            signupForm.classList.remove('active');
            loginTab.classList.add('active');
            signupTab.classList.remove('active');
        } else {
            signupForm.classList.add('active');
            loginForm.classList.remove('active');
            signupTab.classList.add('active');
            loginTab.classList.remove('active');
        }
    }
</script>
