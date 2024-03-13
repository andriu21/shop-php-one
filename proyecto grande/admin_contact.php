<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
    header('location:login.php');
};

if(isset($_POST['delete'])){
    $id = $_POST['id'];
    mysqli_query($conn,"DELETE FROM `message` WHERE id = '$id'") or die('query message not ready');
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact</title>
    <link rel="stylesheet" href="css-estilos/normalize.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css-estilos/admin_style.css">
</head>
<body>
    <?php include 'admin_header.php';?>
    <h1 class="title">message</h1>

    <section class="message">
        <div class="box-container">
            <?php 
             $message_query = mysqli_query($conn,'SELECT * FROM `message`') or die('query message fail');
             if(mysqli_num_rows($message_query) > 0){
                while($fetch_message  = mysqli_fetch_assoc($message_query)){

                
            ?>
             <form action="" method="POST">
                <p>name : <span><?php echo $fetch_message['name'];?></span></p>
                <p>email : <span><?php echo $fetch_message['email'];?></span></p>
                <p>number : <span><?php echo $fetch_message['number'];?></span></p>
                <p>message : <?php echo $fetch_message['message'];?></p>
                <input type="hidden" name="id" value="<?php echo $fetch_message['id'];?>">
                <input type="submit" value="delete message" name="delete" class="delete-btn">
             </form>
            <?php 
                    }
                }else{
                echo '<p class="empty">have not message pending</p>';
                }
            ?>
        </div>
    </section>
    <script src="js/admin_script.js"></script>
</body>
</html>