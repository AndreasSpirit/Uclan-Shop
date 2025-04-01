<?php
session_start();
    $connect=mysqli_connect("localhost","apnevmatikas","fxGHAgwRLC","apnevmatikas");
$css = file_get_contents('css/cart.css');
echo "<style>$css</style>";

if (isset($_SESSION['cart']) && $_SESSION['cart'] === true) {
    $_SESSION['cart'] = true;
} else {
    $_SESSION['cart'] = false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST['productIds'])) {
        $productIds = json_decode($_POST['productIds'], true);
        $_SESSION['productIds'] = $productIds;
    }

	
    if (isset($_POST['email_data']) && isset($_POST['pass'])) {
        $email = mysqli_real_escape_string($connect, $_POST['email_data']);
        $password = $_POST['pass'];

        $query = "SELECT * FROM tbl_users WHERE user_email = '$email'";
        $result = mysqli_query($connect, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                if (password_verify($password, $user['user_pass'])) {
                    $_SESSION['username'] = $user['user_full_name']; 
					$_SESSION['user_id'] = $user['user_id'];
                    $_SESSION["logged-in"] = true; 
                    $_SESSION["form-sent"] = true;
					header('Location: ' . $_SERVER['REQUEST_URI']);
                     exit();
                } else {
                    echo '<script>alert("Incorrect password.");</script>';
					$_SESSION["form-sent"] = false;
                }
            } else {
                echo '<script>alert("No user found with this email address.");</script>';
            }
        } else {
            echo '<script>alert("Error executing query. Please try again.");</script>';
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['clear_cart'])) {
    $_SESSION['cart'] = false;
	header('Location: ' . $_SERVER['REQUEST_URI']);
    exit();
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/assign.css">
    <script defer src="cart.js"></script>
    <title>Cart - UCLan Shop</title>
</head>
<body>
<header>
    <div class="logo">
        <img src="images/logo.svg" alt="UCLan logo">
    </div>
    <div class="sub-head">
        <a href="index.php">
            <span class="home"> Home</span>
        </a>
        <a href="products.php">
            <span class="products"> Products</span>
        </a>
        <a href="cart.php">
            <span class="cart"> Cart</span>
        </a>
        <?php
        if (isset($_SESSION["logged-in"]) && $_SESSION["logged-in"] == true) {
            echo '<span>Welcome, ' . $_SESSION["user_name"] . ' | <a href="logout.php">Logout</a></span>';
        } else {
            echo '<a href="login.php"><span class="login">Login</span></a>';
        }
        ?>
    </div>
</header>
    <main>
        <div class="CartList">
            <h1>Shopping cart</h1>
            <div class="text"><?php echo ($_SESSION['username'] ?? " "); ?> The items you've added to the shopping cart: </div>

            <form method="POST" action="">
                <input type="hidden" name="clear_cart" value="1">
                <button type="submit" id="clearButton" class="clearButton">Clear Cart</button>
            </form>
        </div>
        <div class="cartInfo">
            <span class="ItemWord">Item</span>
            <span class="ProductWord">Product</span>
        </div>
        <div class="container" id="cartContainer">
        </div>
		
		<?php
    if(isset($_SESSION["logged-in"]) && $_SESSION["logged-in"] == true && $_SESSION['cart'] == true): 
    ?>
        <form class="loginList" id="loginForm" method="POST" action="checkout.php">
		     <input type="hidden" id="productIds" name="productIds">
            <button id="checkoutButton" class="checkoutButton">Checkout</button>
        </form>
    <?php endif; ?>

        <form class="loginList" id="loginForm" method="POST" action="cart.php" <?php if(isset($_SESSION["logged-in"]) && $_SESSION["logged-in"] == true) echo 'style="display: none;"'; ?>>
            <p class="text">In order to check out you must log in</p>
            <p class="inputText">Email:</p>
            <input type="email" class="inputBar" id="email" name="email_data" required>
            <p class="inputText">Password:</p>
            <input type="password" class="inputBar" id="password" name="pass" required>
            <button class="buttonSubmit" id="buttonLogin" type="submit">Confirm</button>
        </form>
    </main>

    <footer>
<div class="footer">
    <div class="union">
        <span class="link">Links</span>
        <a class="Studentunion" href="https://www.uclan.ac.uk/student-life/students-union">
            <p>Students Union</p></a>
    </div>
    <div class="union">
        <span class="link">Contact</span>
        <p>Email: suinformation@uclan.ac.uk</p>
        <p>Phone:01772 89 3000</p>
    </div>
    <div class="union">
        <span class="loc">Location</span>
        <p>University of Central Lancashire Students'Union,</p>
        <p>Fylde Road, Preston. PR1 7BY</p>
        <p>Registered in England</p>
        <p>Company Number: 7623917</p>
        <p>Registered Charity Number:1142616</p>
    </div>
</div>
</footer>
<script src="cart.js"></script>

</body>
</html>
