<?php 
$title = addslashes(htmlspecialchars($_POST['title']));
$content = addslashes(htmlspecialchars($_POST['content']));
$time = time();
$pdo  = new PDO("mysql:host=localhost;dbname=message",'root','69007');
$pdo->query('set names utf8');
//$sql = "insert into bg(title,content) values('123','456')";
$sql = "INSERT INTO bg(title,content,time) VALUES('{$title}','{$content}','{$time}')";
$tme = $pdo->prepare($sql);
$result = $tme->execute();
if($result){
	echo  'ok';
}else{
	echo  'error';
}