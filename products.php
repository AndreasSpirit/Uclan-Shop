<?php
session_start();
$css=file_get_contents('css/signup.css');
$css=file_get_contents('css/products.css');
$connect=mysqli_connect("localhost","apnevmatikas","fxGHAgwRLC","apnevmatikas");
$result=mysqli_query($connect,"SELECT * FROM tbl_products");

echo "<style>$css</style>";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    $_SESSION['cart'] = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/assign.css">

    <title>Products - UCLan Shop</title>
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
    <h1>Our Products</h1>
</header>
<main>
<div class="productsPage">
			<div class="productsList">
				<div class="searchList">
					<input class="searchInput" id="input" />
					<button class="searchButton" id="ButtonSearch">Search</button>
				</div>
				<span class="productsWord"></span>
				<a class="list" data-category="UCLan Logo Tshirt" href="#t-shirts">T-shirts</a>
                <a class="list" data-category="UCLan Hoodie" href="#hoodies">Hoodies</a>
                <a class="list" data-category="UCLan Logo Jumper" href="#jumpers">Jumpers</a>
                <a class="list" data-category="all" href="#all">All</a>
			</div>

			<div class='container'>
			
			
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <div class='item' data-category='<?php echo $row["product_type"]; ?>'>
        <img src='<?php echo $row["product_image"]; ?>' alt='Product Image'>
        <h2><?php echo $row["product_title"]; ?></h2>
        <p class='price'>€<?php echo $row["product_price"]; ?></p>
        <div class='product_desc'><?php echo $row["product_desc"]; ?></div>
        <form method="POST" action="">
            <input type="hidden" name="add_to_cart" value="<?php echo $row["product_id"]; ?>">
            <button type="submit" class='add-to-cart buttonBuy' data-product='<?php echo htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8'); ?>'>Add to Cart</button>
			<a class='read-more' href='item.php?id=<?php echo $row["product_id"]; ?>'>Read more</a>
        </form>
    </div>
<?php } ?>


</div>
		</div>
</main>
<script src="products.js"></script>

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
</body>
</html>

