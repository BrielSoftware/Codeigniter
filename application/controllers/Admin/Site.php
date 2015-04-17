<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

    public function site_list(){

        
        $arrResults = $this->_getSiteList();
        
        $arrSites = $arrResults['arrSites'];
        $pagination = $arrResults['pagination'];
        
        $data = array(  'main_content' => 'template/admin/site_list', 
                        'page_title' => 'Sites list',
                        'arrSites' => $arrSites,
                        'pagination' => $pagination);

        $this->load->view('template/admin/page', $data);

    }
    
    protected function _getSiteList(){
    	
        $query = $this->db->get('site');
        
        $count = $query->num_rows();
        if($count > 0){
        	if(empty($_GET['p'])){
        		$page_nr = 1;
        	}else{
        		$page_nr = $_GET['p'];
        	}
        	$offset = PER_PAGE_ADMIN * $page_nr;
        	if($count > PER_PAGE_ADMIN){
        	    $pagination = build_pagination($count, $page_nr);
        	}else{
        	    $pagination = '';
        	}
            
            
            $arrSites = $this->db->get('site', PER_PAGE_ADMIN, $offset)->result_array();
            
            $return['pagination'] = $pagination;
            $return['arrSites'] = $arrSites;
        }else{
            $return['pagination'] = '';
            $return['arrSites'] = array();
        }
        
        return $return;
    }
}