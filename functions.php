<?php 

function get_category_custome_link($cate){

    $cate_link = get_category_link($cate->term_id);
    if(!is_null($cate->description) &&
        (strncmp($cate->description,'http:',5)==0 || strncmp($cate->description,"https:",6)==0)){
            $cate_link = trim($cate->description);
    }
    return  $cate_link;
}
 ?>