<?php 
	/**
	 * wangwang 892499846@qq.com
	 */
	
	/**
	 * 
	 */
	require_once('card_manage/functions_card_manage.php');
	class Card_manager 
	{
		
		function __construct()
		{
			# code...

		}

		public function delete($post){
			//var_dump($post);
			//echo "delete";
			if(delete_card_by_id($post['id'])){
				return new Result;
			}else{
				return new Result(false,null,"删除失败");
			}
		}

		public function add($post){
			//var_dump($post);
			//echo "post";
			if(insert_card($post['card_no'],$post['village'],$post['town'],$post['tag'])){
				return new Result;
			}else{
				return new Result(false,null,"添加失败");
				
			}
		}

		public function query($data){
			$page = $data['page'];//每页5个
			include("card_manage/card_manage.php");
		}

	}

	/**
	 * 
	 */
	class Result 
	{
		public $succeed;
		public $data;
		public $info;
		function __construct($succeed=true,$data=null,$info = "")
		{
			# code...
			$this->succeed = $succeed;
			$this->data = $data;
			$this->err_info = $err_info;
		}

		public function __toString() {
      		return json_encode($this);
    	}
	}


 ?>


<?php 
//	echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'?operate=query&page=0';
//var_dump($_SERVER);
	$manager = new Card_manager;
	$operate = $_GET['operate'] ? $_GET['operate']:"query"; // 操作方式（query，delete,insert,update）;
	$data;
	if( $_SERVER['REQUEST_METHOD'] == 'GET'){
		$data["page"] = $_GET['page'] ? $_GET['page']:0; //当前页码
	}else if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$data = $_POST;
	}
	if(method_exists($manager,$operate)){
		echo $manager->$operate($data);
	}else{
		echo new Result(false,null,"没有此方法");
	}

 ?>
