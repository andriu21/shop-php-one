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
    <title>About</title>
</head>
<body>
      <?php include 'config.php'?>
      <?php include 'header.php'?>
     


      <div class="heading">
        <h3>about us</h3>
        <p> <a href="home.php">home</a> / about</p>
      </div>


      <section class="about">

            <div class="flex">
                <div class="image">
                    <img src="img/about.png" alt="about">
                </div>
                <div class="content">
                    <h3>why choose us?</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi harum delectus aperiam quo vero sed, provident dignissimos explicabo eos quaerat, tenetur a incidunt, ipsam cupiditate velit blanditiis enim. Quod, tempore!</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab debitis voluptas, in quod iusto rem a doloremque corporis est odio.</p>
                    <a href="contact.php" class="btn">contact us</a>
                </div>
            </div>
        </section>


      <section class="reviews">
        <h1 class="title">clients reviews</h1>

        <div class="box-container">

            <div class="box">
                <img src="img/pic-1.png" alt="">
                <p>Lorem ipsum, dolos molestiae magnam excepturi et asperiores odit dolor.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="img/pic-2.png" alt="">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem cumque tempora explicabo necessitatibus molestiae magnam excepturi et asperiores odit dolor.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="img/pic-3.png" alt="">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem cumque tempora explicabo necessitatibus molestiae magnam excepturi et asperiores odit dolor.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="img/pic-4.png" alt="">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem cumque tempora explicabo necessitatibus molestiae magnam excepturi et asperiores odit dolor.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="img/pic-5.png" alt="">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem cumque tempora explicabo necessitatibus molestiae magnam excepturi et asperiores odit dolor.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="img/pic-6.png" alt="">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem cumque tempora explicabo necessitatibus molestiae magnam excepturi et asperiores odit dolor.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h3>john deo</h3>
            </div>
        </div>
      </section>
  

      <section class="authors">
        <h1 class="title">Greate authors</h1>
        <div class="box-container">

            <div class="box">
                <img src="img/book-1.png" alt="">

                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>

                <h3>johs deo</h3>

            </div>

            <div class="box">
                <img src="img/book-2.png" alt="">

                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>

                <h3>johs deo</h3>

            </div>
            <div class="box">
                <img src="img/book3.png" alt="">

                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>

                <h3>johs deo</h3>

            </div>

            <div class="box">
                <img src="img/book-3.png" alt="">

                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>

                <h3>johs deo</h3>

            </div>

            <div class="box">
                <img src="img/book-4.png" alt="">

                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>

                <h3>johs deo</h3>

            </div>

            <div class="box">
                <img src="img/book-5.png" alt="">

                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>

                <h3>johs deo</h3>

            </div>

            

        </div>
      </section>
        <?php include 'footer.php'?>

    <script src="scrip.js"></script>
</body>
</html>