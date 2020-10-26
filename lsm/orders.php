<?php
require_once "pdo.php";
session_start();
if(!isset($_SESSION['user']) OR $_SESSION['user']==0)
{
  die("Sign in first");
}
if(!isset($_SESSION['type']) OR $_SESSION['type']!='S')
{
  die("You are not a seller");
}
if ( isset($_POST['change']) && isset($_POST['trans_id']) ) {
    $completed;
    $sql = "SELECT completed FROM transactions WHERE trans_id = :t";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':t' => $_POST['trans_id'],
    ));
    $rows= $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($rows as $row)
    {
      $completed= !$row['completed'];
    }
    $sql = "UPDATE transactions SET completed = :c WHERE trans_id = :t";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':c' => $completed,
      ':t' => $_POST['trans_id'],
    ));
}
$sql="SELECT transactions.trans_id,transactions.dateCreated,transactions.user_id,transactions.sr_no,products.title,transactions.completed,users.fn,users.ln,users.address FROM transactions JOIN products JOIN users ON transactions.sr_no=products.sr_no AND transactions.user_id=users.user_id WHERE BINARY products.user_id = :ui";
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
        <table class="table-bordered" style="width:100%; text-align: center;">
          <tr>
            <th>Item</th>
            <th>Buyer</th>
            <th>Order Placed</th>
            <th>Address</th>
            <th>Completed</th>
            <th>Change Status</th>
          </tr>
        <?php
        foreach ( $rows as $row ) {
            echo "<tr><td>";
            echo(htmlentities($row['title']." "));
            echo("</td><td>");
            echo(htmlentities($row['fn']." ".$row['ln']." "));
            echo("</td><td>");
            echo(htmlentities($row['address']." "));
            echo("</td><td>");
            echo(htmlentities($row['dateCreated']." "));
            echo("</td><td>");
            echo($row['completed']==TRUE?"YES ":"NO ");
            echo("</td><td>");
            echo('<form method="post"><input type="hidden" ');
            echo('name="trans_id" value="'.$row["trans_id"].'">'."\n");
            echo('<input type="submit" value="Change" name="change">');
            echo("\n</form>\n");
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
