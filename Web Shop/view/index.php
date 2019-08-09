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

<div>
<?php
if(!isset($msg)){
  $msg=isset($_GET['msg'])?$_GET['msg']:"";
}  else if(empty($msg)){
$msg=isset($msg)?$msg:"";
  }
if(!empty($msg)){
?>
</div>
<div class="d-flex flex-row justify-content-center align-items-center" style="height: 100px;">
<div  class="alert alert-primary text-center mt-1 mb-1 p-1 col-md-3"  role="alert">
<?php echo $msg; ?>
</div>
</div>

<?php } ?>

<!--<div class="container text-center col-8 mt-3 p-2">
<table class="table table-dark text-center table-sm">
<tr>
<th>Brand</th>
<th>Model</th>
<th>Description</th>
<th>Price</th>
<th>Image</th>
<th>Action</th>
</tr>-->
<div class="container-fluid text-center">
  <div class="row">
<?php 
  foreach($allarticles as $article){
?>
<!--
<tr>
<td class="align-middle"><?php /*echo $article['brand']?></td>
<td class="align-middle"><?php echo $article['model']?></td>
<td class="align-middle"><?php echo $article['description']?></td>
<td class="align-middle"><?php echo $article['price']?></td>
<td class="align-middle"><img src="../images/<?php echo $article['image'] ?>" width="80" height="60" /></td>

<td class="align-middle"><a href="routes.php?page=addtocart&idart=<?php echo $article['idart'] ?>"><i class="fas fa-cart-plus" style="font-size:30px"></i></a></td>
</tr>


  <?php } */?>
</table>
  </div>-->
  


<div class='col-sm-3 mb-2 mt-2'>
<div class="card text-center" >
<div class="card">
          <a href="routes.php?page=product&idart=<?php echo $article['idart'] ?>" >
        <img class="card-img-top img-fluid" src="../images/<?php echo $article['image'] ?>" alt="<?php echo $article['image'] ?>" style="height:200px;">
        </a>
            <div class='card-body '>
            <h4><?php echo $article['brand'] ?></h4> 
            <div><p> <?php echo $article['model'] ?> </p></div>
            <div><p><?php echo $article['description'] ?></p></div>
            <div><p><?php echo $article['price'] ?></p></div>
            <!--za datepicker-->
            <div>
            <a href="routes.php?page=product&idart=<?php echo $article['idart'] ?>" class="btn btn-info">Details</a>
            <a href="routes.php?page=addtocart&idart=<?php echo $article['idart'] ?>" class="btn btn-success">Add to Cart</a>
			      </div>
           
          </div>  
          
      </div>
  
    </div>
    </div>
 
    
      <?php } ?> 
      </div>
      </div>
   


<br>
<br>

<?php
/*$msg=isset($_GET['msg'])?$_GET['msg']:"";
$msg=isset($msg)?$msg:"";
echo $msg;*/

?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    
</body>
</html>