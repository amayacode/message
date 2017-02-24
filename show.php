<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<script src="./js/jquery-3.1.1.js"></script>
	<script src="./js/bootstrap.js"></script>
	<script src='./layer/layer/layer.js'></script>
	<style>
		#div1{
			margin: 20px auto;
			width: 1000px;
		}
		table{
			border:1px solid #ccc;
			border-radius: 10px;
		}
		table tr th{
			text-align: center;

		}
		table tr td{
			text-align: center;
		}
		input{
			padding: 10px;
			border-radius: 5px;
		}
		textarea{
			border-radius: 10px;
			resize:none;
			padding: 10px;
		}
	</style>
</head>
<body>
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
$sql = "select * from bg where id={$id}";
$tme = $pdo->prepare($sql);
$tme->execute();
$rows = $tme->fetch(PDO::FETCH_ASSOC);
if(!$rows){
	echo "<script>layer.msg('该条数据不存在!');	
			setTimeout(function(){
				location.href='index.php';
			},3000);
		</script>";
	exit;

}
?>
	<div id="div1">
		<table class="table table-borser table-hover" border="">
			<caption style="text-align: center;color: #ccc; margin-bottom: 20px;"><h1>留言板之修改留言</h1></caption>
			<tr>
				<th width="25%" style="padding-top: 20px;">标题</th>
				<td width="75%">
					<input type="text" name="title" id="title" value="<?php echo $rows['title'];?>"" style="width: 700px;height:40px;">
				</td>
			</tr>
			<tr>
				<th width="25%" style="padding-top:100px;">内容</th>
				<td>
					<textarea name="content" id="content" style="width:700px;height:200px;"><?php echo $rows['content'];?></textarea>
				</td>
			</tr>
			</table>
			<input type="hidden" name="id" id="id" value="<?php echo $rows['id'];?>">
		<a href="javascript:;" id="submit" class="btn btn-primary btn-lg active">修改</a>
		<a href="./index.php"  class="btn btn-default btn-lg active">取消</a>
	</div>
	<script>
		$(function(){
			$('#submit').click(function(){
				//采集数据
				var title = $("#title").val();
				if(title == ''){
					layer.msg('标题不能为空',{
						offset:320,
						shift:8,
					});
					$("#title").focus();
					return false;
				}
				var content = $('#content').val();
				if(content == ''){
					layer.msg('内容不能为空',{
						offset:320,
						shift:8,
					});
					$('#content').focus();
					return false;
				}
				var id = $('#id').val();
				//发布异步提交
				var index = null;
				var o = {
					'type' : 'POST',
					'url'  : 'showData.php',
					'data' :{
							'title'    : title,
							'content' : content,
							'id'      : id,
					},
					'dataType':'html',
					//发送前的状态
					'beforSend': function(){
						index=layer.load(2,{
							shade:[0.1,"#FFF"]
						});
					},
					//发送后返回的状态
					'success':function(data){
						if(data == 'ok'){
							layer.close(index);
							console.log('ok1');
							layer.msg('修改成功', {icon: 6});//添加一下时间，之后再消失
							setTimeout(function(){
								location.href='index.php';
							},1000);
						}else if(data == 'error'){
							layer.msg('数据插入错误',{
								offset:320,
								shift:8,
							});	
						}
					},
				};
				$.ajax(o);
				return false;
			});
		});
	</script>
</body>
</html>