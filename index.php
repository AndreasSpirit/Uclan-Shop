

<?php
session_start();
    $css=file_get_contents('assign.css');
    $connect=mysqli_connect("localhost","apnevmatikas","fxGHAgwRLC","apnevmatikas");
    $result=mysqli_query($connect,"SELECT * FROM tbl_offers");

    echo "<style>$css</style>"

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assign.css">
    <title>Home - UCLan Shop</title>
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
        if(isset($_SESSION["logged-in"]) && $_SESSION["logged-in"]==true)
            echo '<span><a href="logout.php">Logout</a></span>';
        else echo '<span>Sign up</a></span>';
        ?>
    </div>
</header>
<h1 class="description">Where opportunity creates</h1>
<h1 class="description">success</h1>
<p class="description2">Every student at The University of Central Lancashire is automatically a member of the Student's Union.</p>
<p class="description2">We're here to make life better for students - inspiring you to succeed and achieve your goals.</p><br>
<p class="description2">Everything you need to know about Uclan Students'Union. Your membership starts here.</p>
<div class="offers-title"><h1>Offers:</h1></div>
<div class="offerscontainer">
<?php


while ($row = mysqli_fetch_assoc($result)) {

    echo "<div class='offers'>";

    echo "<div style='font-size: 18px; font-weight: lighter'>" . $row["offer_title"] . "</div>";
    echo "<br>";


    echo $row["offer_dec"] . "<br>";

    echo "</div><br>";
}

?>
</div>
<div class="video">
    <h1>Together</h1>
    <video controls width="100%">
        <source src="video/video.mp4" width="540" height="420" type="video/mp4">
    </video>
    <h1>Join our global community</h1>

</div>

<div class="iframe">
    <iframe src="https://www.youtube.com/embed/EI_lco-qdw8"
            width="550"
            height="350"
            title="Youtube video player"
            referrerpolicy="strict-origin-when-cross-origin"
            frameborder="0"
            allow="accelerator; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen></iframe>

</div>

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
