$(function() {

	var total_pages = parseInt($(".total_pages").text()) || 0;
	var current_page = parseInt($(".current_page").text()) || 0;
	var total_items_count = parseInt($("#items_container>ul>a").length) || 0;
	

	var next_page = function(){
		if (current_page + 1 <= total_pages) {
			window.location.href = window.location.href.split("?")[0]+"?page="+(current_page + 1);
		}
		console.log("next_page");
	}

	var prev_page = function(){
		if (current_page - 1 >= 1 ) {
			window.location.href = window.location.href.split("?")[0]+"?page="+(current_page - 1);
		}
		console.log("prev_page");
	}

	var my_pre_item =function(){
		if($(".item.focus").parent('a').index() == 0){
			prev_page();
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
	KEY_BIKNDS['38'] = my_pre_item;
	// down
	KEY_BIKNDS['40'] = my_next_item;
	// // left
	KEY_BIKNDS['37'] = undefined;
	// right
	KEY_BIKNDS['39'] = undefined;

});
