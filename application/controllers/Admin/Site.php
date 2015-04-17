<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

    public function site_list(){

        $data['main_content'] = 'template/admin/site_list';

        $this->load->view('template/admin/page', $data);

    }
}