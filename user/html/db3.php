<?php
session_start();
include 'connect.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/couse1.css">
    <title>Document</title>
</head>
<body>
    <section id="border">
           
			<?php
			$count = 1;
			$data = "SELECT * FROM practical2";
			$rows = mysqli_query($conn, $data);
			while ($rs = mysqli_fetch_array($rows)) {
			?>
			<?php $count++; }?>

</body>
</html>
