<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<script src="./js/jquery-3.1.1.js"></script>
	<script src="./js/bootstrap.js"></script>
	<script src='./layer/layer/layer.js'></script>
</head>
<body>
</body>
</html>

<?php
$id = isset($_GET['id'])?$_GET['id']:1;
if(!is_numeric($id)){
	echo "<script>layer.msg('非法参数');	
			setTimeout(function(){
				location.href='index.php';
			},3000);
		</script>";
	exit;
}
$pdo  = new PDO("mysql:host=localhost;dbname=message",'root','69007');
$pdo->query('set names utf8');
//select * from bg id = 9;
/*$sql = "select * from bg id={$id}";
$tme = $pdo->prepare($sql);
$tme->execute();
$rows = $tme->fetch(PDO::FETCH_ASSOC);
print_r($rows);exit;
if((count($rows) == '') ){
	echo "该留言不存在";
}else{*/
	$sql = "delete from bg where id={$id}";
	$tme = $pdo->prepare($sql);
	$result = $tme->execute();
	if($result){
		echo 'ok';
	}else{
		echo 'error';
	}
/*}*/