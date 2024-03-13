<?php
include'config.php';

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pass = mysqli_real_escape_string($conn,md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn,md5($_POST['cpassword']));
    $user_type = $_POST['user_type'];

    $select_users = mysqli_query($conn,"SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'; ") or die ('query failed');

     if(mysqli_num_rows($select_users) > 0){
        $message[] = 'user alredy exist!';
     }else{
       if($pass != $cpass){
        $message[] = 'confirm password not matched!';
       }else{
       
         mysqli_query($conn,"INSERT INTO `users`(name,email,password,user_type) VALUES('$name','$email','$cpass','$user_type')") or die("query failedfully");
          $message[] = 'registered successfully!';
          header('location: login.php');
       };
     };
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css-estilos/normalize.css">
    <title>register</title>
    <!-- fonst -->
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css-estilos/estilos2.css">
</head>
<body>


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

<div class="form-container">

    <form action="" method="POST">
        <h3>register now</h3>
         <input type="text" name="name" placeholder="enter your name" require class="box">
         <input type="email" name="email" placeholder="enter your email" require class="box">
         <input type="password" name="password" placeholder="enter your password" require class="box">
         <input type="password" name="cpassword" placeholder="confirm your password" require class="box">
         <select name="user_type" class="box">
            <option value="user">user</option>
            <option value="admin">admin</option>
         </select>
         <input type="submit" name="submit" value="register now" class="btn">
         <p>already have an account? <a href="login.php">login now</a></p>
    </form>

</div>









    <script src="scrip.js"></script>
</body>
</html>