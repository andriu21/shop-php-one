<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
    header('location:login.php');
};

if(isset($_POST['delete'])){
    $id = $_POST['id'];

    mysqli_query($conn,"DELETE FROM `users` WHERE id = '$id'") or die('query fail');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users</title>
    <link rel="stylesheet" href="css-estilos/normalize.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css-estilos/admin_style.css">
</head>
<body>
    <?php include 'admin_header.php';?>
    <h1 class="title">users</h1>

    <section class="users">
        <div class="box-container">
            <?php   
                $user_query = mysqli_query($conn,"SELECT * FROM `users`");

                if(mysqli_num_rows($user_query) > 0){
                    while($fetch_user = mysqli_fetch_assoc($user_query)){

                   
                
            ?>

            <form action="" method="POST">
                <p><i class="fas fa-user"></i> name : <span><?php echo $fetch_user['name'];?></span></p>
                <p><i class="fas fa-envelope"></i> email : <span><?php echo $fetch_user['email'];?></span></p>
                <p><i class="fas fa-house-user"></i> user type : <span><?php echo $fetch_user['user_type'];?></span></p>
                <input type="hidden" name="id" value="<?php echo $fetch_user['id']?>">
                <input type="submit" value="delete user" name="delete" class="delete-btn">
            </form>
            <?php 
             }
            }else{
                    echo '<p class="empty">have not user</p>';
                }
            ?>
        </div>
    </section>


    <script src="js/admin_script.js"></script>
</body>
</html>