$(function(){
	$(".focus").removeClass("focus");
	$(".item").eq(0).addClass("focus");


	$(document).on("keydown",function(event){
		if(KEY_BIKNDS[event.keyCode]){
			KEY_BIKNDS[event.keyCode]();
		}else{
			console.log("did not define the keyboard event:"+event.keyCode);
		}
	})


	var total_pages = parseInt($(".total_pages").text()) || 0;
	var current_page = parseInt($(".current_page").text()) || 0;
	// var total_items_count = parseInt($("#items_container>ul>a").length) || 0;
	var total_items_count = parseInt($("ul>a").length) || 0;



	// 默认上一页
	prev_page =function(){
		// do nothing
		if (current_page - 1 >= 1 ) {
			window.location.href = window.location.href.split("?")[0]+"?page="+(current_page - 1);
		}else{
			console.log("已经是第一页");
		}
	}

	// 默认条状下一页
	next_page = function(){
		// do noting
		if (current_page + 1 <= total_pages) {
			window.location.href = window.location.href.split("?")[0]+"?page="+(current_page + 1);
		}
		console.log("已经是最后一页");
	}


	// 定位到下一个元素
	next_item = function(){
		var this_item = $(".item.focus");
		current_page = parseInt($(".current_page").text());
		var this_item_index = this_item.parent("a").index();
		if(this_item_index + 1 <= total_items_count - 1){
			this_item.parent("a").next().children(".item").addClass('focus');
			this_item.removeClass("focus");
		}else{
			// 不同页面需要实现各自的下一页
			next_page();
		}
	} 

	// 定位到上一个元素
	prev_item = function(){
		var this_item = $(".item.focus");
		current_page = parseInt($(".current_page").text());
		var this_item_index = this_item.parent("a").index();

		if(this_item_index - 1 >= 0){
			this_item.parent("a").prev().children(".item").addClass('focus');
			this_item.removeClass("focus");
		}else{
			// 不同页面需要实现各自的下一页
			prev_page();
		}
	}



	item_be_choosed = function(){
		window.location.href = $(".item.focus").parent("a").attr('href');
	}
	//enter
	KEY_BIKNDS['13'] = item_be_choosed;
	// up
	KEY_BIKNDS['38'] = prev_item;
	// down
	KEY_BIKNDS['40'] = next_item;
	// // left
	KEY_BIKNDS['37'] = undefined;
	// right
	KEY_BIKNDS['39'] = undefined;	



	
})
// var THIS_ITEM;
// var NEXT_ITEM;
var KEY_BIKNDS ={};

var prev_page;
var next_page;
var next_item;
var prev_item;
var item_be_choosed;


