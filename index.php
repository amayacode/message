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
</head>
<body>
	<div style="margin:50px auto;width:800px;">
		<h1 style="text-align: center;margin-bottom: 50px;">留言列表记录</h1>
		<table class="table table-striped table-responsive table-hover">
			<tr>
				<th>ID</th>
				<th>标题</th>
				<th>内容</th>
				<th>时间</th>
				<th>操作</th>
			</tr>
			<?php
				$pdo  = new PDO("mysql:host=localhost;dbname=message",'root','69007');
				$pdo->query('set names utf8');
				//$sql = "select * from bg";
				$sql = "select * from bg";
				$tme = $pdo->prepare($sql);
				$tme->execute();
				$rows = $tme->fetchAll(PDO::FETCH_ASSOC);
				foreach ($rows as  $value) {
					echo "<tr>";
					echo "<td>".$value['id']."</td>";
					echo "<td>".htmlspecialchars_decode($value['title'])."</td>";
					echo "<td>".htmlspecialchars_decode($value['content'])."</td>";
					echo "<td>".date('Y-m-d H:i:s',$value['time'])."</td>";
					echo "<td>";
					echo "<a href='show.php?id=".$value['id']."'>修改&nbsp;</a>";
					echo "<a href='javascript:;' onclick='del(".$value['id'].")'>删除</a>";
					echo "</td>";
					echo "</tr>";
				}
			?>
		</table>
		<a href="add.html"><button type="submit" class="btn btn-primary">添加</button></a>
	</div>
	<script>
    //删除
    function del(id) {
        layer.confirm('您确定要删除这条留言吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.get('del.php?id='+id,function (data) {
                if(data == 'ok'){
                    location.href = location.href;
                   
                }else if(data == 'error'){
                    layer.msg('删除失败', {icon: 5});
                }
            });
//            layer.msg('的确很重要', {icon: 1});
        }, function(){

        });
    }
</script>
</body>
</html>