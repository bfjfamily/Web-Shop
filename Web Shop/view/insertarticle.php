<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Insert Article</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
<h2>Insert Article</h3>
<form action="routes.php" method="post" enctype="multipart/form-data">

<input type="text" name="brand" placeholder="Insert brand" value="<?php if(isset($brand)) echo $brand; ?>">
<?php if(isset($errors))if(array_key_exists('brand',$errors)){
    echo $errors['brand'];
}?>
<br><br>
<input type="text" name="model" placeholder="Insert model" value="<?php if(isset($model)) echo $model; ?>">
<?php if(isset($errors))if(array_key_exists('model',$errors)){
    echo $errors['model'];
}?>
<br><br>
<textarea name="description" col="50" rows="4" value=""></textarea>
<?php if(isset($errors))if(array_key_exists('description',$errors)){
    echo $errors['description'];
}?>
<br><br>
<input type="text" name="price" placeholder="Insert price" value="<?php if(isset($price)) echo $price; ?>">
<?php if(isset($errors))if(array_key_exists('price',$errors)){
    echo $errors['price'];
}?>
<br><br>
 <h4>Select an image:</h4>
 <br> <input type="file" name="image"> 
 <?php if(isset($errors))if(array_key_exists('image',$errors)){
    echo $errors['image'];
}?>
<br><br>
<input type="submit" name="page" value="Insert New Article">    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    
</body>
</html>