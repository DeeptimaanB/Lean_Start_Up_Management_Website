<!DOCTYPE html>
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

<nav class="navbar navbar-expand-sm bg-light navbar-light sticky-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Hartisans</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="nav-item"><a class="nav-link" href="display.php?x=O">Office</a></li>
      <li class="nav-item"><a class="nav-link" href="display.php?x=R">Residence</a></li>
      <li class="nav-item"><a class="nav-link" href="display.php?x=G">Garden</a></li>
      <li class="nav-item"><a class="nav-link" href="display.php?x=A">Accessories</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php
      if($_SESSION['user']==0)
      {
        echo("<li class=\"nav-item\"><a class=\"nav-link\" href=\"signup.php\"> Sign Up </a></li>");
        echo("<li class=\"nav-item\"><a class=\"nav-link\" href=\"login.php\"> Login </a></li>");
      }
      if($_SESSION['user']!=0 && $_SESSION['type']=='S')
      {
        echo("<li class=\"nav-item\"><a class=\"nav-link\" href=\"orders.php\"> Orders </a></li>");
        echo("<li class=\"nav-item\"><a class=\"nav-link\" href=\"inventory.php\"> Inventory </a></li>");
      }
      if($_SESSION['user']!=0)
      {
        echo("<li class=\"nav-item\"><a class=\"nav-link\" href=\"myorders.php\"> My Orders </a></li>");
        echo("<li class=\"nav-item\"><a class=\"nav-link\" href=\"myaccount.php\"> My Account </a></li>");
        echo("<li class=\"nav-item\"><a class=\"nav-link\" href=\"logout.php\"> Log Out </a></li>");
      }
       ?>
      <li><form class="form-inline" action="/action_page.php">
        <input type="text" class="form-control mr-sm-2" placeholder="Search">
        <button type="submit">Submit</button>
      </form>
      </li>
    </ul>
  </div>
</nav>
</br>
