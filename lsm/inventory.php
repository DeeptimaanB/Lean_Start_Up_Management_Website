<?php
session_start();
if(!isset($_SESSION['user']))
{
  die("Account Unavailable sign in first");
}
require_once "pdo.php";
require_once "head.php";

?>

<div class="row">
  <?php require_once "leftcolumn.php"; ?>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
      <h1>
        My Inventory
      </h1>
      <br>
      <h5 style="float:right;"><a href='add.php'>+ Add</a></h5>
      <br>
      <div class="fakeimg"  style="min-height:450px">
        <?php
        $sql="SELECT products.sr_no,products.category,products.title,users.fn,users.ln FROM products JOIN users ON products.user_id=users.user_id WHERE users.user_id = :x AND products.category = 'O'";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array(
          ':x' => $_SESSION['user'],
        ));
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        echo("<h3 style='clear:both;'>Office</h3>");
        if($rows===false)
      	{
          echo("<div>Nothing to be shown</div>");
        }
        else
        {
          $sql="SELECT products.sr_no,products.category,products.title,users.fn,users.ln FROM products JOIN users ON products.user_id=users.user_id WHERE users.user_id = :x AND products.category = 'O'";
          $stmt=$pdo->prepare($sql);
          $stmt->execute(array(
            ':x' => $_SESSION['user'],
          ));
          $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach($rows as $row)
          {
            echo("<div style='clear:both;'><a href='view.php?x=".$row['sr_no']."' style='float:left;'>".$row['title']."</a> <a href='manage.php?x=".$row['sr_no']."'style='float:right;'>Manage</a></div></br>");
          }
        }
        $sql="SELECT products.sr_no,products.category,products.title,users.fn,users.ln FROM products JOIN users ON products.user_id=users.user_id WHERE users.user_id = :x AND products.category = 'R'";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array(
          ':x' => $_SESSION['user'],
        ));
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        echo("<br>");
        echo("<h3 style='clear:both;'>Residence</h3>");
        if($rows===false)
      	{
          echo("<div>Nothing to be shown</div>");
        }
        else
        {
          $sql="SELECT products.sr_no,products.category,products.title,users.fn,users.ln FROM products JOIN users ON products.user_id=users.user_id WHERE users.user_id = :x AND products.category = 'R'";
          $stmt=$pdo->prepare($sql);
          $stmt->execute(array(
            ':x' => $_SESSION['user'],
          ));
          $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach($rows as $row)
          {
            echo("<div style='clear:both;'><a href='view.php?x=".$row['sr_no']."' style='float:left;'>".$row['title']."</a> <a href='manage.php?x=".$row['sr_no']."'style='float:right;'>Manage</a></div></br>");
          }
        }
        $sql="SELECT products.sr_no,products.category,products.title,users.fn,users.ln FROM products JOIN users ON products.user_id=users.user_id WHERE users.user_id = :x AND products.category = 'G'";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array(
          ':x' => $_SESSION['user'],
        ));
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        echo("<br>");
        echo("<h3 style='clear:both;'>Garden</h3>");
        if($rows===false)
      	{
          echo("<div>Nothing to be shown</div>");
        }
        else
        {
          $sql="SELECT products.sr_no,products.category,products.title,users.fn,users.ln FROM products JOIN users ON products.user_id=users.user_id WHERE users.user_id = :x AND products.category = 'G'";
          $stmt=$pdo->prepare($sql);
          $stmt->execute(array(
            ':x' => $_SESSION['user'],
          ));
          $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach($rows as $row)
          {
            echo("<div  style='clear:both;'><a href='view.php?x=".$row['sr_no']."' style='float:left;'>".$row['title']."</a> <a href='manage.php?x=".$row['sr_no']."'style='float:right;'>Manage</a></div></br>");
          }
        }
        $sql="SELECT products.sr_no,products.category,products.title,users.fn,users.ln FROM products JOIN users ON products.user_id=users.user_id WHERE users.user_id = :x AND products.category = 'A'";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array(
          ':x' => $_SESSION['user'],
        ));
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        echo("<br>");
        echo("<h3 style='clear:both;'>Accessories</h3>");
        if($rows===false)
      	{
          echo("<div>Nothing to be shown</div>");
        }
        else
        {
          $sql="SELECT products.sr_no,products.category,products.title,users.fn,users.ln FROM products JOIN users ON products.user_id=users.user_id WHERE users.user_id = :x AND products.category = 'A'";
          $stmt=$pdo->prepare($sql);
          $stmt->execute(array(
            ':x' => $_SESSION['user'],
          ));
          $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach($rows as $row)
          {
            echo("<div style='clear:both;'><a href='view.php?x=".$row['sr_no']."' style='float:left;'>".$row['title']."</a> <a href='manage.php?x=".$row['sr_no']."'style='float:right;'>Manage</a></div></br>");
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

<?php require_once "footer.php"; ?>
