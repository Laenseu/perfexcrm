<?php

use app\services\utilities\Str;

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        $this->load->model('dashboard_model');
    }

       
    /* This is admin dashboard view */
    public function index()
    {
        
     
        close_setup_menu();
        $this->load->model('departments_model');
        $this->load->model('todo_model');
        $data['departments'] = $this->departments_model->get();

        $data['todos'] = $this->todo_model->get_todo_items(0);
        // Only show last 5 finished todo items
        $this->todo_model->setTodosLimit(5);
        $data['todos_finished']            = $this->todo_model->get_todo_items(1);
        $data['upcoming_events_next_week'] = $this->dashboard_model->get_upcoming_events_next_week();
        $data['upcoming_events']           = $this->dashboard_model->get_upcoming_events();
        $data['title']                     = _l('dashboard_string');

        $this->load->model('contracts_model');
        $data['expiringContracts'] = $this->contracts_model->get_contracts_about_to_expire(get_staff_user_id());

        $this->load->model('currencies_model');
        $data['currencies']    = $this->currencies_model->get();
        $data['base_currency'] = $this->currencies_model->get_base_currency();
        $data['activity_log']  = $this->misc_model->get_activity_log();
        // Tickets charts
        $tickets_awaiting_reply_by_status     = $this->dashboard_model->tickets_awaiting_reply_by_status();
        $tickets_awaiting_reply_by_department = $this->dashboard_model->tickets_awaiting_reply_by_department();

        $data['tickets_reply_by_status']              = json_encode($tickets_awaiting_reply_by_status);
        $data['tickets_awaiting_reply_by_department'] = json_encode($tickets_awaiting_reply_by_department);

        $data['tickets_reply_by_status_no_json']              = $tickets_awaiting_reply_by_status;
        $data['tickets_awaiting_reply_by_department_no_json'] = $tickets_awaiting_reply_by_department;

        $data['projects_status_stats'] = json_encode($this->dashboard_model->projects_status_stats());
        $data['leads_status_stats']    = json_encode($this->dashboard_model->leads_status_stats());
        $data['google_ids_calendars']  = $this->misc_model->get_google_calendar_ids();
        $data['bodyclass']             = 'dashboard invoices-total-manual';
        $this->load->model('announcements_model');
        $data['staff_announcements']             = $this->announcements_model->get();
        $data['total_undismissed_announcements'] = $this->announcements_model->get_total_undismissed_announcements();

        $this->load->model('projects_model');
        $data['projects_activity'] = $this->projects_model->get_activity('', hooks()->apply_filters('projects_activity_dashboard_limit', 20));
        add_calendar_assets();
        $this->load->model('utilities_model');
        $this->load->model('estimates_model');
        $data['estimate_statuses'] = $this->estimates_model->get_statuses();

        $this->load->model('proposals_model');
        $data['proposal_statuses'] = $this->proposals_model->get_statuses();

        $wps_currency = 'undefined';
        if (is_using_multiple_currencies()) {
            $wps_currency = $data['base_currency']->id;
        }
        $data['weekly_payment_stats'] = json_encode($this->dashboard_model->get_weekly_payments_statistics($wps_currency));

        $data['dashboard'] = true;

        $data['user_dashboard_visibility'] = get_staff_meta(get_staff_user_id(), 'dashboard_widgets_visibility');

        if (!$data['user_dashboard_visibility']) {
            $data['user_dashboard_visibility'] = [];
        } else {
            $data['user_dashboard_visibility'] = unserialize($data['user_dashboard_visibility']);
        }
        $data['user_dashboard_visibility'] = json_encode($data['user_dashboard_visibility']);

        $data['tickets_report'] = [];
        if (is_admin()) {
            $data['tickets_report'] = (new \app\services\TicketsReportByStaff())->filterBy('this_month');
        }

        
        $data['logged_time'] = $this->staff_model->get_logged_time_data($id);
        $staff_id = $this->session->userdata('staff_user_id');
        $data['total_hours'] = $this->dashboard_model->get_total_hours($staff_id);
        $data['total_billable_hours'] = $this->dashboard_model->get_total_billable_hours($staff_id);
        $data['total_Notbillable_hours'] = $this->dashboard_model->get_total_Notbillable_hours($staff_id);

        $this->load->view('admin/dashboard/dashboard', $data);
        
        
       // Your controller
     


    }
    public function dashboard()
{


  

    // Assuming $email and $staff are available in your controller
    $email = 'user@example.com';
    $staff = true;

    // Call the login function to get the user data
    $user_data = $this->authentication_model->login($email, $password, $remember, $staff);

    // Check if the login was successful
    if ($user_data) {
        $loginnumber = $user_data['loginnumber']; // Assuming loginnumber is part of the returned data
    } else {
        $loginnumber = null; // Set a default value if login was not successful
    }

    // Pass $loginnumber to the view
    $data['loginnumber'] = $loginnumber;

    // Load the dashboard view
    $this->load->view('dashboard', $data);
}

    

    /* Chart weekly payments statistics on home page / ajax */
    public function weekly_payments_statistics($currency)
    {
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->dashboard_model->get_weekly_payments_statistics($currency));
            die();
        }
    }

    /* Chart monthly payments statistics on home page / ajax */
    public function monthly_payments_statistics($currency)
    {
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->dashboard_model->get_monthly_payments_statistics($currency));
            die();
        }
    }

    public function ticket_widget($type)
    {
        $data['tickets_report'] = (new \app\services\TicketsReportByStaff())->filterBy($type);
        $this->load->view('admin/dashboard/widgets/tickets_report_table', $data);
    }
}
