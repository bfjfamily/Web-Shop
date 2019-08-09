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
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmed Orders</title>
</head>
<body>
<?php
require_once '../model/DAO.php';
$dao=new DAO();
$orders=$dao->showConfirmed();
?>

<h2>Confirmed Orders</h2>

<table border="2">
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
<th>Confirmation time</th>
<th>Sent</th>
<th>Action<th>
</tr>  
<?php

foreach($orders as $order){
    if($order['sent']=="no"){
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
<td><?php echo $order['confirm_time'] ?></td>
<td><?php echo $order['sent'] ?></td>
<td><a href="routes.php?page=sent&order_number=<?php echo $order['order_number'] ?>">Send</a></td>
</tr>
<?php
}else {
    ?>
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
<td><?php echo $order['confirm_time'] ?></td>
<td><?php echo $order['sent'] ?></td>
<td><?php echo "Allready sent" ?></td>
</tr>
<?php
}
}
?>
</table>

<br>
<br>
<a href="routes.php?page=logout">Logout</a>
<br>
<br>
<a href="routes.php?page=allorders">Back to orders</a>  
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>  
</body>
</html>