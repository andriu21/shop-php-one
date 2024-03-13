<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
    header('location:login.php');
};

if(isset($_POST['order_btn'])){
    $name =  mysqli_real_escape_string($conn,$_POST['name']);
    $number = $_POST['number'];
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $address = mysqli_real_escape_string($conn,'flat no'.$_POST['flat'].', '.$_POST['street'].', '.$_POST['city'].', '.$_POST['country'].', '.$_POST['pin_code']);
    $placed_on = date('D-M-Y');
    $cart_total = 0 ;
    $cart_products[]='';
    $method = $_POST['method'];

    $cart_query = mysqli_query($conn,"SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query fails 1');

    if(mysqli_num_rows($cart_query) > 0){
        while($cart_item = mysqli_fetch_assoc($cart_query)){
            $cart_product[] = $cart_item['name'].'('.$cart_item['quantity'].')';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        };
    };
    // el methodo implode crea un sting apartir de un array parametro 1 la separacion que deseo parametro 2 el array a combertir
    $total_products = implode(', ',$cart_product);
    
    $order_query = mysqli_query($conn,"SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_product = '$total_products' AND total_price = '$cart_total' AND place_on = '$placed_on'") or die('query faild order query 1');

    if($cart_total == 0){
        $message[] = 'your cart is empty';
    }else{
        if(mysqli_num_rows($order_query) > 0){
            $message[] = 'order already placed';
        }else{
            mysqli_query($conn,"INSERT INTO `orders`(user_id,name,number,email,method,address,total_product,total_price,place_on) VALUES('$user_id','$name','$number','$email','$method','$address','$total_products','$cart_total','$placed_on')") or  die('query insert ');
            $message[] = 'pay successfully';
            mysqli_query($conn,"DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query delete dail');
        };
    };
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
    <title>Checkout</title>
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
        <h3>checkout</h3>
        <p> <a href="home.php">home</a> / checkout</p>
      </div> 

      <section class="display-order">
            <?php 
            $select_cart = mysqli_query($conn,"SELECT * FROM `cart` Where user_id = '$user_id'") or die('query failded 1');
            $grand_total = 0;

            if(mysqli_num_rows($select_cart) > 0){
                while($fecth_cart = mysqli_fetch_assoc($select_cart)){
                    $total_price = ($fecth_cart['price'] * $fecth_cart['quantity']);
                    $grand_total += $total_price;
                
            ?>
            <p><?php echo $fecth_cart['name'];?> 
            <span>(<?php echo '$'.$fecth_cart['price'].'$'.'x'.$fecth_cart['quantity']?>)
            </span> </p>
             <?php
                    }
                }else{
                    echo '<p class="empty">your cart is empty</p>';
                };
            ?>

            <div class="grand_total">Grand total: <span>$<?php echo $grand_total;?></span></div>
      </section>


    

      <section class="checkout">
        <form action="" method="POST">
            <h3>place your orders</h3>
            <div class="flex">

                <div class="inputBox">
                    <span>your name: </span>
                    <input type="text" name="name" require placeholder="enter your name">
                </div>

                <div class="inputBox">
                    <span>your number: </span>
                    <input type="number" name="number" require placeholder="enter your number">
                </div>

                <div class="inputBox">
                    <span>your email: </span>
                    <input type="email" name="email" require placeholder="enter your email">
                </div>

                <div class="inputBox">
                    <span>payment method : </span>
                    <select name="method">
                        <option value="paypal">paypal</option>
                        <option value="paytm">paytm</option>
                        <option value="credit card">credit card</option>
                        <option value="cash on delivery">cash on delivery</option>
                    </select>
                </div>

                <div class="inputBox">
                    <span>address line 01 : </span>
                    <input type="number" min="0" name="flat" require placeholder="enter your address">
                </div>

                <div class="inputBox">
                    <span>address line 02 : </span>
                    <input type="text"  name="street" require placeholder="enter your street name">
                </div>

                <div class="inputBox">
                    <span>city : </span>
                    <input type="text"  name="city" require placeholder="enter your city name">
                </div>

                <div class="inputBox">
                    <span>state : </span>
                    <input type="text"  name="state" require placeholder="enter your state name">
                </div>

                <div class="inputBox">
                    <span>country : </span>
                    <input type="text"  name="country" require placeholder="enter your country name">
                </div>

                <div class="inputBox">
                    <span>postal code : </span>
                    <input type="number" min="0" name="pin_code" require placeholder="enter your postal code">
                </div>

                <input type="submit" value="order now" class="btn" name="order_btn">
            </div>
        </form>
      </section>

      <?php include 'footer.php'?>
    <script src="scrip.js"></script>
</body>
</html>