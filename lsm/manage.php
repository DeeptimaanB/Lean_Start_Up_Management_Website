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
$img1="";
$img2="";
$img3="";
$img4="";
$img5="";

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

$sql="SELECT products.img1,products.img2,products.img3,products.img4,products.img5,products.title,products.category,products.content,products.product_id FROM products WHERE products.user_id = :u AND products.sr_no = :s";
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
    $img1=$value['img1'];
    $img2=$value['img2'];
    $img3=$value['img3'];
    $img4=$value['img4'];
    $img5=$value['img5'];

  }

if(isset($_POST['title']) && isset($_POST['category']) && isset($_POST['pid']) && isset($_POST['des']))
{
    if(isset($_FILES['img1']) && $_FILES['img1']['size']!=0)
    {
      $md5 = hash("md5", microtime());
      $extension_name = substr($_FILES["img1"]["type"],strpos($_FILES["img1"]["type"],"/")+1);
      $newname=$md5.".".$extension_name;    
      $folder = "pic/".basename($newname); 
      move_uploaded_file($_FILES["img1"]["tmp_name"], $folder);
      $img1=$newname;
    }

    if(isset($_FILES['img2']) && $_FILES['img2']['size']!=0)
    {
      $md5 = hash("md5", microtime());
      $extension_name = substr($_FILES["img2"]["type"],strpos($_FILES["img2"]["type"],"/")+1);
      $newname=$md5.".".$extension_name;    
      $folder = "pic/".basename($newname); 
      move_uploaded_file($_FILES["img2"]["tmp_name"], $folder);
      $img2=$newname;
    }

    if(isset($_FILES['img3']) && $_FILES['img3']['size']!=0)
    {
      $md5 = hash("md5", microtime());
      $extension_name = substr($_FILES["img3"]["type"],strpos($_FILES["img3"]["type"],"/")+1);
      $newname=$md5.".".$extension_name;    
      $folder = "pic/".basename($newname); 
      move_uploaded_file($_FILES["img3"]["tmp_name"], $folder);
      $img3=$newname;
    }

    if(isset($_FILES['img4']) && $_FILES['img4']['size']!=0)
    {
      $md5 = hash("md5", microtime());
      $extension_name = substr($_FILES["img4"]["type"],strpos($_FILES["img4"]["type"],"/")+1);
      $newname=$md5.".".$extension_name;    
      $folder = "pic/".basename($newname); 
      move_uploaded_file($_FILES["img4"]["tmp_name"], $folder);
      $img4=$newname;
    }

    if(isset($_FILES['img5']) && $_FILES['img5']['size']!=0)
    {
      $md5 = hash("md5", microtime());
      $extension_name = substr($_FILES["img5"]["type"],strpos($_FILES["img5"]["type"],"/")+1);
      $newname=$md5.".".$extension_name;    
      $folder = "pic/".basename($newname); 
      move_uploaded_file($_FILES["img5"]["tmp_name"], $folder);
      $img5=$newname;
    }

	  $sql= "UPDATE products SET img1 = :i1,img2 = :i2,img3 = :i3,img4 = :i4,img5 = :i5,title = :t,category = :cat ,product_id = :p,user_id = :u,content = :con WHERE sr_no = :s";
		$stmt= $pdo->prepare($sql);
    $content = nl2br(htmlentities($_POST['des'], ENT_QUOTES, 'UTF-8'));
		$stmt->execute(array(
			':t'=> $_POST['title'],
			':cat'=> $_POST['category'],
      ':p'=>$_POST['pid'],
      ':u'=> $_SESSION['user'],
			':con'=> $content,
      ':s'=> $_GET['x'],
      ':i1' => $img1,
      ':i2' => $img2,
      ':i3' => $img3,
      ':i4' => $img4,
      ':i5' => $img5
		));
  }
  $sql="SELECT products.img1,products.img2,products.img3,products.img4,products.img5,products.title,products.category,products.content,products.product_id FROM products WHERE products.user_id = :u AND products.sr_no = :s";
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
    $img1=$value['img1'];
    $img2=$value['img2'];
    $img3=$value['img3'];
    $img4=$value['img4'];
    $img5=$value['img5'];

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
        <h1>Edit Item</h1>
          <form action="manage.php?x=<?php echo($_GET['x'])?>" method="POST" enctype="multipart/form-data">
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
              <?php
              if(isset($img1) && $img1!="")
              {
                echo("<img src=pic/".$img1." alt=".$img1." style=\"width:200px;height:200px;object-fit:cover;margin:3px;\"></img><br>");
              }
              ?>
              <label for="img1">Image 1 :</label>
              <input type="file" name="img1" value="" /> 
              <br>
              <?php
              if(isset($img2) && $img2!="")
              {
                echo("<br><img src=pic/".$img2." alt=".$img2." style=\"width:200px;height:200px;object-fit:cover;margin:3px;\"></img><br>");
              }
              ?>
              <label for="img2">Image 2 :</label>
              <input type="file" name="img2" value="" />
              <br> 
              <?php
              if(isset($img3) && $img3!="")
              {
                echo("<br><img src=pic/".$img3." alt=".$img3." style=\"width:200px;height:200px;object-fit:cover;margin:3px;\"></img><br>");
              }
              ?>
              <label for="img3">Image 3 :</label>
              <input type="file" name="img3" value="" />
              <br> 
              <?php
              if(isset($img4) && $img4!="")
              {
                echo("<br><img src=pic/".$img4." alt=".$img4." style=\"width:200px;height:200px;object-fit:cover;margin:3px;\"></img><br>");
              }
              ?>
              <label for="img4">Image 4 :</label>
              <input type="file" name="img4" value="" /> 
              <br>
              <?php
              if(isset($img5) && $img5!="")
              {
                echo("<br><img src=pic/".$img5." alt=".$img5." style=\"width:200px;height:200px;object-fit:cover;margin:3px;\"></img><br>");
              }
              ?>
              <label for="img5">Image 5 :</label>
              <input type="file" name="img5" value="" /> 
              <br>
              <br>
              <div class="form-group">
                <label for="des">Description:</label>
                <textarea class="form-control" id="des" name="des"><?php echo(str_replace('<br />',"",$content )); ?></textarea>
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
