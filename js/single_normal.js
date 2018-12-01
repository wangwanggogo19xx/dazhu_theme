$(function(){

	var article;
	var width;
	var current_page = 1;
	var total_page_count;
	var init_page = function(){
		article = $("article");
		width = Math.floor(article.width());

		article.width(width);
		console.log(width);
		article.css({
			"column-width":width+"px",
			"-webkit-column-width":width+"px",
			"-moz-column-width":width+"px",
			"column-gap":gap_width + "px",
			});

		var scroll_width = article[0].scrollWidth;
		total_page_count = (scroll_width - width) / (width + gap_width) + 1;
		console.log(total_page_count);
		$("#total_page").text(total_page_count);

	}

	var my_next_page = function(){
		var scroll_left = $("article").scrollLeft();
		if(current_page + 1 <= total_page_count){
			scroll_left += width + gap_width;
			$("article").scrollLeft(scroll_left);
			current_page += 1;
			$("#current_page").text(current_page);
		}
	}

	var my_prev_page = function(){
		var scroll_left = $("article").scrollLeft();
		if(current_page - 1 >= 1){
			scroll_left -= (width + gap_width);
			$("article").scrollLeft(scroll_left);
			current_page -= 1;
			$("#current_page").text(current_page);
		}
	}

	init_page();

	KEY_BIKNDS['39'] = my_next_page;
	KEY_BIKNDS['37'] = my_prev_page;
	KEY_BIKNDS['38'] = null;
	KEY_BIKNDS['40'] = null;

})
var gap_width = 100;
var next_page;