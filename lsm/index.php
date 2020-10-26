<?php
  require_once "pdo.php";
  session_start();
  if(!isset($_SESSION['user']))
  {
    $_SESSION['user']=0;
  }

require_once "head.php";
?>
<div class="container-fluid">
<div class="row">
  <?php require_once "leftcolumn.php"; ?>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
      <h1>Popular Accessories</h2>
      <h3>Accessories on demand</h3>
      <br>
      <div>
        <?php
        $sql = "SELECT products.sr_no,products.title,users.fn,users.ln FROM products JOIN users ON products.user_id=users.user_id WHERE category = 'A' ORDER BY likes DESC LIMIT 5";
        $stmt = $pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rows as $row)
        {
          echo("<div style='text-align:center;'><a href='view.php?x=".$row['sr_no']."'>&quot;".$row['title']."&quot;&emsp;-by ".$row['fn']." ".$row['ln']." </a></div></br>");
        }
         ?></div>
      </div>
      <p></p>
    </div>
    <br>
    <div class="card">
      <div class="card-body">
      <h1>Popular Officeware</h2>
      <h3>Loved office furniture products.</h3>
      <br>
      <div>
        <?php
        $sql = "SELECT products.sr_no,products.title,users.fn,users.ln FROM products JOIN users ON products.user_id=users.user_id WHERE category = 'O' ORDER BY likes DESC LIMIT 5";
        $stmt = $pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rows as $row)
        {
          echo("<div style='text-align:center;'><a href='view.php?x=".$row['sr_no']."'>&quot;".$row['title']."&quot;&emsp;-by ".$row['fn']." ".$row['ln']." </a></div></br>");
        }
         ?>
      </div>
      </div>
      <p></p>
    </div>
    <br>
    <div class="card">
      <div class="card-body">
      <h1>Popular Houseware</h1>
      <h3>Houseware has never been so better</h3>
      <br>
      <div>
        <?php
        $sql = "SELECT products.sr_no,products.title,users.fn,users.ln FROM products JOIN users ON products.user_id=users.user_id WHERE category = 'R' ORDER BY likes DESC LIMIT 5";
        $stmt = $pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rows as $row)
        {
          echo("<div style='text-align:center;'><a href='view.php?x=".$row['sr_no']."'>&quot;".$row['title']."&quot;&emsp;-by ".$row['fn']." ".$row['ln']." </a></div></br>");
        }
         ?></div>
      </div>
      <p></p>
    </div>
    <br>
    <div class="card">
      <div class="card-body">
      <h1>Addition to your Garden</h1>
      <h3>Assets to your Garden</h3>
      <br>
      </div>
      <div>
        <?php
        $sql = "SELECT products.sr_no,products.title,users.fn,users.ln FROM products JOIN users ON products.user_id=users.user_id WHERE category = 'G' ORDER BY likes DESC LIMIT 5";
        $stmt = $pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rows as $row)
        {
          echo("<div style='text-align:center;'><a href='view.php?x=".$row['sr_no']."'>&quot;".$row['title']."&quot;&emsp;-by ".$row['fn']." ".$row['ln']." </a></div></br>");
        }
         ?>
      </div>
      <p></p>
    </div>
    <br>
  </div>
  <?php require_once "rightcolumn.php"; ?>
</div>
</div>
<?php require_once "footer.php"; ?>
