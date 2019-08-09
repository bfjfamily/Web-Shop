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
    <title>Show Cart</title>
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
      <li class="nav-item">
        <a class="nav-link" href="routes.php?page=showindex">Continue shoping</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="routes.php?page=showorder">Order</a>
      </li>
      
    </ul>
    <form class="form-inline my-2 my-lg-0">
    <!--<a href="routes.php?page=emptycart" style="padding-right: 45px">
    <i class="fas fa-shopping-cart" style="font-size:25px"></i>-->
    <a class="btn btn-primary" href="routes.php?page=emptycart" role="button">Empty Cart</a>
    &nbsp;&nbsp;&nbsp;
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

<?php

if(!isset($_SESSION)){
    session_start();
   }
$cart=isset($_SESSION['cart'])?$_SESSION['cart']:array();

//var_dump($cart);
$total=isset($_SESSION['total'])?$_SESSION['total']:array();

$amount=isset($_SESSION['amount'])?$_SESSION['amount']:array();

//var_dump($total);

//echo "<h2>Prikaz kolicina iz sesije</h2>";
//var_dump($amount);

?>
<div class="container text-center col-8 mt-3 p-2">
<h2>Your cart</h2>

<form action="routes.php" method="get">

<table class="table table-dark text-center table-sm">
<div class="form-group">
<tr>
<th>Image</th>
<th>Brand</th>
<th>Model</th>
<th>Price</th>
<th>Count</th>
<th>Total</th>
<th>Action</th>
</tr>

<?php
$i=0;
foreach($cart as $article){
echo "<tr>";
echo "<td class='align-middle'>image</td>";
echo "<td class='align-middle'>$article[brand]</td>";
echo "<td class='align-middle'>$article[model]</td>";
echo "<td class='align-middle'>$article[price]</td>";

?>
<td><input type='text' name='amount[]' value="

<?php if(!empty($amount[$i])&&!empty($amount)){
echo $amount[$i];
}else{
echo 1;
}  ?>"></td>


<td  class='align-middle'><?php if(!empty($_SESSION['total'])&&!empty($total[$i])){echo $total[$i];}else{echo $article['price'];} ?></td>
<?php

echo "<td class='align-middle'><a href='routes.php?page=removearticle&idart=$article[idart]' class='btn btn-primary a-btn-slide-text'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
<span><strong>Delete</strong></span></a></td>";
echo"</tr>";
echo"<input type='hidden' name='idart[]' value='$article[idart]'>";

$i++;
}

?>
</table>
<br>
<br>
<?php
$msg=isset($_GET['msg'])?$_GET['msg']:"";
$msg=isset($msg)?$msg:"";
echo $msg;

?>
<br>
<input type="submit" class="btn btn-outline-success" name="page" value="Refresh cart">
</div>
</div>
</form>
<br>
<br>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>