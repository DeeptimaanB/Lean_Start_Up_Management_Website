<?php
session_start();
if(!isset($_SESSION['user']))
{
  $_SESSION['user']=0;
}
require_once "pdo.php";
if(!isset($_GET['x']))
{
  die("x not defined");
}
if($_GET['x']!='O' && $_GET['x']!='R' && $_GET['x']!='G' && $_GET['x']!='A')
{
  die("Invalid x");
}
$sql="SELECT products.sr_no,products.img1,products.title,users.fn,users.ln FROM products JOIN users ON products.user_id=users.user_id WHERE category = :x";
$stmt=$pdo->prepare($sql);
$stmt->execute(array(
  ':x' => $_GET['x'],
));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
require_once "head.php";
?>
<link rel="stylesheet" href="css.css">
<div class="container-fluid">
<div class="row">
  <?php require_once "leftcolumn.php"; ?>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
      <h1>
        <?php
        if($_GET['x']=='O')
        {
          echo("Office");
        }
        else if($_GET['x']=='R')
        {
          echo("Residence");
        }
        else if($_GET['x']=='G')
        {
          echo("Garden");
        }
        else if($_GET['x']=='A')
        {
          echo("Accessories");
        }
        ?>
      </h1>
      <br>
      <div class="fakeimg"  style="min-height:450px">
        <?php
        if($rows===false)
      	{
          echo("Nothing to be shown");
        }
        else
        {
          foreach($rows as $row)
          {
            echo("<div class=\"cardsale\">");
            echo("<h1>".$row['title']."</h1>");
            echo("<h5>-by ".$row['fn']." ".$row['ln']."</h5>");
            echo("<br><img src=pic/".$row['img1']." alt=".$row['img1']."></img>");
            echo("<br><br><a href='view.php?x=".$row['sr_no']."'> Buy </a></br></br></div></br>");
          }
        }
      ?>
      </div>
      <p></p>
    </div>
    </div>
 </div>
  <?php require_once "rightcolumn.php"; ?>
</div>
</div>

<?php require_once "footer.php"; ?>
