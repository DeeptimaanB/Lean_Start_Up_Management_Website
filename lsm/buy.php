<?php
require_once 'pdo.php';
session_start();
if(isset($_GET['x']) && isset($_SESSION['user']) && $_SESSION['user']!=0)
{
  $sql="SELECT sr_no FROM products WHERE sr_no = :x";
  $stmt=$pdo->prepare($sql);
  $stmt->execute(array(
    ':x'=>$_GET['x'],
  ));
  $rows=$stmt->fetch(PDO::FETCH_ASSOC);
  if($rows!==FALSE)
  {
    $buyer;
    $seller;
    $title;
    $pi;
    $sql="INSERT Into transactions(sr_no,user_id)  VALUES (:s,:u)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(
      ':s'=>$_GET['x'],
      ':u'=>$_SESSION['user'],
    ));
    $sql="SELECT products.title,products.product_id,users.email FROM products JOIN users ON products.user_id=users.user_id WHERE sr_no = :x";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(
      ':x'=>$_GET['x'],
    ));
    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($rows as $row)
    {
      $seller=$row['email'];
      $pi=$row['product_id'];
      $title=$row['title'];
    }
    $sql="SELECT email FROM users WHERE user_id = :x";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(
      ':x'=>$_SESSION['user'],
    ));
    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($rows as $row)
    {
      $buyer=$row['email'];
    }
    $to = $seller;
    $subject = 'Transaction Alert';
    $message = "Someone with email ".$buyer." has brought your product with Product ID ".$pi." Please dispatch the product.";

    if(mail($to, $subject, $message)){
        echo 'An order mail has been sent to the seller.<br>';
    } else{
        echo 'Unable to send email to seller. Please try again.<br>';
    }
    $to = $buyer;
    $subject = 'Transaction Alert';
    $message = "Your order ".$title." has been placed. To talk to the seller contact ".$seller.".";

    if(mail($to, $subject, $message)){
        echo 'A transaction mail has been sent to your email.<br>';
    } else{
        echo 'Unable to send email. Please try again.<br>';
    }


  }
}
echo("Go back to home page? <a href=index.php> Home </a>");
 ?>
