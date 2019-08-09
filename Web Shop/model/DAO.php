<?php
require_once '../config/db.php';

class DAO {

 private $db;

 private $GETALLARTICLES="SELECT * FROM articles ORDER BY brand ASC";

 private $GETARTICLEBYIDART="SELECT * FROM articles WHERE idart=?";

 private $REGISTER="INSERT INTO users(name,surname,email,adress,phone,username,password,admin) VALUES(?,?,?,?,?,?,?,?)";

 private $LOGIN="SELECT * FROM users WHERE username=? AND password=?";

 private $INSERTORDER="INSERT INTO orders(id_user,order_number,name,surname,email,phone,adress,id_art,brand,model,price,count,total,time) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP)";

 private $ORDERNUMBER="SELECT MAX(order_number) FROM orders";

 private $USERCHECK="SELECT username FROM users WHERE username=?";

 private $PASSCHECK="SELECT password FROM users WHERE password=?";

 private $GETORDERS="SELECT * FROM orders ORDER BY order_number DESC";
 
 private $GETORDERSBYID="SELECT * FROM orders WHERE order_number=?";

 //private $INSERTCONFIRMED="INSERT INTO confirmed (id_user,order_number,name,surname,email,phone,adress,id_art,brand,model,price,count,total,time_order,confirm_time,sent) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP,?)";

 //private $INSERTCANCELED="INSERT INTO canceled (id_user,order_number,name,surname,email,phone,adress,id_art,brand,model,price,count,total,time_order,cancel_time) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP)";

 private $DELETEMOVED="DELETE FROM orders WHERE order_number=?";  

// private $SHOWCONFIRMED="SELECT * FROM confirmed";

 //private $SHOWCANCELED="SELECT * FROM canceled";

 private $INSERTNEWARTICLE="INSERT INTO articles (brand,model,description,price,image) VALUES (?,?,?,?,?)";

 private $ORDERSENT="UPDATE orders SET sent='yes' WHERE order_number=?"; 

 private $ORDERCANCEL="UPDATE orders SET sent='no' WHERE order_number=?"; 

 public function __construct(){
    $this->db=DB::createInstance();
}

public function getAllArticles(){
    $statement = $this->db->prepare($this->GETALLARTICLES);
    $statement->execute();
    $result=$statement->fetchAll();
    return $result;
    }

    public function getArticleById($idart){
        $statement = $this->db->prepare($this->GETARTICLEBYIDART);
        $statement->bindValue(1,$idart);

        $statement->execute();
        $result=$statement->fetch();
        return $result;
     }
    
     public function register($n,$s,$e,$a,$p,$u,$pass,$ad){
        $statement = $this->db->prepare($this->REGISTER);
        $statement->bindValue(1,$n);
        $statement->bindValue(2,$s);
        $statement->bindValue(3,$e);
        $statement->bindValue(4,$a);
        $statement->bindValue(5,$p);
        $statement->bindValue(6,$u);
        $statement->bindValue(7,$pass);
        $statement->bindValue(8,$ad);
        
        $statement->execute();
        
     
     }

     public function login($u,$p){
        $statement = $this->db->prepare($this->LOGIN);
        $statement->bindValue(1,$u);
        $statement->bindValue(2,$p);
        $statement->execute();

        $result=$statement->fetch();
        return $result;
     }


     public function insertOrder($id_user,$order_n,$name,$surname,$email,$phone,$adress,$id_art,$brand,$model,$price,$count,$total){
      $statement = $this->db->prepare($this->INSERTORDER);
      $statement->bindValue(1,$id_user);
      $statement->bindValue(2,$order_n);
      $statement->bindValue(3,$name);
      $statement->bindValue(4,$surname);
      $statement->bindValue(5,$email);
      $statement->bindValue(6,$phone);
      $statement->bindValue(7,$adress);
      $statement->bindValue(8,$id_art);
      $statement->bindValue(9,$brand);
      $statement->bindValue(10,$model);
      $statement->bindValue(11,$price);
      $statement->bindValue(12,$count);
      $statement->bindValue(13,$total);

      $statement->execute();
   }
   public function orderNumber(){
      $statement = $this->db->prepare($this->ORDERNUMBER);
      $statement->execute();
      $result=$statement->fetch(PDO::FETCH_NUM);
      return $result;
  }
  public function userCheck($u){
   $statement = $this->db->prepare($this->USERCHECK);
   $statement->bindValue(1,$u);
   $statement->execute();
   $result=$statement->fetch();
   return $result;
}
  public function passCheck($p){
   $statement = $this->db->prepare($this->PASSCHECK);
   $statement->bindValue(1,$p);
   $statement->execute();
   $result=$statement->fetch();
   return $result;
}

public function getOrders(){
   $statement = $this->db->prepare($this->GETORDERS);
   $statement->execute();
   $result=$statement->fetchAll();
   return $result;
   }
public function getOrdersById($order_number){
   $statement = $this->db->prepare($this->GETORDERSBYID);
   $statement->bindValue(1,$order_number);
   $statement->execute();
   $result=$statement->fetchAll();
   return $result;
   }

  /* public function insertConfirmed($id_user,$order_n,$name,$surname,$email,$phone,$adress,$id_art,$brand,$model,$price,$count,$total,$time,$sent){
      $statement = $this->db->prepare($this->INSERTCONFIRMED);
      $statement->bindValue(1,$id_user);
      $statement->bindValue(2,$order_n);
      $statement->bindValue(3,$name);
      $statement->bindValue(4,$surname);
      $statement->bindValue(5,$email);
      $statement->bindValue(6,$phone);
      $statement->bindValue(7,$adress);
      $statement->bindValue(8,$id_art);
      $statement->bindValue(9,$brand);
      $statement->bindValue(10,$model);
      $statement->bindValue(11,$price);
      $statement->bindValue(12,$count);
      $statement->bindValue(13,$total);
      $statement->bindValue(14,$time);
      $statement->bindValue(15,$sent);

      $statement->execute();
   }

   public function insertCanceled($id_user,$order_n,$name,$surname,$email,$phone,$adress,$id_art,$brand,$model,$price,$count,$total,$time){
      $statement = $this->db->prepare($this->INSERTCANCELED);
      $statement->bindValue(1,$id_user);
      $statement->bindValue(2,$order_n);
      $statement->bindValue(3,$name);
      $statement->bindValue(4,$surname);
      $statement->bindValue(5,$email);
      $statement->bindValue(6,$phone);
      $statement->bindValue(7,$adress);
      $statement->bindValue(8,$id_art);
      $statement->bindValue(9,$brand);
      $statement->bindValue(10,$model);
      $statement->bindValue(11,$price);
      $statement->bindValue(12,$count);
      $statement->bindValue(13,$total);
      $statement->bindValue(14,$time);

      $statement->execute();
   }
   public function deleteMoved($order_number){
      $statement = $this->db->prepare($this->DELETEMOVED);
      $statement->bindValue(1,$order_number);
      $statement->execute();
   }
   public function showConfirmed(){
      $statement = $this->db->prepare($this->SHOWCONFIRMED);
      $statement->execute();
      $result=$statement->fetchAll();
      return $result;
      }
   public function showCanceled(){
      $statement = $this->db->prepare($this->SHOWCANCELED);
      $statement->execute();
      $result=$statement->fetchAll();
      return $result;
      }*/
      public function insertNewArticle($brand,$model,$description,$price,$image){
         $statement = $this->db->prepare($this->INSERTNEWARTICLE);
         $statement->bindValue(1,$brand);
         $statement->bindValue(2,$model);
         $statement->bindValue(3,$description);
         $statement->bindValue(4,$price);
         $statement->bindValue(5,$image);
         $statement->execute();
     }
     public function orderSent($order_n){
      $statement = $this->db->prepare($this->ORDERSENT);
      $statement->bindValue(1,$order_n);
            $statement->execute();
   } 
     /*public function orderCancel($order_n){
      $statement = $this->db->prepare($this->ORDERCANCEL);
      $statement->bindValue(1,$order_n);
            $statement->execute();
   }*/
   
   public function orderCancel($order_number){
      $statement = $this->db->prepare($this->DELETEMOVED);
      $statement->bindValue(1,$order_number);
      $statement->execute();
   }

}




?>