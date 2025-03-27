<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assign.css">
    <script defer src="cart.js"></script>
    <title>Cart - UCLan Shop</title>
</head>
<body>
<header>
    <div class="logo">
        <img src="logo.svg" alt="UCLan logo">
    </div>
    <div class="sub-head">
        <a href="index.php">
            <span class="home"> Home</span>
        </a>
        <a href="products.php">
            <span class="products"> Products</span>
        </a>
        <a href="cart.html">
            <span class="cart"> Cart</span>
        </a>
    </div>


</header>
<div class="shoppingcart"><h1>Shopping Cart</h1></div>
<div class="cartdesc"><p>The items you've added to your shoping cart are:</p></div>
<div class="cart-container">
    <div id="cart-items"></div>
    <div class="total" id="cart-total"></div>
</div>

<script src="cart.js"></script>

</body>
</html>
