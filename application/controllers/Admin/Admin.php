<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function test(){
		$this->load->view('test');
	}
	public function test2(){
		$this->load->view('welcome_message');
	}
}
