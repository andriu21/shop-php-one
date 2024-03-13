<?php
include 'config.php';
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
    <title>Search page</title>
</head>
<body>
      <?php include 'header.php'?>
      <div class="heading">
        <h3>search product</h3>
        <p> <a href="home.php">home</a> / product</p>
      </div>

      <section class="search-form">
            <form action="" method="POST">
                <div class="box"><input type="text" name="search" placeholder="search product..."></div>
                <input type="submit" value="search" class="btn" name="submits">
            </form>
      </section>

      <section class="products" style="padding-top:0;">
            <div class="box-container">
                <?php
                
                  if(isset($_POST['submits'])){
                    $search_item = $_POST['search'];
                    $search_query = mysqli_query($conn,"SELECT * FROM `products` WHERE name LIKE '%$search_item%'") or die('first query fail');

                    if(mysqli_num_rows($search_query) > 0){
                        while($fecth_products = mysqli_fetch_assoc($search_query)){
                           
                       
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
                    echo '<p class="empty">no results 222</p>';
                }
              }else{
                echo '<p class="empty">no results</p>';
              }
                ?>
            </div>
      </section>

      
      <?php include 'footer.php'?>
    <script src="scrip.js"></script>
</body>
</html>