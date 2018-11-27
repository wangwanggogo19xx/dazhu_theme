

var items = [];
var init_items = function(){
	var imgs = $("#container img");
	$.each(imgs,function(index,row) {
		items.push([$(row).attr('src'),$(row).parents('a').eq(0).prop('href')]);
        })
}
var refresh_items = function(){
	var imgs = $("#container img");
	$.each(imgs,function(index,row) {
		$(row).attr('src',items[index][0]);
		$(row).parents('a').eq(0).prop('href',items[index][1]);
    })
    $('item_3').focus();
}
var next_item = function(){
	if(items.length <= 0){
		init_items()
	}
	items.unshift(items.pop());
	refresh_items();
}

var last_item = function(){
	if(items.length <= 0){
		init_items()
	}
	items.push(items.shift());
	refresh_items();
}

var key_binds=[];
key_binds['39'] = last_item
key_binds['37'] = next_item
$(document).keydown(function(event){
	if(key_binds[event.keyCode]){
		key_binds[event.keyCode]();
	}

})