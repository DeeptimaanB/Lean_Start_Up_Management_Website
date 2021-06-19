<?php
require_once "pdo.php";
session_start();
if($_SESSION['user']==0)
{
  die("Sign in first");
}
$msg;
if(isset($_POST['title']) && isset($_POST['category']) && isset($_POST['pid']) && isset($_POST['des']) && isset($_FILES['img1']) && isset($_FILES['img2']))  
{
    $img1="";
    $img2="";
    $img3="";
    $img4="";
    $img5="";

    $md5 = hash("md5", microtime());
    $extension_name = substr($_FILES["img1"]["type"],strpos($_FILES["img1"]["type"],"/")+1);
    $newname=$md5.".".$extension_name;    
    $folder = "pic/".basename($newname); 
    move_uploaded_file($_FILES["img1"]["tmp_name"], $folder);
    $img1=$newname;

    $md5 = hash("md5", microtime());
    $extension_name = substr($_FILES["img2"]["type"],strpos($_FILES["img2"]["type"],"/")+1);
    $newname=$md5.".".$extension_name;    
    $folder = "pic/".basename($newname); 
    move_uploaded_file($_FILES["img2"]["tmp_name"], $folder);
    $img2=$newname;

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
  
	  $sql= "INSERT Into products(title,category,product_id,user_id,content,img1,img2,img3,img4,img5) values(:t,:cat,:p,:u,:con,:i1,:i2,:i3,:i4,:i5)";
		$stmt= $pdo->prepare($sql);
    $content = nl2br(htmlentities($_POST['des'], ENT_QUOTES, 'UTF-8'));
		$stmt->execute(array(
			':t'=> $_POST['title'],
			':cat'=> $_POST['category'],
      ':p'=>$_POST['pid'],
      ':u'=> $_SESSION['user'],
      ':con'=> $content,
      ':i1' => $img1,
      ':i2' => $img2,
      ':i3' => $img3,
      ':i4' => $img4,
      ':i5' => $img5
    ));
    $msg="Successfully Added Entry.<br>";
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
        <p><?php if(isset($msg)){echo($msg);} ?></p>
          <form action="add.php" method="POST" enctype="multipart/form-data">
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
              <label for="img1">Image 1 :</label>
              <input type="file" name="img1" value="" required /> 
              <br>
              <label for="img2">Image 2 :</label>
              <input type="file" name="img2" value="" required />
              <br> 
              <label for="img3">Image 3 :</label>
              <input type="file" name="img3" value="" />
              <br> 
              <label for="img4">Image 4 :</label>
              <input type="file" name="img4" value="" /> 
              <br>
              <label for="img5">Image 5 :</label>
              <input type="file" name="img5" value="" /> 
              <br>
              <br>
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
