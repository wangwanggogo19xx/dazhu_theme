$(function(){
	
	if(window.history && window.history.pushState){
		$(window).on('popstate',function(){
			window.location.href = RETURN_URL;
		})
	}

})
var RETURN_URL = "http://192.168.33.20/dazhu/";
// var item_be_choosed = function(){
// 	window.location.href = $(".item.focus").parent("a").attr('href');
// }
// var key_binds=[];
// key_binds['13'] = be_choosed;