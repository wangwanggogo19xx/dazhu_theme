<?php 

	$id_card = $_POST['idCard'];
	// $id_card = '513029194608191735';
    $livehood_welfare_ajax_query_url ='http://www.dzxyghmhdpt.gov.cn/fundsdetail!getFundsInfo.do?start=0&limit=5&permissionCode=978D90244C82F512E888DBE28270AC95&idCard=';
    $livehood_welfare_ajax_query_url = $livehood_welfare_ajax_query_url . $id_card;
    $curYear = date("Y");
    $resp = '[';
    for( $i=0;$i<2;$i++){
        $year = $curYear -$i;
        $query_url = $livehood_welfare_ajax_query_url . '&year=' . $year;
        $html = file_get_contents($query_url);

        if($resp{strlen($resp)-1}=='}'){
            $resp = $resp .',' .$html;
        }else{
            $resp = $resp .$html;
        }

    }
    $resp = $resp.']';
    echo  $resp;


 ?>