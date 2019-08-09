<?php
require_once '../controllers/Controller.php';

$controller= new Controller();

$page=isset($_GET['page'])?$_GET['page']:"";

$page2=isset($_POST['page'])?$_POST['page']:"";


switch($page){

case 'addtocart':
$controller->addToCart();
break;

case 'showcart':
$controller->showCart();
break;

case 'emptycart':
$controller->emptyCart();
break;

case 'removearticle':
$controller->removeArticle();
break;

case 'showindex':
$controller->showIndex();
break;

case 'Refresh cart':
$controller->refreshCart();
break;

case 'showorder':
$controller->showLogin();
break;

case 'showlogin':
$controller->showLogin();
break;


case 'showregister':
$controller->showRegister();
break;

case 'logout':
    $controller->logout();
    break;

case 'confirm':
    $controller->confirmOrder();
    break;

case 'cancel':
    $controller->cancelOrder();
    break;

case 'showconfirmed':
    $controller->showConfirmedOrder();
    break;

case 'showcanceled':
    $controller->showCanceledOrder();
    break;

    case 'showinsert':
    $controller->showinsert();
    break;

case 'allorders':
    $controller->showAllorders();
    break;

case 'sent':
    $controller->orderSent();
    break;
    
case 'product':
    $controller->showProduct();
    break;

case 'index':
    $controller->index();
    break;

}



switch($page2){


 case 'Register':
$controller->Register();
break;


case 'Login':
$controller->Login();
break;

case 'Order':
$controller->doOrder();
break;

case 'Insert New Article':
$controller->insertNewArticle();
break;
}

?>