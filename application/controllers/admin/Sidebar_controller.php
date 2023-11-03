<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sidebar_controller extends CI_Controller {
    public function index() {
        $data['sidebar_content'] = $this->load->view('admin/sidebar/sidebar_content', '', TRUE);
        $this->load->view('main_view', $data);
    }
}
