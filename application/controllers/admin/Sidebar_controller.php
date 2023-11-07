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
        $data['sidebar_content'] = $this->load->view('admin/sidebar/sidebar_content', '', TRUE);


        $project_id = 2; // Replace with the actual project ID
        $project_name = $this->sidebar_model->get_project_name($project_id);

        $data['project_name'] = $project_name;
        $data['results'] = $this->sidebar_model->get_data();
        $data['user_result'] = $this->sidebar_model->get_user_data();
        $this->load->view('admin/sidebar/sidebar_content', $data);
        

    }
  
}
