<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function index(){
    	
        $data = array('main_content' => 'template/admin/index', 'page_title' => 'Welcome');
        
        $this->load->view('template/admin/page', $data);
        
    }
}
