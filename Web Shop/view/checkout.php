<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">      <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout</title>
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
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      
    </ul>
    <form class="form-inline my-2 my-lg-0">
    <h4>User:<?php echo $_SESSION['user']['name'];?></h4> &nbsp;&nbsp;
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
        if(isset($_SESSION['user'])){

    ?>




<?php
$user=$_SESSION['user'];

// za prikaz podataka iz korpe


$cart=isset($_SESSION['cart'])?$_SESSION['cart']:array();
$total=isset($_SESSION['total'])?$_SESSION['total']:array();
$amount=isset($_SESSION['amount'])?$_SESSION['amount']:array();


?>
<div class="container text-center col-8 mt-3 p-2">
<h2>Your cart</h2>

<form action="routes.php" method="post">
<div class="form-group">
<table class="table table-dark text-center table-sm">

<tr>
<th>Image</th>
<th>Brand</th>
<th>Model</th>
<th>Price</th>
<th>Count</th>
<th>Total</th>

</tr>

<?php
$i=0;
foreach($cart as $article){
echo "<tr>";
echo "<td>image</td>";
echo "<td>$article[brand]</td>";
echo "<td>$article[model]</td>";
echo "<td>$article[price]</td>";

?>
<td><input type='text' name='amount[]' value="

<?php if(!empty($amount[$i])&&!empty($amount)){
echo $amount[$i];
}else{
echo '1';
}  ?>" readonly="readonly"></td>


<td><?php if(!empty($_SESSION['total'])&&!empty($total[$i])){echo $total[$i];}else{echo $article['price'];} ?></td>
<?php


$i++;
}

?>

</table>
</div>


<div class="container text-center col-4">
<div class="form-group">
<input type="text" class="form-control" name="name" value="<?php echo $user['name'];?>"><br>
<input type="text" class="form-control" name="surname" value="<?php echo $user['surname'];?>"><br>
<input type="text" class="form-control" name="email" value="<?php echo $user['email'];?>"><br>
<input type="text" class="form-control" name="phone" value="<?php echo $user['phone'];?>"><br>
<textarea name="adress" class="form-control"><?php echo $user['adress'];?></textarea><br>
<input type="hidden" name="iduser" value="<?php echo $user['user_id'];?>"><br>


<input type="submit" class="btn btn-outline-success" name="page" value="Order">
</div>
</form>
</div>


<?php
  }else{
      header('Location:login.php');
  }

?>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>