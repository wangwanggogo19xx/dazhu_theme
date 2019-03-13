$(function() {

	var total_pages = parseInt($(".total_pages").text()) || 0;
	var current_page = parseInt($(".current_page").text()) || 0;
	
	next_page = function(){
		if (current_page + 1 <= total_pages) {
			// window.location.href = next_page_url;
			window.location.href = window.location.href.split("?")[0]+"?page="+(current_page + 1);
		}
		console.log("next_page");
	}

	prev_page = function(){
		if (current_page - 1 >= 1 ) {
			window.location.href = window.location.href.split("?")[0]+"?page="+(current_page - 1);
		}
		console.log("prev_page");
	}

	var my_pre_item =function(){
		if($(".item.focus").parent('a').index() == 0){
			prev_page();
			// console.log($(".item.focus").parent('a').index());
		}else{
			prev_item();
		}
		
	}
	var my_next_item =function(){
		var total_count = $("ul>a").length;
		if($(".item.focus").parent('a').index() == total_count - 1){
			// console.log($(".item.focus").parent('a').index());
			next_page();
		}else{
			next_item();
		}

	}
	// up
	// KEY_BIKNDS['38'] = my_pre_item;
	// down
	// KEY_BIKNDS['40'] = my_next_item;
	// // left
	KEY_BIKNDS['37'] = undefined;
	// right
	KEY_BIKNDS['39'] = undefined;
		// $("a.item").hover();
	// var items = $("ul > a");

	// $(document).on("keydown",function(event){

	// 	if(key_binds[event.keyCode]){
	// 		key_binds[event.keyCode]();
	// 	}

	// })
	// $("a:first-child>.item").keydown(function(event){
	// 	console.log(".item:first-child");
	// })
	// $("a:last-child>.item").keydown(function(event){
	// 	console.log(".item:last-child");
	// })
});

// var next_page_url;
// var last_page_url;
// var current_page;
// var total_page;

// var next_page = function(){
// 	if (current_page + 1 <= total_page) {
// 		// window.location.href = next_page_url;
// 	}
// 	console.log("next_page");
// }
// var last_page = function(){
// 	if (current_page - 1 >= 1 ) {
// 		// window.location.href = last_page_url;
// 	}
// 	console.log("last_page");
// }
// var next_item = function(){
// 	var this_item = $(".item.focus");
// 	var next_item = this_item.parent("a").next().children(".item");
// 	if(next_item.length > 0){
// 		next_item.addClass('focus');
// 		this_item.removeClass("focus");
// 	}else{
// 		next_page();
// 	}
// }

// var last_item = function(){
// 	var this_item = $(".item.focus");
// 	var last_item = this_item.parent("a").prev().children(".item");
// 	console.log(last_item.html());
// 	if(last_item.length > 0){
// 		last_item.addClass('focus');
// 		this_item.removeClass("focus");
// 	}else{
// 		last_page();
// 	}
// }
// var be_choosed = function(){
// 	window.location.href = $(".item.focus").parent("a").attr('href');
// }
// var key_binds=[];
// key_binds['38'] = last_item;
// key_binds['40'] = next_item;
// key_binds['13'] = be_choosed;