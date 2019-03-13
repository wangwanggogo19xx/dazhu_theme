$(function(){

	var per_row = 3;
	var next_row_item = function(){
		var this_item = $(".item.focus");
		var next_row_item = this_item.parents(".item_wrapper").nextAll().eq(per_row - 1 ).find(".item");
		if(next_row_item.length){
			this_item.removeClass('focus');
			next_row_item.addClass('focus');
		}else{
			next_page();
		}
		
	}

	var prev_row_item = function(){
		var this_item = $(".item.focus");
		var prev_row_item = this_item.parents(".item_wrapper").prevAll().eq(per_row - 1).find(".item");
		if(prev_row_item.length){
			this_item.removeClass('focus');
			prev_row_item.addClass('focus');
		}else{
			prev_page();
		}
		
	}


	// left
	KEY_BIKNDS['37'] = prev_item;
	// right
	KEY_BIKNDS['39'] = next_item;
	// up
	KEY_BIKNDS['38'] = prev_row_item;
	// down
	KEY_BIKNDS['40'] = next_row_item;

	
	
})