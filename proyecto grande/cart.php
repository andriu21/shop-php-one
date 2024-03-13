<?php
include 'config.php';
include 'reduceFunction.php';
session_start();

$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
    header('location:login.php');
};



if(isset($_POST['update_cart'])){
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    if($cart_quantity <= 0){
        $cart_quantity = 1;
    }

    mysqli_query($conn,"UPDATE `cart` set quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failded');

    $message[] = 'cart quantity updated!';
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn,"DELETE FROM `cart` WHERE id = '$delete_id'") or die('query delete 1');
    header('location:cart.php');
}

if(isset($_GET['delete_all'])){
    $delete_all_cart = mysqli_query($conn,"SELECT * FROM `cart` WHERE user_id = '$user_id'") or die("te jodiste");

    if(mysqli_num_rows($delete_all_cart) > 0){
        while($fecth_delete = mysqli_fetch_assoc($delete_all_cart)){
            mysqli_query($conn,"DELETE FROM `cart` WHERE user_id = $user_id") or die('redas');
        }
    }
    header('location:cart.php');
}
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
    <title>Cart</title>
</head>
<body>
      <?php include 'config.php'?>
      <?php include 'header.php'?>
      <?php
if(isset($message)){
    foreach($message as $message){
        echo  '<div class="message">
                 <span>'.$message.'</span>
                  <i class="fas fa-times closes"></i>
               </div>';
    }
}
?>
      <div class="heading">
        <h3>shopping cart</h3>
        <p> <a href="home.php">home</a> / cart</p>
      </div>

      <section class="shopping-cart">
            <h1 class="title">products cart</h1>

            <div class="box-container">
                <?php
                $grand_total = 0;
                $select_cart = mysqli_query($conn,"SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failded 1');

              if(mysqli_num_rows($select_cart) > 0){
                while($fecth_cart = mysqli_fetch_assoc($select_cart)){
                
                
                ?>

            <div class="box">
                <a href="cart.php?delete=<?php echo $fecth_cart['id'];?>;" class="fas fa-times" onclick="return confirm('delete this from cart?');"></a>
                    <img src="upload_img/<?php echo $fecth_cart['image'];?>" alt="">
                    <div class="name"><?php echo reducer_funtion($fecth_cart['name']);?></div>
                    <div class="price">$<?php echo $fecth_cart['price'];?>/-</div>
                    <form action="" method="POST">
                        <input type="hidden" name="cart_id" value="<?php echo $fecth_cart['id'];?>">

                        <input type="number" name="cart_quantity" min="1" value="<?php echo $fecth_cart['quantity'];?>">
                        <input type="submit" value="update" name="update_cart" class="option-btn">
                    </form>
                    <div class="sub-total"> sub total :<span> $<?php echo $sub_total = ($fecth_cart['quantity'] * $fecth_cart['price']);?>/-</span></div>
            </div>
            <?php 
            $grand_total += $sub_total;
                }
                 }else{
                     echo '<p class="empty">no products added yet!</p>';
             };?>
            </div>

           <div class="container-deletes">
             <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)? '':'disable';?>" onclick="return confirm('delete all from cart?');">delete all</a>
           </div>

           <div class="cart-total">
            <p>grand total : <span>$<?php echo $grand_total;?>/-</span></p>
            <div class="flex">
                <a href="shop.php" class="option-btn">continue shopping</a>
                <a href="checkout.php" class="btn <?php echo ($grand_total > 1)? '':'disable';?>">proceed to checkout</a>
            </div>
           </div>
      </section>


      <?php include 'footer.php'?>
    <script src="scrip.js"></script>
</body>
</html>