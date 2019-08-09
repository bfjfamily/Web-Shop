<?php
require_once '../model/DAO.php';

class Controller{



    public function addToCart(){

    
        $dao = new DAO();
        $idart=isset($_GET['idart'])?$_GET['idart']:"";
       
         $article=$dao->getArticleById($idart);
  
     if($article){
  // startovanje sesije i pakovanje artikala u sesiju.
  
     session_start();
  
  if(!isset($_SESSION['cart'])){
      $_SESSION['cart']=array();
      $_SESSION['cart'][]=$article;
      $msg="Article added to cart";
      //include 'index.php';
      header( 'Location:index.php?msg=Article added to cart');
  
  }else if(!empty($_SESSION['cart'])){
    
      
      if(in_array($idart, array_column($_SESSION['cart'], 'idart'))) { // pretraga vrednosti u nizu
      $msg="Article is already in the cart";
      //include 'index.php';
      header( 'Location:cart.php?msg=Article has already been selected, please set  quantity and refresh cart');
          }else { 
              $_SESSION['cart'][]=$article;
              $msg="New article has been added to cart";
              //include 'index.php';
              header( 'Location:index.php?msg=New article has been added to cart');
          }
      
         }
     }else{
         echo "Error with id article";
         include 'index.php';
     }
  }

  public function showCart(){
    session_start();
    if(isset($_SESSION['cart'])){
    header('Location:cart.php');
} else {
    $msg="Your cart is empty";
    //session_abort();
    include 'index.php';
    //header('Location:index.php?msg=Your cart is empty');
}
}

public function emptyCart(){

    session_start();

    if(!empty($_SESSION['cart'])&!isset($_SESSION['user'])){
        unset($_SESSION['cart']);
        unset($_SESSION['total']);
        unset($_SESSION['amount']);
        $msg="Cart is empty.";
        include 'index.php';

        if(isset($_SESSION['user'])){
        if($_SESSION['user']['admin']==1){
            include 'allorders.php';
        }else  if(isset($_SESSION['user'])&$_SESSION['user']['admin']!=1){
        $msg="Cart is empty.";
        include 'index.php';
        }}
        //session_destroy();
        
    }elseif($_SESSION['user']['admin']==1){
        include 'allorders.php';
    } else {
        header('Location:index.php');
    }
}


public function removeArticle(){

    $idart=isset($_GET['idart'])?$_GET['idart']:"";
     session_start();
    //var_dump($idart);
    echo "<br>";
    //var_dump($_SESSION['cart']);


if(!empty($_SESSION['cart'])){
foreach($_SESSION['cart'] as $item =>$it){

//Posto je korpa niz nizova moramo u foreach petlju da ubacimo kljuc i vrednost
// kako bi rastavili korpu na pojedinacne nizove tj proizvode ( dodajemo novu promenljivu $it)
// i kako bi nasli gde se id proizvoda iz korpe slaze sa id-em koji je stigao ovde

    if($it['idart']==$idart){
     //   echo "nasao";
   //  var_dump($_SESSION['cart']);
     //echo "<br>";
     //echo "<br>";
     //echo "<br>";

     // brisanje iz sesije korpa samo jednog proizvoda 
     unset($_SESSION['cart'][$item]);
     //var_dump($_SESSION['cart']);
     header('Location:cart.php');
    }
   
}

}



}

public function showIndex(){
 session_start();
    include 'index.php';
}

public function refreshCart(){
 $idart=isset($_GET['idart'])?$_GET['idart']:array();
$amount=isset($_GET['amount'])?$_GET['amount']:array();

session_start();

// kreiranje praznog niza za sumu cena 
$total=array();
//brojac u pocetku jednak nuli da bi niz suma krenuo od prvog elementa u nizu tj od pozicije nula
$i=0;

foreach($idart as $id){

    $dao=new DAO();

    $article=$dao->getArticleById($id);

    // od jednog artikla koji je pronasla petlja uzimamo cenu i mnozimo sa kolicinom 
    // i dobijamo ukupnu cenu za taj jedan artikal
    $sum=$article['price']*$amount[$i];

    // ukupnu cenu za svaki artikal upisujemo u niz koji smo nazvali total
    $total[]=$sum;
    $i++;

}

$_SESSION['total']=$total;
$_SESSION['amount']=$amount;
header('Location:cart.php');
}


public function showLogin(){

    session_start();
    if(!empty($_SESSION['cart'])&empty($_SESSION['amount'])){
        $counter=count($_SESSION['cart']);
        //var_dump($counter);
        $tot=array();
        $qty=array();
        for ($x = 0; $x < $counter; $x++) {
            $total[$x]=$_SESSION['cart'][$x]['price'];
            $amount[$x]=1;
            $tot[]=$total[$x];
            $qty[]=$amount[$x];
            //var_dump($total[$x]);
        } 
        $_SESSION['total']=$tot;
        $_SESSION['amount']=$qty;
        //var_dump($tot);
        //var_dump($qty);
        //var_dump($_SESSION['total']);
        //var_dump($_SESSION['amount']);
        
    }
   
   
    
 
   //////////////////////////////////////////////     
    //session_start();
    //var_dump($_SESSION['user']);
    if(!isset($_SESSION['user'])){
    
    include 'login.php';
    }else if($_SESSION['user']['admin']==1){
        $msg="Welcome admin";
        include 'allorders.php';
        
    }else{
        include 'checkout.php';
    }
}


public function showRegister(){
   $register=1;
    include 'login.php';
}

public function Register(){

    $name=isset($_POST['name'])?$_POST['name']:"";
    $surname=isset($_POST['surname'])?$_POST['surname']:"";
    $email=isset($_POST['email'])?$_POST['email']:"";
    $phone=isset($_POST['phone'])?$_POST['phone']:"";
    $adress=isset($_POST['adress'])?$_POST['adress']:"";
    $username=isset($_POST['username'])?$_POST['username']:"";
    $password=isset($_POST['password'])?$_POST['password']:"";

    $errors=array();

    $dao=new DAO;
    $check=$dao->userCheck($username);
    
    if(empty($name)){
        $errors['name']="Please insert your name";
    } else if(is_numeric($name)){
        $errors['name']="Name can not be number";
    }else if (preg_match("/[^A-Za-z]/", $name))
    {
        $errors['name']="Name must contain only big or small letters";
    }

    if(empty($surname)){
        $errors['surname']="Please insert your surname";
    } else if(is_numeric($surname)){
        $errors['surname']="Surname can not be number";
    }else if (preg_match("/[^A-Za-z]/", $surname)) 	
    {
        $errors['surname']="Surname must contain only big or small letters";
    }

    if(empty($email)){
        $errors['email']="Please insert your email";
    } else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors['email']="Please insert valid email";
    } 

    if(empty($phone)){
        $errors['phone']="Please insert your phone";
    }
    if(!is_numeric($phone)){
        $errors['phone']="Phone must be number";
    } else if (strlen($phone)<8){
        $errors['phone']="Phone must have at least 8 digits";
    }

    if(empty($adress)){
        $errors['adress']="Please insert your adress";
    }else if(preg_match("/[^A-Za-z0-9\ ]/", $adress))
    {
        $errors['adress']="Invalid characters used in adress.Only letters and numbers allowed";
    }

    if(empty($username)){
        $errors['username']="Please insert your username";
    }else if(preg_match("/[^A-Za-z0-9\!@]/", $username))
    {
        $errors['username']="Invalid characters used in username.Only letters and numbers allowed";
    }else if($check==$username){
        $errors['username']="Username is already taken";
    }

    if(empty($password)){
        $errors['password']="Please insert your password";
    } else if(strlen($password)<6){
        $errors['password']="Password must have more than 6 characters";
    }else if(preg_match("/[^A-Za-z0-9]/", $password))
    {
        $errors['password']="Invalid characters used in password.Only letters and numbers allowed";
    }

    if(count($errors)==0){

        $dao=new DAO();
  
       $admin=0;
        $dao->register($name,$surname,$email,$adress,$phone,$username,$password,$admin);

        $msg="Registration success";
        include 'login.php';

    }else{
        $register=1;
        $msg="Registration failed, please input all fields.";
        include 'login.php';

    }

}



public function Login(){
    $username=isset($_POST['username'])?$_POST['username']:"";
    $password=isset($_POST['password'])?$_POST['password']:"";

    $dao=new DAO;
    $checkuser=$dao->userCheck($username);
    $checkpass=$dao->passCheck($password);

    $errors=array();
    if(empty($username)){
        $errors['username']="Please insert your username";
    } else if(preg_match("/[^A-Za-z0-9\!]/", $username))
    {
        $errors['username']="Invalid characters used in username.Only letters and numbers allowed";
    }    /*else if(empty($checkuser)){
        $errors['username']="Username doesn`t exists";
    }*/
    if(empty($password)){
        $errors['password']="Please insert your password";
    }else if(preg_match("/[^A-Za-z0-9\!@]/", $password))
    {
        $errors['password']="Invalid characters used in username.";
    }/*else if(empty($checkpass))
    {
        $errors['password']="Password doesn`t match.";
    }*/

    if(count($errors)==0){

        $dao=new DAO();

        $user=$dao->login($username,$password);

        if($user){
          session_start();
          $_SESSION['user']=$user;
          if( $_SESSION['user']['admin']!=1&!isset($_SESSION['cart'])){
          $msg="Login success";
          include 'index.php';
  
    }else if($_SESSION['user']['admin']==1){
        $msg="Welcome admin";
        include 'allorders.php';
    }else if( $_SESSION['user']['admin']!=1&!empty($_SESSION['cart'])){
        $msg="Login success";
          include 'checkout.php';
    }
       
}else{
    $msg="Incorrect username or password";
    include 'login.php';
   }
}
}


public function doOrder(){
//kupljenje podataka korisnika

    $name=isset($_POST['name'])?$_POST['name']:"";
    $surname=isset($_POST['surname'])?$_POST['surname']:"";
    $email=isset($_POST['email'])?$_POST['email']:"";
    $phone=isset($_POST['phone'])?$_POST['phone']:"";
    $adress=isset($_POST['adress'])?$_POST['adress']:"";
    $id_user=isset($_POST['iduser'])?$_POST['iduser']:"";
  
    session_start();

    $cart=isset($_SESSION['cart'])?$_SESSION['cart']:array();
    $total=isset($_SESSION['total'])?$_SESSION['total']:array();
    $amount=isset($_SESSION['amount'])?$_SESSION['amount']:array();
    
   $errors=array();

   if(empty($name)){
       $errors['name']="Please enter your name";
   }
   if(empty($surname)){
    $errors['surname']="Please enter your surname";
   }
   if(empty($email)){
    $errors['email']="Please enter your email";
   }
   if(empty($phone)){
    $errors['phone']="Please enter your phone";
   }
   if(empty($adress)){
    $errors['adress']="Please enter your adress for shiping";
   }
       if(count($errors)==0){
              $dao=new DAO();

 //drugi parametar je broj porudzbine a to kreiramo mi ovde nemamo podatak sa forme
            
 $order=$dao->orderNumber();
 //var_dump($order);
 //drugi parametar je broj porudzbine
 //$broj=1;  

            $order_n=max($order);
             settype($order_n,'integer');
             //var_dump($order_n);
             $order_n++;
             //var_dump($order_n);
             
            $i=0;
             //var_dump($amount[$i]);
             //var_dump($total[$i]);
             
             //settype($order_n,'integer');
             
             foreach($cart as $c){
                 $id_art=$c['idart'];
                 $brand=$c['brand'];
                 $model=$c['model'];
                 $price=$c['price'];
                 $count=$amount[$i];
                 $total1=$total[$i];
                 $dao->insertOrder($id_user,$order_n,$name,$surname,$email,$phone,$adress,$id_art,$brand,$model,$price,$count,$total1);
                 $i++;
                 //var_dump($count);
                 //var_dump($total1);
             }
                 //var_dump($count);
                 //var_dump($total);
                 include 'thankyou.php';
 
             
             
         }else{
             //var_dump($errors);
             include 'checkout.php';
         }
         
     
 }
 public function logout(){
    //session_start();
    
    session_start();
    
        session_unset();
        session_destroy();
        //$msg="Cart is empty.";
        header('Location:index.php');
    /*else{
        header('Location:index.php');
    }*/
}

/*public function confirmOrder(){

    $dao=new DAO();
    $order_number=isset($_GET['order_number'])?$_GET['order_number']:"";
    //settype($order_number, "integer");
    //var_dump($order_number);
    
    $order=$dao->getOrdersById($order_number);
    
    foreach($order as $o){
        $id_user=$o['id_user'];
        $order_n=$o['order_number'];
        $name=$o['name'];
        $surname=$o['surname'];
        $email=$o['email'];
        $phone=$o['phone'];
        $adress=$o['adress'];
        $id_art=$o['id_art'];
        $brand=$o['brand'];
        $model=$o['model'];
        $price=$o['price'];
        $count=$o['count'];
        $total=$o['total'];
        $time=$o['time'];
        $sent="no";

        $dao->insertConfirmed($id_user,$order_n,$name,$surname,$email,$phone,$adress,$id_art,$brand,$model,$price,$count,$total,$time,$sent);
    }
    $dao->deleteMoved($order_number);
    $msg="Order Confirmed";
    include 'allorders.php';
}
public function cancelOrder(){

    $dao=new DAO();
    $order_number=isset($_GET['order_number'])?$_GET['order_number']:"";
    //settype($order_number, "integer");
    //var_dump($order_number);
    
    $order=$dao->getOrdersById($order_number);
    
    foreach($order as $o){
        $id_user=$o['id_user'];
        $order_n=$o['order_number'];
        $name=$o['name'];
        $surname=$o['surname'];
        $email=$o['email'];
        $phone=$o['phone'];
        $adress=$o['adress'];
        $id_art=$o['id_art'];
        $brand=$o['brand'];
        $model=$o['model'];
        $price=$o['price'];
        $count=$o['count'];
        $total=$o['total'];
        $time=$o['time'];

        $dao->insertCanceled($id_user,$order_n,$name,$surname,$email,$phone,$adress,$id_art,$brand,$model,$price,$count,$total,$time);
    }
    $dao->deleteMoved($order_number);
    $msg="Order Canceled";
    include 'allorders.php';
}

public function showConfirmedOrder(){
    
    include 'confirmedorders.php';
}

public function showCanceledOrder(){
    
    include 'canceledorders.php';
}*/
public function showAllorders(){
    include 'allorders.php';
    //header('Location:allorders.php');
}
public function showinsert(){
    include 'insertarticle.php';
}

public function insertNewArticle(){
    $brand=isset($_POST['brand'])?$_POST['brand']:"";
    $model=isset($_POST['model'])?$_POST['model']:"";
    $description=isset($_POST['description'])?$_POST['description']:"";
    $price=isset($_POST['price'])?$_POST['price']:"";
    $image=isset($_FILES['image']['name'])?$_FILES['image']['name']:"";

    $target = "../images/";        
    $targetFilePath = $target . $image;
    $fileType = strtolower(pathinfo($targetFilePath,PATHINFO_EXTENSION));
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    $errors=array();

    if(empty($brand)){
        $errors['brand']="Please insert brand";
    } else if(is_numeric($brand)){
        $errors['brand']="Brand can not be number";
    }

    if(empty($model)){
        $errors['model']="Please insert model";
    } 

    if(empty($description)){
        $errors['description']="Please insert description";
    }
    if(empty($price)){
        $errors['price']="Please insert price";
        
    }else if($price <=0){
        $errors['price']="Price too low";
    }

    
if(count($errors)==0){

$dao=new DAO();
$dao->insertNewArticle($brand,$model,$description,$price,$image);


if(in_array($fileType, $allowTypes)){
   if( move_uploaded_file($_FILES['image']['tmp_name'],$target.$image)){
    $msg_img = "Image uploaded successfully";
   }else if(file_exists('../images/'.$image)){
    $msg_img = "Image already exists";  
   }
}

$msg_img=isset($msg_img)?$msg_img:"";
echo "<br>".$msg_img."<br>";


$msg="Article inserted";

header('Location:index.php?msg=Article inserted');
include 'index.php';
//var_dump($image);

} else {
include 'insertarticle.php';
echo "please try again<br>";
/*echo '<pre>' , var_dump($image);
echo '<pre>' , var_dump($model);
echo '<pre>' , var_dump($brand);
echo '<pre>' , var_dump($description);
echo '<pre>' , var_dump($price);
var_dump($errors);*/
}


}

public function orderSent(){
    $dao=new DAO();
    $order_number=isset($_GET['order_number'])?$_GET['order_number']:"";
    $dao->orderSent($order_number);
    $dao->getOrders();
    include 'allorders.php';
}
public function cancelOrder(){
    $dao=new DAO();
    $order_number=isset($_GET['order_number'])?$_GET['order_number']:"";
    $dao->orderCancel($order_number);
    $dao->getOrders();
    include 'allorders.php';
}
public function showProduct(){
    $dao=new DAO();
    $idart=isset($_GET['idart'])?$_GET['idart']:"";
       
    $article=$dao->getArticleById($idart);
    include 'product.php';
}

public function index(){
    //header( 'Location:index.php');
    include 'index.php';
}

}

?>