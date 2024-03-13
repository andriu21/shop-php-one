<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
    header('location:login.php');
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
    <title>Orders</title>
</head>
<body>
      <?php include 'header.php'?>
      <div class="heading">
        <h3>his orders</h3>
        <p> <a href="home.php">home</a> / orders</p>
      </div>

      <section class="placed-orders">
        <h1 class="title">placed orders</h1>

        <div class="box-container">
          <?php 
            $order_query = mysqli_query($conn,"SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('fail line 34');

            if(mysqli_num_rows($order_query) > 0){
              while($fecth_orders = mysqli_fetch_assoc($order_query)){

            
          ?>
           <div class="box">
           <p> place on : <span><?php echo $fecth_orders['place_on']?></span></p>
            <p> name : <span><?php echo $fecth_orders['name']?></span></p>
            <p> number : <span><?php echo $fecth_orders['number']?></span></p>
            <p> email : <span><?php echo $fecth_orders['email']?></span></p>
            <p> address : <span><?php echo $fecth_orders['address']?></span></p>
            <p> payment method : <span><?php echo $fecth_orders['method']?></span></p>
            <p> your orders : <span><?php echo $fecth_orders['total_product']?></span></p>
            <p> total price : $<span><?php echo $fecth_orders['total_price']?></span></p>
            <p> payment status : <span style="color:<?php
                 if($fecth_orders['payment_status'] == 'pending'){echo 'var(--red)';}else{ {echo 'var(--purple)';}; }?>"><?php echo $fecth_orders['payment_status']?></span></p>
           </div>
          <?php  
              }
            }else{
                echo "<p class='empty'>Not have order pending</p>";
              }
        ?>
        </div>
      </section>
      <?php include 'footer.php'?>
    <script src="scrip.js"></script>
</body>
</html>