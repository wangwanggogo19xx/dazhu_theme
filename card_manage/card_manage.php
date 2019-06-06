<?php
/**
 * Created by IntelliJ IDEA.
 * User: 827605162@qq.com
 * Date: 2018/3/27
 * Time: 17:19
 */
if(!current_user_can( 'manage_options' ) ) {
	echo "请先登录管理员账户";
	return ;
}


get_header();
$url = __DIR__.'/functions_card_manage.php';
require_once($url);
$cards = get_cards($page);
?>
<style type="text/css">
	#container{
		height:80%;
		width:80%;
		margin:0 auto;
	}
	table{
		text-align: center;
		width:100%;
		margin: 0 auto;
	}
	input{
	
		color:black;
	}
	thead td{
	
	text-align:center;
	font-size:2rem;
	}
	td {
		width:20%;
		height:15%;
	}
	td input{
		width:100%;
		font-size:1.5rem;
	}
	.btn{
		width:40%;
		/*height:80%;*/
		color:black;
		font-size:1.5rem;
		/*background-color:blue;*/
		border-radius:1rem;
	}
	a{
		text-decoration: none;
		color: white;
		font-size: 1rem;
	}
</style>
<div id="container">
	<table>
		<thead>
			<td>卡号</td>
			<td>村名</td>
			<td>乡镇</td>
			<td>备注</td>
		</thead>
		<tbody>
		<?php
		 foreach($cards as $card){
			echo "<tr card_id='".$card->id."'><td><input type='text' name='card_no' value='".$card->card_no."'></td>
	<td><input type='text' name='village' value='".$card->village."'></td>
        <td><input type='text' name='town' value='".$card->town."'></td>
        <td><input type='text' name='tag' value='".$card->tag."'></td>
        <td><!--<button class='btn'>修改</button>--><button class='btn delete'>删除</button></td>";
		}	
?>
			<tr><td style="font-size:1.5rem;">添加卡号</td></tr>
			<tr>
				<td><input type="text" name="card_no" value="" placeholder="card_no"></td>
				<td><input type="text" name="village" value="" placeholder="村名"></td>
				<td><input type="text" name="town" value="" placeholder="乡镇名"></td>
				<td><input type="text" name="tag" value="" placeholder="备注"></td>
				<td><button class='btn add'>添加</button></td>
			</tr>
		</tbody>
	</table>
<p>
	<?php
		//$current_page = $_GET['page'] ? $_GET['page']:0;
		//var_dump($_SERVER);
		$file_path = $_SERVER['REDIRECT_URL'] ? $_SERVER['REDIRECT_URL']: $_SERVER['SCRIPT_NAME'];
		$base_url = "http://".$_SERVER['HTTP_HOST'].$file_path.'?operate=query&page=';
		if($page != 0 ){
			$last_url = $base_url.($page - 1);
			echo "<a href='".$last_url."'>上一页</a>";
		}
		if($page != get_total_page()){
			$next_url = $base_url.($page + 1);
			echo "<a href='".$next_url."'>下一页</a>";
		}
		
	?>
	</p>
</div>


<?php
get_footer();
?>
<script type="text/javascript">
	$(function(){

		$(".delete").on("click", function(){
			var data = {"id":$(this).parents("tr").attr("card_id")};
			console.log(data);
			var url = window.location.origin+window.location.pathname+"?operate=delete"
			console.log(url);

			$.post(url, data, function(data,status){
				console.log(data);
				console.log(status);
				if(status == "success"){
					window.location.reload();
				}
			})
		})



		$(".add").on("click",function(){
			console.log("add");

			data = {
				"card_no":$(this).parents("tr").find("input").eq(0).val(),
				"village":$(this).parents("tr").find("input").eq(1).val(),
				"town":$(this).parents("tr").find("input").eq(2).val(),
				"tag":$(this).parents("tr").find("input").eq(3).val()
			}

			console.log(data);
			var url = window.location.origin+window.location.pathname+"?operate=add"
			$.post(url, data, function(data,status){
				console.log(data);
			})
		})

	})
</script>
