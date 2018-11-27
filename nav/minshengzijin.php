<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php wp_title('|', true, 'right'); ?></title>

	<!-- <link rel="stylesheet" type="text/css" href="../css/minshengzijin.css">

	<script type="text/javascript" src="../js/jquery-1.8.1.min.js"></script>
	<script type="text/javascript" src="../js/minshengzijin.js"></script> -->
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()."/css/minshengzijin.css"; ?>">

	<script type="text/javascript" src="<?php echo get_template_directory_uri()."/css/jquery-1.8.1.min.js"; ?>"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri()."/css/minshengzijin.js"; ?>"></script>
	<!-- <script type="text/javascript" src="../js/minshengzijin.js"></script> -->
</head>
<body>
<header>
	<h1>资金查询</h1>
	<h3>请输入您的信息来查询您最近两年的资金补贴信息</h3>
</header>
<div id="container">
	<h5>输入遥控器*号键来代替字母X</h5>
	<div id="search_box">
		<label for="id_card">身份证:</label>
		<input type="text" height="100%" width="20%" id="id_card" name="id_card">
		<!-- <input type="button" name="submit"  value="提交"> -->
		<button id="submit">提交 </button>		
	</div>
	<div id="search_result">
	<table >
		<thead>
			<tr><th class="name">姓名</th> <th class="department">发放部门</th> <th class="project">发放项目</th> <th class="money">金额</th> <th char="divergency_date">发放日期</th></tr>
		</thead>
		<tbody >
			<!-- <tr><td class="name">姓名</td> <td class="department">发放部门</td> <td class="project">发放项目</td> <td class="money">金额</td> <td char="divergency_date">发放日期</td></tr> -->

		</tbody>	
	</table> 
	</div>
</div>