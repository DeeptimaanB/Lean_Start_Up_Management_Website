<?php
require_once "pdo.php";
session_start();
if(!isset($_SESSION['user']) OR $_SESSION['user']==0)
{
  die("Sign in first");
}
$sql="SELECT transactions.dateCreated,products.title,transactions.completed,users.fn,users.ln FROM transactions JOIN products JOIN users ON transactions.sr_no=products.sr_no AND products.user_id=users.user_id WHERE BINARY transactions.user_id = :ui";
$stmt= $pdo->prepare($sql);
$stmt->execute(array(
  ':ui'=> $_SESSION['user'],
));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
require_once "head.php";
?>
<div class="container-fluid">
<div class="row">
  <?php require_once "leftcolumn.php"; ?>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body" style="min-height:400px;">
        <table class="table-bordered" style="width:100%;">
          <tr>
            <th>Item</th>
            <th>Seller</th>
            <th>Order Placed</th>
            <th>Completed</th>
          </tr>
        <?php
        foreach ( $rows as $row ) {
            echo "<tr><td>";
            echo(htmlentities($row['title']." "));
            echo("</td><td>");
            echo(htmlentities($row['fn']." ".$row['ln']." "));
            echo("</td><td>");
            echo(htmlentities($row['dateCreated']." "));
            echo("</td><td>");
            echo($row['completed']==TRUE?"YES ":"NO ");
            echo("</td></tr>\n");
        }
        ?>
        </table>
    </div>
  </div>
  <br>
</div>
  <?php require_once "rightcolumn.php"; ?>
</div>
</div>
<?php require_once "footer.php"; ?>
