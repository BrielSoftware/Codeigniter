<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

    public function site_list(){

        
        $arrResults = $this->_getSiteList();
        
        if(!empty($_GET['edit'])){
            $arrEdit = $this->_getOneSite($_GET['edit']);
        }else{
        	$arrEdit = array();
        }
        
        $arrSites = $arrResults['arrSites'];
        
        $pagination = $arrResults['pagination'];
        
        $data = array(  'main_content' => 'template/admin/site_list', 
                        'page_title' => 'Sites list',
                        'arrSites' => $arrSites,
                        'pagination' => $pagination,
                        'arrEdit' => $arrEdit);

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
        	$offset = PER_PAGE_ADMIN * ($page_nr - 1);
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
    protected function _getOneSite($site_id){
    	
        $query = $this->db->get_where('site', array('id' => $site_id), 1);
        $arrEdit = $query->row_array();
        
        return $arrEdit;
    }
    
    public function add_new(){
    	
        $this->load->library('form_validation');
         
        $config = array(
            array(
                'field' => 'site_name',
                'label' => 'Site name',
                'rules' => 'required'
            ),
            array(
                'field' => 'site_url',
                'label' => 'Site url',
                'rules' => 'required|callback_check_site_url'
            )
        );
        $this->form_validation->set_rules($config);
         
        if ($this->form_validation->run() == false){

            $_SESSION['error_message'] = validation_errors();
            
            $_SESSION['_submited']['site_name'] = $this->input->post('site_name');
            $_SESSION['_submited']['site_url'] = $this->input->post('site_url');
            $_SESSION['_submited']['site_status'] = $this->input->post('site_status');
            
            redirect('admin/site/site_list');
             
        }else{
             
            $site_name = $this->input->post('site_name');
            $site_url = $this->input->post('site_url');
            $site_status = $this->input->post('site_status');
             
            $site_url = $this->_make_pretty_url($site_url);
            
            $data = array(  'id' => '',
                            'site_name' => $site_name,
                            'site_url' => $site_url,
                            'last_crawled' => '',
                            'status' => $site_status);
            $this->db->insert('site', $data);
            
            $this->_create_new_url_table($site_url);
            
            redirect('admin/site/site_list');
        }
    }
    
    protected function _create_new_url_table($site_url){
    	
        $query = $this->db->get_where('site', array('site_url' => $site_url), 1);
        $arrOneSite = $query->row_array();
        
        $sql = "CREATE TABLE IF NOT EXISTS `site_".$arrOneSite['id']."_urls` (
                  `id` bigint(16) NOT NULL,
                  `url` varchar(500) NOT NULL,
                  `meta_title` varchar(250) DEFAULT NULL,
                  `crawled` tinyint(1) NOT NULL DEFAULT '0',
                  `last_crawled` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                  `last_crawled_timestamp` bigint(16) NOT NULL DEFAULT '0',
                  `is_product` tinyint(2) NOT NULL DEFAULT '0',
                  KEY `url` (`url`(255),`crawled`,`is_product`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ";
        
        $this->db->query($sql);
    }
    
    public function edit_site(){
    	
        if(!empty($this->input->post('site_id'))){
        	
            $site_name = $this->input->post('site_name');
            $site_url = $this->input->post('site_url');
            $site_status = $this->input->post('site_status');
            
            $data = array(  'site_name' => $site_name,
                            'site_url' => $site_url,
                            'status' => $site_status);
            
            $this->db->where('id', $this->input->post('site_id'));
            $this->db->update('site', $data);
        }
        
        redirect('admin/site/site_list');
        
    }
    
    public function site_delete(){
    	
        if(!empty($_GET['delete']) && is_numeric(($_GET['delete']))){
            $this->db->where('id', $_GET['delete']);
            $this->db->delete('site');
        }
        
        redirect('admin/site/site_list');
    }
    
    public function check_site_url($str){
        if(stripos($str, '.') === false || stripos($str, '.') < 2){
            
            $this->form_validation->set_message('check_site_url', 'The %s is not a valid url');
            return false;
            
        }else{
            
            return true;
            
        }
    }
    
    protected function _make_pretty_url($site_url){
    	
        if(stripos($site_url, 'http://') === false){
        	$site_url = 'http://'.$site_url;
        }
        
        return $site_url;   
    }
}