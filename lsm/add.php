<?php
require_once "pdo.php";
session_start();
if($_SESSION['user']==0)
{
  die("Sign in first");
}
if(isset($_POST['title']) && isset($_POST['category']) && isset($_POST['pid']) && isset($_POST['des'])  /*&& isset($_POST['img1'])  && isset($_POST['img1d'])*/)
{

	  $sql= "INSERT Into products(title,category,product_id,user_id,content) values(:t,:cat,:p,:u,:con)";
		$stmt= $pdo->prepare($sql);
    $content = nl2br(htmlentities($_POST['des'], ENT_QUOTES, 'UTF-8'));
		$stmt->execute(array(
			':t'=> $_POST['title'],
			':cat'=> $_POST['category'],
      ':p'=>$_POST['pid'],
      ':u'=> $_SESSION['user'],
			':con'=> $content,
		));
	}
  require_once "head.php";
 ?>

 <div class="container-fluid">
  <div class="row">
    <?php require_once "leftcolumn.php"; ?>
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
        <h1>Add Item</h1>
          <form action="add.php" method="POST">
              <label for="pid"><b>Product ID</b></label><br>
              <input type="text" name="pid" required><br><br>
              <label for="title"><b>Title</b></label><br>
              <input type="text" name="title" required><br><br>
              <b>Category</b><br>
              <input type="radio" id="o" name="category" value="O">
              <label for="P">Office</label><br>
              <input type="radio" id="r" name="category" value="R">
              <label for="">Residence</label><br>
              <input type="radio" id="g" name="category" value="G">
              <label for="">Garden</label><br>
              <input type="radio" id="a" name="category" value="A">
              <label for="other">Accessories</label><br><br>
              <div class="form-group">
                <label for="des">Description:</label>
                <textarea class="form-control" id="des" name="des"></textarea>
              </div>
              <br>
              <button type="button" onclick="window.location.href='index.php';">Back</button>
              <button type="submit">Add</button>
           </form>
        </div>
        </div>
        <br>
      </div>
      <?php require_once "rightcolumn.php"; ?>
   </div>
  </div>

  <?php require_once "footer.php"; ?>
