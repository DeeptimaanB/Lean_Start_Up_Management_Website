<?php
require_once "pdo.php";
$msg="";
if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['gender']) && isset($_POST['psw']))
{
	if($_POST['psw']==$_POST['psw-repeat'] && strlen($_POST['psw'])>=7)
	{

		$sql= "SELECT email FROM users WHERE BINARY email=:e";
		$stmt= $pdo->prepare($sql);
		$stmt->execute(array(
			':e'=> $_POST['email'],
		));
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		if($row===false)
		{
      $type;
      if($_POST['submit']=="Sign Up As Customer")
      {
        $type='C';
      }
      if($_POST['submit']=="Sign Up As Seller")
      {
        $type='S';
      }
			$hash=hash('md5', microtime());
			$sql= "INSERT Into temp(process,type,fn,ln,gender,email,pass) values(:pr,:t,:f,:l,:g,:e,:p)";
			$stmt= $pdo->prepare($sql);
			$stmt->execute(array(
				':pr'=> $hash,
        ':t'=> $type,
				':f'=> $_POST['fname'],
				':l'=> $_POST['lname'],
				':g'=> $_POST['gender'],
				':e'=> $_POST['email'],
				':p'=> $_POST['psw'],
			));
			$to = $_POST['email'];
			$subject = 'Confirm Account';
			$message = "Click on the link to confirm account http://localhost/lsm/confirm.php?x=".$hash;
			if(mail($to, $subject, $message)){
			    $msg= 'An email has been sent to your mail id for account confirmation. It might take upto 10 minutes.';
			} else{
			    $msg= 'Unable to send email to your email address. Please try again.';
			}
		}
		else
		{
			$msg="The email already exists";
		}
	}
	else
	{
		$msg="Passwords dont match";
	}
	if(strlen($_POST['psw'])<7)
	{
		$msg="Password too short";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css">
<script src="jquery-3.5.1.js"></script>
<script src="bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="signin_up.css">
</head>
<body class="text-center">

<form class="form-signin" action="signup.php" method="post">
    <h2>Sign Up</h2>
    <?php
    if($msg!="")
    {
      echo("<p style='color:black; padding:2px; text-align:center;'>".$msg."</p>");
    }
    ?>
    <input type="text" class="form-control" placeholder="Enter First Name" name="fname" required>
    <input type="text" class="form-control" placeholder="Enter Last Name" name="lname" required>
    <input type="text" class="form-control" placeholder="Enter Email" name="email" required>
    <br>
		<label for="gender">Gender:</label>
		<select name="gender" required>
		<option value="m">Male</option>
  	<option value="f">Female</option>
  	<option value="o">Other</option>
		</select>
    <input type="password" class="form-control" placeholder="Enter Password" name="psw" required>
    <input type="password" class="form-control" placeholder="Repeat Password" name="psw-repeat" required>
    <br>
    <input type="submit" name="submit" value="Sign Up As Customer">
    <br>
    <input type="submit" name="submit" value="Sign Up As Seller">
    <br>
    <br>
    <button type="button" class="cancelbtn" onclick="window.location.href='index.php';">Cancel</button>
    <br>
</form>

</body>
</html>
