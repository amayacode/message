<?php
$id      = $_POST['id'];
$title   = addslashes(htmlspecialchars($_POST['title']));
$content = addslashes(htmlspecialchars($_POST['content']));
$pdo     = new PDO("mysql:host=localhost;dbname=message",'root','69007');
$pdo     -> query('set names utf8');

$sql = "update bg set title ='$title',content='$content' where id={$id}";
$tme = $pdo->prepare($sql);
$result = $tme->execute();
if($result){
	echo  'ok';
}else{
	echo  'error';
}