<?php
include 'config.php';
include 'reduceFunction.php';
session_start();

$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
    header('location:login.php');
};


if(isset($_POST['add_to_cart'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    if($product_quantity <= 0){
        $product_quantity = 1;
    }
    

    $check_cart_number = mysqli_query($conn,"SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query 1');

    if(mysqli_num_rows($check_cart_number)> 0){
        $message = 'already added to cart';
    }else{
        mysqli_query($conn,"INSERT INTO `cart`(user_id,name,price,quantity,image) 
        VALUES('$user_id','$product_name','$product_price','$product_quantity','$product_image')") or die('query 2');

        $message[] = 'product added to cart';
    };
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css-estilos/normalize.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css-estilos/estilos2.css">
    <title>Home</title>
</head>
<body>
      <?php include 'config.php'?>
      <?php include 'header.php'?>

        <section class="home">
            <div class="content">
                <h3>Hand Picked Book to your door.</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi, veniam quod dignissimos quibusdam sequi odio!</p>
                <a href="about.php" class="white-btn">discover more</a>
            </div>
        </section>

        <section class="products">
            <h1 class="title">last products</h1>

            <div class="box-container">
                <?php
                    $select_products = mysqli_query($conn,"SELECT * FROM `products`  ORDER BY RAND() LIMIT 4") or die('query fail');

                    if(mysqli_num_rows($select_products) > 0){
                        while($fecth_products = mysqli_fetch_assoc($select_products)){

                       
                ?>
                
                <form action="" method="POST" >
                
                    <div class="container-img">
                    <img src="upload_img/<?php echo $fecth_products['image'];?>" alt="<?php echo $fecth_products['image'];?>">
                    </div>

                    <div class="name"><?php echo reducer_funtion($fecth_products['name'])?></div>

                    <div class="price">$<?php echo $fecth_products['price']?>/-</div>
                    
                    <input type="number" name="product_quantity" value="1" class="qty">
                    <input type="hidden" name="product_name" value="<?php echo $fecth_products['name']?>">

                    <input type="hidden" name="product_price" value="<?php echo $fecth_products['price']?>">


                    <input type="hidden" name="product_image" value="<?php echo $fecth_products['image']?>">

                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                </form>

                <?php
                     }
                    }else{
                        echo '<p class="empty">no products added yet!</p>';
                    };
                ?>
            </div>

            <div class="load-more" >
                    <a href="shop.php"class="option-btn">load more</a>
            </div>
        </section>


        <section class="about">
            <div class="flex">
                <div class="image">
                    <img src="img/about.png" alt="about">
                </div>
                <div class="content">
                    <h3>about us</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab debitis voluptas, in quod iusto rem a doloremque corporis est odio.</p>
                    <a href="about.php" class="btn">read more</a>
                </div>
            </div>
        </section>

        <section class="home-contact">
            <div class="content">
            <h3>Have any questions?</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi nesciunt dolor quae sed maxime. Labore eaque magni quis accusamus in.</p>
            <a href="contact.php" class="white-btn">contact us</a>
            </div>
        </section>
      <?php include 'footer.php'?>
    <script src="scrip.js"></script>
</body>
</html>