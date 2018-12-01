$(function(){
	$("#submit").on('click', search_subsidy);
	console.log(query_url);
})
var show_infomation = function(msg,delay,call_back){

}
var str_format = function() {
    if (arguments.length == 0)
        return null;
    var str = arguments[0];
    for ( var i = 1; i < arguments.length; i++) {
        var re = new RegExp('\\{' + (i - 1) + '\\}', 'gm');
        str = str.replace(re, arguments[i]);
    }
    return str;
}

var add_search_result = function(data){
		var $livehoodIdTable = $('#search_result>table>tbody');
		$.each($.parseJSON(data),function (index,item) {
	        if(item.success && item.total>0 && item.items.length>0){
	            var items = item.items;
	            $.each(items,function(index,row) {
	            	var template ="<tr><td class='name'>{0}</td> \
	            	<td class='department'>{1}</td> 	\
	            	<td class='project'>{2}</td>	\
	            	<td class='money'>{3}</td> \
	            	<td char='divergency_date'>{4}\
	            	</td></tr>";
	                var line = str_format(template,row.receiverName,row.orgnName,row.projectName,row.money,row.sendDate);
	                console.log(line);
	                $livehoodIdTable.append(line);
	            })
	        }
	    });
}
var is_id_card = function(str){
	return true;
}

var query_url;
var search_subsidy = function(argument) {
	$("tbody").html("");
	var id_card = $("#id_card").val();
	if(!is_id_card(id_card)){
		console.log("请输入正确的身份证");
		return;
	}
    var params = {
        action:'livehood-query',
        idCard:id_card
    };

	// $.post('functions.php',$('form').serialize()+'&'+$.param(params) , function (data) {
	$.post(query_url,$.param(params) , function (data) {
   
		console.log(data);
		if(data.length > 0){
			add_search_result(data);
        }else{
			console.log("!23");
		}

    });
}