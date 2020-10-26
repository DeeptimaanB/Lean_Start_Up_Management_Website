<?php
require_once "pdo.php";
$image_id=3;
$sql = "SELECT img1 FROM images WHERE img_id=:id";
$query = $pdo->prepare($sql);
$query->execute(array(':id' => $image_id));

$query->bindColumn(1, $image, PDO::PARAM_LOB);
$query->fetch(PDO::FETCH_BOUND);
header("Content-Type: image");
echo $image;
?>
