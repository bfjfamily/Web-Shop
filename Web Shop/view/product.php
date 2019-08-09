<!DOCTYPE html>
<html>
<?php

if(!isset($_SESSION)){
    session_start();
   }//session_start();
    require_once '../model/DAO.php';

    $dao= new DAO();
    $allarticles=$dao->getAllArticles();

    $cart=isset($_SESSION['cart'])?$_SESSION['cart']:array();
    

    if(!empty($_SESSION['cart'])){
        $counter=count($_SESSION['cart']);
       
    }
?>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">   
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>WebShop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
  
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<span class="navbar-brand mb-0 h1">WebShop</span>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
      <a class="nav-link" href="routes.php?page=index">Home <span class="sr-only">(current)</span></a>
      </li>
      
      
    </ul>
    <form class="form-inline my-2 my-lg-0">
    <a href="routes.php?page=showcart" style="padding-right: 45px">
    <i class="fas fa-shopping-cart" style="font-size:25px"></i>
    <span class="badge badge-pill badge-warning" style="font-size:15px;color:white; position:relative;top: -12px;left: -16px;background:red;"><?php if(isset($counter)) echo $counter  ?></span>
    </a>
    <?php
    if(isset($_SESSION['user'])){?>
    <a class="btn btn-primary" href="routes.php?page=logout" role="button">Logout</a>
    <?php }else{ ?>
    <a class="btn btn-primary" href="routes.php?page=showlogin" role="button">Login</a>
    <?php
    }
    ?>
    </form>
  </div>
</nav>
<div class="row text-center mt-3">
<div class='col-md-4' id='product-img'>
 
 
            <img class="card-img-top img-fluid" src="../images/<?php echo $article['image'] ?>" alt="<?php echo $article['image'] ?>" >
           </div>

<div class='col-md-5'>
 
    <div class='product-detail'>Price:</div>
    <h4 class='m-b-10px price-description'>&#36;<?php echo $article['price'] ?></h4>
 
    <div class='product-detail'>Product description:</div>
    <div class='m-b-10px'>
    
     <h4><?php echo $article['brand'] ?></h4> 
     <div><p> <?php echo $article['model'] ?> </p></div>
     <div><p><?php echo $article['description'] ?></p></div>
     
</div>
 
</div>

<div class='col-md-2'>
 
<BR>
<BR>
<BR>
<a href="routes.php?page=addtocart&idart=<?php echo $article['idart'] ?>" class="btn btn-success">Add to Cart</a>

     
</div>
</div>
</body>
</html>