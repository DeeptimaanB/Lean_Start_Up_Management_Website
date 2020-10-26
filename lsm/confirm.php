<?php
require_once "pdo.php";
$msg="";
if(isset($_GET['x']))
{
	$sql= "SELECT process FROM temp WHERE BINARY process=:p";
	$stmt= $pdo->prepare($sql);
	$stmt->execute(array(
		':p'=> $_GET['x'],
	));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	if($row===false)
	{
    $msg="There is no such request <br> <a href='index.php'>Go back to Home</a>";
	}
  else
	{
    $sql= "SELECT type,fn,ln,gender,email,pass FROM temp WHERE BINARY process=:p";
  	$stmt= $pdo->prepare($sql);
  	$stmt->execute(array(
  		':p'=> $_GET['x'],
  	));
  	$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$type;
    $fn;
    $ln;
    $gender;
    $email;
    $pass;
    foreach ( $rows as $row ) {
			  $type=$row['type'];
        $fn=$row['fn'];
        $ln=$row['ln'];
        $gender=$row['gender'];
        $email=$row['email'];
        $pass=$row['pass'];
      }
		$sql= "INSERT Into users(type,fn,ln,gender,email,pass) values(:t,:f,:l,:g,:e,:p)";
		$stmt= $pdo->prepare($sql);
		$stmt->execute(array(
			':t'=> $type,
			':f'=> $fn,
			':l'=> $ln,
			':g'=> $gender,
			':e'=> $email,
			':p'=> $pass,
		));
		$msg="Your account has been created. <br> Please <a href='login.php'>Log In</a>";
    $sql="DELETE FROM temp WHERE BINARY process = :p";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(
      ':p'=>$_GET['x'],
    ));
	}
}
else
{
  $msg="The request is empty <br> <a href='index.php'>Go back to Home</a>";
}
?>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css">
<script src="jquery-3.5.1.js"></script>
<script src="bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="jumbotron">
	  <h1 style="text-align:center;">Hartisans Welcomes You!!!</h1>
	  <p style="text-align:center;"><i>"You know it when your place smiles back at you."</i></p>
	</div>
	<div class="row">
		<div class="col-sm-12" style="text-align:center;">
			<?php
			if($msg!="")
			{
				echo($msg);
			}
			?>
		</div>
	</div>
</body>
</html>
