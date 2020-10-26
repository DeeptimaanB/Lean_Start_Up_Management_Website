<?php
require_once "pdo.php";
session_start();
if($_SESSION['user']==0)
{
  die("Sign in first");
}
$title;
$category;
$product_id;
$content;

$sql="SELECT title FROM products WHERE products.user_id = :u AND products.sr_no = :s";
$stmt= $pdo->prepare($sql);
$stmt->execute(array(
  ':u'=> $_SESSION['user'],
  ':s'=> $_GET['x'],
));
$data = $stmt->fetch(PDO::FETCH_ASSOC);
if($data===FALSE)
{
  die("Cannot find article with the current user");
}

if(isset($_POST['title']) && isset($_POST['category']) && isset($_POST['pid']) && isset($_POST['des'])  /*&& isset($_POST['img1'])  && isset($_POST['img1d'])*/)
{

	  $sql= "UPDATE products SET title = :t,category = :cat ,product_id = :p,user_id = :u,content = :con WHERE sr_no = :s";
		$stmt= $pdo->prepare($sql);
    $content = nl2br(htmlentities($_POST['des'], ENT_QUOTES, 'UTF-8'));
		$stmt->execute(array(
			':t'=> $_POST['title'],
			':cat'=> $_POST['category'],
      ':p'=>$_POST['pid'],
      ':u'=> $_SESSION['user'],
			':con'=> $content,
      ':s'=> $_GET['x'],
		));
	}
  $sql="SELECT products.title,products.category,products.content,products.product_id FROM products WHERE products.user_id = :u AND products.sr_no = :s";
  $stmt= $pdo->prepare($sql);
  $stmt->execute(array(
    ':u'=> $_SESSION['user'],
    ':s'=> $_GET['x'],
  ));
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach ($data as $value) {
    $title=$value['title'];
    $category=$value['category'];
    $content=$value['content'];
    $product_id=$value['product_id'];

  }
  if(isset($_POST['del']) && $_POST['del']=="Delete")
  {
    $sql="DELETE FROM products WHERE sr_no = :s";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(
      ':s'=>$_GET['x'],
    ));
    header("Location: inventory.php");
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
          <form action="manage.php?x=<?php echo($_GET['x'])?>" method="POST">
              <label for="pid"><b>Product ID</b></label><br>
              <input type="text" name="pid" value="<?php echo(htmlentities($product_id)); ?>" required><br><br>
              <label for="title"><b>Title</b></label><br>
              <input type="text" name="title" required value="<?php echo(htmlentities($title)); ?>"><br><br>
              <b>Category</b><br>
              <input type="radio" id="o" name="category" value="O" <?php echo($category=='O'?'checked':'')?> required>
              <label for="P">Office</label><br>
              <input type="radio" id="r" name="category" value="R" <?php echo($category=='R'?'checked':'')?>>
              <label for="">Residence</label><br>
              <input type="radio" id="g" name="category" value="G" <?php echo($category=='G'?'checked':'')?>>
              <label for="">Garden</label><br>
              <input type="radio" id="a" name="category" value="A" <?php echo($category=='A'?'checked':'')?>>
              <label for="other">Accessories</label><br><br>
              <div class="form-group">
                <label for="des">Description:</label>
                <textarea class="form-control" id="des" name="des"><?php echo(htmlentities($content)); ?></textarea>
              </div>
              <br>
              <button type="button" onclick="window.location.href='index.php';">Back</button>
              <button type="submit">Update</button>
              <input type='submit' value='Delete' name='del'>
           </form>
        </div>
        </div>
        <br>
      </div>
      <?php require_once "rightcolumn.php"; ?>
   </div>
  </div>

  <?php require_once "footer.php"; ?>
