<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=hartisans', 'EnterUserName', 'EnterPassword');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$site='http://localhost/lsm';