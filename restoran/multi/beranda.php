<?php 
session_start(); 
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>beranda</title>
</head>
<body>
	<li><a href="">Home</a></li>
	<?php 
	$level = $_SESSION['id_level'] == 'user';
	if($level){
	 ?>
	<li><a href="">Update status</a></li>
<?php }else{ ?>
	<li><a href="">kelola user</a></li>
	<li><a href="">kelola status</a></li>
<?php } ?>
	<li><a href="">logout</a></li>

</body>
</html>