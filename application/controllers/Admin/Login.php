<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function user_login(){
	    
	    $this->load->library('form_validation');
	    
	    $config = array(
	        array(
	            'field' => 'username',
	            'label' => 'Username',
	            'rules' => 'required'
	        ),
	        array(
	            'field' => 'pass',
	            'label' => 'Password',
	            'rules' => 'required',
	            'errors' => array(
	                'required' => 'You must provide a %s.',
	            ),
	        )
        );
	    $this->form_validation->set_rules($config);
	    
	    if ($this->form_validation->run() == false){
	        
	        redirect('admin');
	        
	    }else{
	        
	        $username = $this->input->post('username');
	        $pass = $this->input->post('pass');
	        
	        $query = $this->db->get_where('admin_users', array('username' => $username, 'password' => md5($pass)), 1);
	        $arrUser = $query->row_array();
	        
	        if(!empty($arrUser) && $arrUser['status'] == '1'){
	        	//password and user correct
	        	//we log the user
	        	
	            $user_data = array('username' => $username, 'admin_logged' => 'logged');
	            $this->session->set_userdata($user_data);

	            redirect('admin');
	            
	        }else{
	            
	            $this->form_validation->set_message('rule', 'Wrong username or password');
	            redirect('admin');
	            
	        }
	    }
	    
	}
	public function user_logout(){
		
	    $user_data = array('username', 'admin_logged');
	    $this->session->unset_userdata($user_data);
	    
	    redirect('admin');
	    
	}
}
