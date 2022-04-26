<?php
require_once 'pdo.php';
require_once 'mailserver.php';

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
    
    /* Send mail to seller*/
    $mail->setFrom('developer.deeptimaanbanerjee@gmail.com', 'Deeptimaan Banerjee');
		$mail->addAddress($seller);
		$mail->isHTML(true);                    
		$mail->Subject = 'Transaction Alert';
		$mail->Body    = "Someone with email ".$buyer." has brought your product with Product ID ".$pi." Please dispatch the product.";
		if($mail->send())
		{
			$msg=  'An order mail has been sent to the seller.<br>';
		}
		else
		{
			$msg= 'Unable to send email to your email address. Please try again.';
		}

    /* Send mail to buyer*/
    $mail->setFrom('developer.deeptimaanbanerjee@gmail.com', 'Deeptimaan Banerjee');
		$mail->addAddress($buyer);
		$mail->isHTML(true);                    
		$mail->Subject = 'Transaction Alert';
		$mail->Body    = "Your order ".$title." has been placed. To talk to the seller contact ".$seller.".";
		if($mail->send())
		{
			$msg=  'An order mail has been sent to the seller.<br>';
		}
		else
		{
			$msg= 'Unable to send email to your email address. Please try again.';
		}
   
  }
}
echo("Go back to home page? <a href=index.php> Home </a>");
 ?>
