$(function(){



	var total_count = $("ul>a").length ;
	var per_row = 5;
	var next_row_item = function(){
		var this_item = $(".item.focus");
		var index = this_item.parent("a").index();
		console.log(index);
		if (index + per_row <= total_count - 1) {
			this_item.removeClass('focus');
			$("ul>a").eq(index + per_row).children(".item").addClass("focus");
		}
	}

	var prev_row_item = function(){
		var this_item = $(".item.focus");
		var index = this_item.parent("a").index();
		console.log(index);
		if (index - per_row >= 0 ) {
			this_item.removeClass('focus');
			$("ul>a").eq(index - per_row).children(".item").addClass("focus");
		}
	}


	// $(".item").eq(0).addClass("focus");

	// left
	KEY_BIKNDS['37'] = prev_item;
	// right
	KEY_BIKNDS['39'] = next_item;
	// up
	KEY_BIKNDS['38'] = prev_row_item;
	// down
	KEY_BIKNDS['40'] = next_row_item;



})

