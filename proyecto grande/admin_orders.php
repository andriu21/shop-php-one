<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
    header('location:login.php');
};

if(isset($_POST['update'])){
    $status = $_POST['update_status'];
    $id = $_POST['id_order'];
    mysqli_query($conn,"UPDATE `orders` SET payment_status = '$status' WHERE id = '$id'") or die('query update failded');
}

if(isset($_POST['delete'])){
    $id = $_POST['id_order'];
    mysqli_query($conn,"DELETE FROM `orders` WHERE id = '$id'") or die('query delete fail');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>orders</title>
    <link rel="stylesheet" href="css-estilos/normalize.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css-estilos/admin_style.css">
</head>
<body>
    <?php include 'admin_header.php';?>
    <h1 class="title">orders</h1>

    <section class="orders">

        <div class="box-container">
            <?php
                $order_details = mysqli_query($conn,"SELECT * FROM `orders`") or die('query 1 failed');
                if(mysqli_num_rows($order_details) > 0){
                    while($fetch_details = mysqli_fetch_assoc($order_details)){
                       
                    
            ?>

            <form action="" method="POST">
                <input type="hidden" name="id_order" value="<?php echo $fetch_details['id'];?>">
                <p>date : <span><?php echo $fetch_details['place_on'];?></span></p>
                <p>name : <span><?php echo $fetch_details['name'];?></span></p>
                <p>number : <span><?php echo $fetch_details['number'];?></span></p>
                <p>email : <span><?php echo $fetch_details['email'];?></span></p>
                <p>method : <span><?php echo $fetch_details['method'];?></span></p>
                <p>address : <span><?php echo $fetch_details['address'];?></span></p>
                <p>products : <span><?php echo $fetch_details['total_product']?></span></p>
                <p>total price : <span>$ <?php echo $fetch_details['total_price']?>/-</span></p>
                <p>status : <span style="color : <?php if($fetch_details['payment_status'] == 'pending'){echo 'var(--red)';}else{echo 'var(--purple)';};
                ?>"> <?php echo $fetch_details['payment_status']?>/-</span></p>
                <select name="update_status">
                    <option value="pending">pending</option>
                    <option value="completed">completed</option>
                </select>
                <div class="box">
                <input type="submit" value="update"  name="update" class="btn">
                <input type="submit" value="delete"  name="delete" class="delete-btn">
                
                </div>
            </form>

            <?php
                    }
                }else{
                    echo '<p class="empty">have not orders pending</p>';
                }
            ?>
            
        </div>
    </section>
    
    <script src="js/admin_script.js"></script>
</body>
</html>