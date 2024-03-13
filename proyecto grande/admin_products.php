<?php
include 'config.php';
include 'reduceFunction.php';
session_start();

$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
    header('location:login.php');
};

if(isset($_POST['add_product'])){
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    // para leer una imagen se usa $_FILE['image']
    $image_size = $_FILES['image']['size'];
    $image_tpm_name = $_FILES['image']['tmp_name'];
    $image_folder = 'upload_img/'.$image;

    $select_product_name = mysqli_query($conn,"SELECT name FROM `products` 
    WHERE name = '$name'") or die('query failed');

    if(mysqli_num_rows($select_product_name) > 0){
        $message[] = 'products name already added';
    }else{
        $add_product_query = mysqli_query($conn,"INSERT INTO `products`(name,price,image) 
        VALUES('$name','$price','$image')")
         or die('query failded');

         if($add_product_query){
            if($image_size > 2000000){
                $message[] = 'image size is too large';
            }else{
                // para hacer una copia de un achivo que usuario monte carpeta donde esta,destino
                  move_uploaded_file($image_tpm_name,$image_folder);
            $message[] = 'product added successFully';
            }
         }else{
            $message[] = 'product COULD NOT be added';
         }
    }
}
// valida que exista el get
if(isset($_GET['delete'])){
    // esto es para eliminar un registro
    $delete_id = $_GET['delete'];
    $query = mysqli_query($conn,"SELECT image FROM `products` WHERE id = '$delete_id'") or die('fecth failded');
    if(mysqli_num_rows($query) > 0){
        while($fecth = mysqli_fetch_assoc($query)){
            $delete_file = $fecth['image'];
            unlink('upload_img/'.$delete_file);
        };
    };
    mysqli_query($conn,"DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
    // reactualiza la pagina para ver los cambios
    header('location:admin_products.php');
};

if(isset($_POST['update_product'])){
    $update_id = $_POST['update_p_id'];
    $update_name = $_POST['update_name'];
    $update_price = $_POST['update_price'];

    mysqli_query($conn,"UPDATE `products` SET name = '$update_name', price = '$update_price' WHERE id = '$update_id'") or die('query failed');

    $update_image  = $_FILES['update_img']['name'];
    $update_image_tmp = $_FILES['update_img']['tmp_name'];
    $update_image_size = $_FILES['update_img']['size'];
    $update_folder = 'upload_img/'.$update_image;
    $update_old_image = $_POST['update_old_image'];

    if(!empty($update_image)){
        if($update_image_size > 2000000){
            $message[] = 'image file size is too large';
        }else{
            move_uploaded_file($update_image_tmp,$update_folder);
            mysqli_query($conn,"UPDATE `products` SET image = '$update_image' WHERE id = '$update_id'") or die('query failed');

            
            
            // este metodo unlink borra un archivo de donde sea solo necesita la direcion y el archivo
            unlink('upload_img/'.$update_old_image);
           
        }
    }
    header('location: admin_products.php');
    
}

?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>
    <link rel="stylesheet" href="css-estilos/normalize.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css-estilos/admin_style.css">
   
</head>
<body>
    <?php include 'admin_header.php';?>
<!-- upload products to server -->
    <h1 class="title">shop products</h1>

    <section class="add-products">
        <form action="" method="POST" enctype="multipart/form-data">
            <h3>add products</h3>

            <input type="text" name="name" class="box" placeholder="enter product name" require>

            <input type="number" name="price" class="box" placeholder="enter product price" require>

            <input type="file" accept="image/jpg, image/jpeg, image/png"  name="image" class="box" placeholder="enter product name" require>

            <input type="submit" value="add product" name="add_product" class="btn">
        </form>

    </section>

    <!-- show products -->

    <section class="show-products">
    <div class="box-container">
            <?php
             $select_product = mysqli_query($conn,"SELECT * FROM `products`") or die('query failed');

             if(mysqli_num_rows($select_product) > 0){
                while($fetch_products = mysqli_fetch_assoc($select_product)){

               
            ?>
            <div class="box">
                <img src="upload_img/<?php echo  $fetch_products['image'];?>" alt="image">
                <div class="name"><?=  reducer_funtion($fetch_products["name"]);  ?></div>
                <div class="price">$<?php echo $fetch_products['price'];?>/-</div>
                <a href="admin_products.php?update=<?php echo $fetch_products['id'];?>" class="option-btn">update</a>
                <a href="admin_products.php?delete=<?php echo $fetch_products['id'];?>" class="delete-btn" onclick="return confirm('delete this product ?')">delete</a>
            </div>
            <?php
             }
            }else{
               echo '<p class="empty">no products added yet!</p>';
            };
            ?>
            
        </div>
    </section>

    <!-- update products -->

    <section class="edit-product-form">
        <?php
            if(isset($_GET['update'])) {
                $update_id = $_GET['update'];
                $update_query = mysqli_query($conn,"SELECT * FROM `products` WHERE id = '$update_id'") or die('query faild');

                if(mysqli_num_rows($update_query) > 0 ){
                    while($fetch_update = mysqli_fetch_assoc($update_query)){

                    
        ?>
        <!--el enctype ="multipart/form-data" se tiene que usar para el envio masivo de datos -->
        <form action="" method="POST" enctype="multipart/form-data">
               <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id'];?>">

               <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image'];?>">
                <img src="upload_img/<?php echo $fetch_update['image'];?>" alt="">

                <input type="text" name="update_name" value="<?php echo reducer_funtion($fetch_update['name']);?>" class="box" require placeholder="enter product name">

                <input type="number" name="update_price" value="<?php echo $fetch_update['price'];?>" min="0" class="box" require placeholder="enter product price">

                <input type="file" class="box" name="update_img" accept="image/jpg, image/jpeg, image/png, image/PNG">

               <div class="container-btn">
               <input type="submit" value="update" name="update_product" class="btn" id="update">

               <input type="reset" value="cancel" id="close-update" class="option-btn">
               </div>
        </form>

       <?php
                }
                }
            }     
       ?>
    </section>

    <script src="js/admin_script.js"></script>
</body>
</html>