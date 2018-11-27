$(function() {
	$("#container").width($("#container").width());//取整

	
	var pages = {
	current_page:1,
	total_page:parseInt($("#total_page").text()),
	next_page:function(){
		var left = parseInt($("ul").css("left").split('px')[0]);
		console.log(pages.total_page);
		if((pages.current_page + 1) <= pages.total_page){
			$("ul").animate({'left':(left - $("ul").width())+"px"},1000);
			pages.current_page += 1;
			$("#current_page").html(pages.current_page);
			return;
		}
		console.log("已经是最后一页");
	},
	last_page:function(){
		var left = parseInt($("ul").css("left").split('px')[0]);
		if((pages.current_page - 1) > 0){
			$("ul").animate({'left':(left + $("ul").width())+"px"},1000);
			pages.current_page -= 1;
			$("#current_page").html(pages.current_page);
		return;
		}
		console.log("已经是第一页");
	}
	}

	var key_binds=[];
	key_binds['39'] = function(){
		if(!$("ul").is(":animated")){
			console.log("ss");
			pages.next_page();
		}
		console.log($("ul").is(":animated"));
	}
	key_binds['37'] = function(){
		if(!$("ul").is(":animated")){
			pages.last_page();
		}
	}
	$(document).keydown(function(event){
		if(key_binds[event.keyCode]){
			key_binds[event.keyCode]();
	}

	})
})

