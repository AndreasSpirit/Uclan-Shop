<?php
session_start();
    $connect=mysqli_connect("localhost","apnevmatikas","fxGHAgwRLC","apnevmatikas");
$itemCss = file_get_contents('css/item.css');
echo "<style>$itemCss</style>";
if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $result = mysqli_query($connect, "SELECT * FROM tbl_products WHERE product_id = $id");

  if(mysqli_num_rows($result) > 0) {
      $product = mysqli_fetch_assoc($result);
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["logged-in"]) && $_SESSION["logged-in"] == true) {
  if (isset($_POST['title']) && isset($_POST['comment']) && isset($_GET['id']) && isset($_POST['rating'])) {
      $title = $_POST['title'];
      $comment = $_POST['comment'];
      $id = $_GET['id'];
      $rating = $_POST['rating']; 
  
      $query = "INSERT INTO tbl_reviews(product_id, user_id, review_title, review_desc, review_rating) VALUES (?, ?, ?, ?, ?)";
      $stmt = mysqli_prepare($connect, $query);
      mysqli_stmt_bind_param($stmt, "iissi", $id, $_SESSION['user_id'], $title, $comment, $rating);
      $result = mysqli_stmt_execute($stmt);

      if ($result) {
          $_SESSION['comment_added'] = true;
          header('Location: ' . $_SERVER['REQUEST_URI']);
          exit();
      } else {
          $_SESSION['comment_added'] = false;
      }
  } else {
      echo "<script>alert('Incomplete data');</script>";
  }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/assign.css">
  <title><?php echo $product['product_title']; ?></title>
</head>

<body>
<header>
  <!-- Header bar at the top of the screen -->
  <div class="logo">
    <div class="Shop">Student Shop</div>
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
  <?php
  echo '<div class="itemDetails" id="productDetails">';
  echo '<img src="' . $product['product_image'] . '" alt="Product Image">';
  echo '<h2>' . $product['product_title'] . '</h2>';
  echo '<p class="description">' . $product['product_desc'] . '</p>';
  echo '<p class="price">' . '€' .$product['product_price'] . '</p>';
  echo "<button class='add-to-cart buttonBuy' data-product='" . htmlspecialchars(json_encode($product), ENT_QUOTES, 'UTF-8') . "'>Add to Cart</button>";
  echo '</div>';
  ?>
  
  <div id="usersComments" class="usersComments">
    <?php
	$commentsQuery = mysqli_query($connect, "SELECT r.*, u.user_full_name FROM tbl_reviews r JOIN tbl_users u ON r.user_id = u.user_id WHERE r.product_id = $id");

    $totalRating = 0; 
    $commentCount = 0; 
	$averageRating = 0;
	
    if(mysqli_num_rows($commentsQuery) > 0) {
        echo "<h3 class='comment-begin'>Comments: </h3>";
        while($comment = mysqli_fetch_assoc($commentsQuery)) {
            echo "<div class='comment-panel'>";
            echo "<h3 class='comment-title'>Name: {$comment['user_full_name']}</h3>";
            echo "<h3 class='comment-title'>Title: {$comment['review_title']}</h3>";
            echo "<p class='comment-content'>Description: {$comment['review_desc']}</p>";
            echo "<p class='comment-content'>Time: {$comment['review_timestamp']}</p>";
            echo "<p class='comment-content'>Rating: {$comment['review_rating']}</p>";
            echo "</div>";

            $totalRating += $comment['review_rating'];
            
            $commentCount++;
        }
        
        if ($commentCount > 0) {
    $averageRating = $totalRating / $commentCount;
}
    } 
    ?>
</div>


  <!--Only logged in users can comment and rate-->
  <div class="commentSection">
    <?php if(isset($_SESSION["logged-in"]) && $_SESSION["logged-in"] == true): ?>
        <h1>Average rating: <?php echo number_format($averageRating, 1); ?></h1>

        <form id="commentForm" class="commentForm" action="item.php?id=<?php echo $id; ?>" method="POST">

            <div class="titleContainer">
                <label for="title">Customer Name:</label><br>
                <input type="text" class="title" id="title" name="title" required><br>
            </div>

            <div class="commentContainer">
                <label for="comment">Comment:</label><br>
                <input type="text" class="comment" id="comment" name="comment" required><br>
            </div>

            <div class="ratingContainer">
                <label for="rating">Rating:</label><br>
                <select id="rating" name="rating">
                    <option value="1">⭐</option>
                    <option value="2">⭐⭐</option>
                    <option value="3">⭐⭐⭐</option>
                    <option value="4">⭐⭐⭐⭐</option>
                    <option value="5">⭐⭐⭐⭐⭐</option>
                </select><br>
            </div>

            <input type="submit" class="submitComment" value="Submit">
        </form>
    <?php endif; ?>
</div>


	
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

<!-- Java script for items -->
<script>

document.addEventListener('DOMContentLoaded', function () {
	const addToCartButtons = document.querySelectorAll('.add-to-cart')

	addToCartButtons.forEach(button => {
		button.addEventListener('click', function () {
			const productData = JSON.parse(this.dataset.product)
			addToCart(productData)
		})
	})

	function addToCart(product) {
		let cart = JSON.parse(localStorage.getItem('cart')) || []
		cart.push(product)
		localStorage.setItem('cart', JSON.stringify(cart))
		alert('Item added to the cart!')
		updateCartDisplay()
	}

})
    document.addEventListener('DOMContentLoaded', function () {
        <?php if(isset($_SESSION['comment_added']) && $_SESSION['comment_added'] === true): ?>
            alert('Comment added successfully!');
            <?php unset($_SESSION['comment_added']); ?>
        <?php endif; ?>
    });
</script>

</body>
</html>

