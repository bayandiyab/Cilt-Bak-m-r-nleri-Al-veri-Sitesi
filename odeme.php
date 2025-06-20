<?php
header("refresh:5;url=index.php");

?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>ödeme</title>
    <style>
        body {
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .message {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
            font-size: 24px;
            color:   #bd6772;
            position: relative;
        }
        .loader {
            border: 6px solid #f3f3f3;
            border-top: 6px solid  #bd6772;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="message">
        ✅ Ödeme tamamladndı
        <div class="loader"></div>
       5 saniye sonra ana sayfaya yönlendireleceksiniz..
    </div>
</body>
</html>
