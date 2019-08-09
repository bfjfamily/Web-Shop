<!DOCTYPE html>
<?php
if(!isset($_SESSION)){
    session_start();
   }
if (!isset($_SESSION['user'])){
    //header('Location:login.php?msg2=Morate se ulogovati');
    include 'login.php';
    die();}else if( $_SESSION['user']['admin']!=1){
        //header('Location:login.php?msg2=Morate se ulogovati');
        include 'login.php';
        die();
    }
//var_dump($ulogovan);
?>
<html lang="en">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">      <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Orders</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
<span class="navbar-brand mb-0 h1">WebShop</span>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
      <li class="nav-item">
        <a class="nav-link" href="routes.php?page=showinsert"><strong>Insert new article</strong></a>
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
<div class="container text-center col-8 mt-3 p-2">
    <?php
    require_once '../model/DAO.php';
    $dao= new DAO();
    $orders=$dao->getOrders();

    ?>
<h2>Unprocessed Orders</h2>


<table class="table table-dark text-center table-sm">
<tr>
<th>Order Number</th>
<th>Name</th>
<th>Surname</th>
<th>Email</th>
<th>Phone</th>
<th>Adress</th>
<th>Brand</th>
<th>Model</th>
<th>Price</th>
<th>Count</th>
<th>Total</th>
<th>Sent</th>
<th colspan="2">Action</th>
</tr>  
<?php
$i=0;
foreach($orders as $order){
    if($order['sent']==""){
    ?>
<tr>   
<td><?php echo $order['order_number'] ?></td>
<td><?php echo $order['name'] ?></td>
<td><?php echo $order['surname'] ?></td>
<td><?php echo $order['email'] ?></td>
<td><?php echo $order['phone'] ?></td>
<td><?php echo $order['adress'] ?></td>
<td><?php echo $order['brand'] ?></td>
<td><?php echo $order['model'] ?></td>
<td><?php echo $order['price'] ?></td>
<td><?php echo $order['count'] ?></td>
<td><?php echo $order['total'] ?></td>
<td><?php echo $order['sent'] ?></td>
<td><a href="routes.php?page=sent&order_number=<?php echo $order['order_number'] ?>"><i class="fas fa-check" style="font-size:15px;color:greenyellow;"></i></a></td>
<td><a href="routes.php?page=cancel&order_number=<?php echo $order['order_number'] ?>"><i class="fas fa-trash" style="font-size:15px;color:red;"></i></a></td>
</tr>
<?php
} else if($order['sent']=="yes"){ ?>
<tr bgcolor="lightgreen">
<td><?php echo $order['order_number'] ?></td>
<td><?php echo $order['name'] ?></td>
<td><?php echo $order['surname'] ?></td>
<td><?php echo $order['email'] ?></td>
<td><?php echo $order['phone'] ?></td>
<td><?php echo $order['adress'] ?></td>
<td><?php echo $order['brand'] ?></td>
<td><?php echo $order['model'] ?></td>
<td><?php echo $order['price'] ?></td>
<td><?php echo $order['count'] ?></td>
<td><?php echo $order['total'] ?></td>
<td><?php echo $order['sent'] ?></td>
<td colspan="2"><?php echo "Allready sent" ?></td>
<?php
}else if($order['sent']=="no"){ ?>
    <tr bgcolor="red">
    <td><?php echo $order['order_number'] ?></td>
    <td><?php echo $order['name'] ?></td>
    <td><?php echo $order['surname'] ?></td>
    <td><?php echo $order['email'] ?></td>
    <td><?php echo $order['phone'] ?></td>
    <td><?php echo $order['adress'] ?></td>
    <td><?php echo $order['brand'] ?></td>
    <td><?php echo $order['model'] ?></td>
    <td><?php echo $order['price'] ?></td>
    <td><?php echo $order['count'] ?></td>
    <td><?php echo $order['total'] ?></td>
    <td><?php echo $order['sent'] ?></td>
    <td colspan="2"><?php echo "Canceled" ?></td>
    <?php
    } }
?>
</div>
</table>
<br>
<br>

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
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>