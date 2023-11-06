<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sidebar_controller extends CI_Controller {




    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');


        $this->load->model('sidebar_model');

    }


    public function index() {
        $staff_id = $this->session->userdata('staff_user_id');
        $data['total_billable_hours'] = $this->sidebar_model->get_total_billable_hours($staff_id);
        $data['total_hours'] = $this->sidebar_model->get_total_hours($staff_id);
        $data['total_Notbillable_hours'] = $this->sidebar_model->get_total_Notbillable_hours($staff_id);
        $data['sidebar_contentZ'] = $this->load->view('admin/sidebar/sidebar_content', '', TRUE);
        $this->load->view('main_view', $data);

        



    }
}
