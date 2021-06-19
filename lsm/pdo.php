<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=hartisans', 'han', 'han123');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$site='http://a4a19d947ca2.ngrok.io';