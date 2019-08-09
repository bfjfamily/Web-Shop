<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">      <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log in</title>
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
    <!--<form class="form-inline my-2 my-lg-0">
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
    </form>-->
  </div>
</nav>
<div class="container text-center col-5 mt-3 p-2">
<?php 
    $errors=isset($errors)?$errors:array(); 
    $msglogin=isset($msglogin)?$msglogin:"";
    $msg=isset($msg)?$msg:"";
    ?>
    
<h3>Please log in</h3>

<form action="routes.php" method="post">
<input type="text" name="username" value="<?php if(isset($username)) echo $username ?>" placeholder="Username"><?php if (array_key_exists('username', $errors)) {
    echo $errors['username'];
}?><br><br>
<input type="password" name="password" placeholder="Password"><?php if (array_key_exists('password', $errors)) {
    echo $errors['password'];
}?><br><br>
<input type="submit" class="btn btn-outline-success" name="page" value="Login"><br><br>
</form>
<?php echo $msglogin; ?>
<div class="alert alert-warning" role="alert">
Don't have an account? <a href="routes.php?page=showregister" class="alert-link">REGISTER</a> here.
</div>



<?php
if(isset($register)&&$register==1){
?>
<h3>Registration</h3>
<form action="routes.php" method="post">
<input type="text" name="name" value="<?php if(isset($name)) echo $name ?>" placeholder="Name"><?php if (array_key_exists('name', $errors)) {
    echo $errors['name'];
}?><br><br>
<input type="text" name="surname" value="<?php if(isset($surname)) echo $surname ?>" placeholder="Surname"><?php if (array_key_exists('surname', $errors)) {
    echo $errors['surname'];
}?><br><br>
<input type="text" name="email" value="<?php if(isset($email)) echo $email ?>" placeholder="Email"><?php if (array_key_exists('email', $errors)) {
    echo $errors['email'];
}?><br><br>
<input type="text" name="phone" value="<?php if(isset($phone)) echo $phone ?>" placeholder="Phone"><?php if (array_key_exists('phone', $errors)) {
    echo $errors['phone'];
}?><br><br>
<textarea name="adress" cols="22" rows="10" placeholder="Adress"><?php if(isset($adress)) echo $adress ?></textarea><?php if (array_key_exists('adress', $errors)) {
    echo $errors['adress'];
}?><br><br>
<input type="text" name="username" value="<?php if(isset($username)) echo $username ?>" placeholder="Username"><?php if (array_key_exists('username', $errors)) {
    echo $errors['username'];
}?><br><br>
<input type="password" name="password" placeholder="Password"><?php if (array_key_exists('password', $errors)) {
    echo $errors['password'];
}?><br><br>

<input type="submit" name="page" value="Register"><br><br>
</form>

<?php

}

$msg=isset($msg)?$msg:"";
echo $msg;


$error=isset($_GET['error'])?$_GET['error']:"";
echo $error;
?>


</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>