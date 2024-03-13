<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
    header('location:login.php');
};

if(isset($_POST['send'])){
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $messages = mysqli_real_escape_string($conn,$_POST['message']);
    $number = $_POST['number'];

    $select_message = mysqli_query($conn,"SELECT * FROM `message` WHERE 
      name = '$name' AND email = '$email' AND number = 'number' AND message = '$messages'") or die('query faild 1');

      if(mysqli_num_rows($select_message) > 0){
        $message[] = 'message send already!';
      }else{
        mysqli_query($conn,"INSERT INTO `message`(user_id,name,email,number,message) VALUES('$user_id','$name','$email','$number','$messages')") or die('query failed 2');
        $message[] = 'message sent successfully!';
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
    <title>Contact</title>
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
        <h3>contact us</h3>
        <p> <a href="home.php">home</a> / contacts</p>
      </div>


    <section class="contact">
       <form action="" method="POST">
        <h3>say something!</h3>
        <input type="text" name="name" require placeholder="enter your name" class="box">

        <input type="email" name="email" require placeholder="enter your email" class="box">

        <input type="number" name="number" require placeholder="enter your contact number" class="box">

        <textarea name="message" class="box" cols="30" rows="10" placeholder="enter your message" maxlength="200"></textarea>

        <input type="submit" value="send message" name="send" class="btn">
       </form>
    </section>

      <?php include 'footer.php'?>
    <script src="scrip.js"></script>
</body>
</html>