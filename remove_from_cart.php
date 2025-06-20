<?php
session_start();

if (isset($_SESSION['cart'])) {
    $index = isset($_GET['index']) ? $_GET['index'] : null;

    if ($index !== null && isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

header('Location: cart.php');
exit();
?>
