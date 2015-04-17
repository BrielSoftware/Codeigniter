<?php
function print_a($arr){
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}


function build_pagination($total, $page_nr, $per_page = PER_PAGE_ADMIN){
	
    $current_url = current_url();
    
    if($total <= $per_page){
        //no pages needed
    	return '';
    }
    $nr_of_pages = ceil($total / $per_page);
    
    $html = '<div class="pagination">';
    
    
    $html .= '</div>';
}

define('PER_PAGE_ADMIN', '50');