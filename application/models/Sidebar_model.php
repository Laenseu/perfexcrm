<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sidebar_model extends App_Model {




    public function __construct()
    {
        parent::__construct();
    

    }
  

    public function get_project_name($project_id) {
        $this->db->select('name');
        $this->db->where('id', $project_id);
        $query = $this->db->get('tblprojects');

        if ($query->num_rows() > 0) {
            return $query->row()->name;
        } else {
            return null;
        }
    }
    public function get_total_Notbillable_hours($staff_id) {
        $this->db->select_sum('(end_time - start_time) / 3600', 'total_hours');
        $this->db->from('tbltasks');
        $this->db->join('tbltaskstimers', 'tbltasks.id = tbltaskstimers.task_id');
        $this->db->where('tbltasks.billable', 0);
        $this->db->where('tbltaskstimers.staff_id', $staff_id);
    
        $query = $this->db->get();
        return $query->row()->total_hours;
    }
            

    public function get_total_hours($staff_id) {
        $today = new DateTime();
        $today->setISODate($today->format('o'), $today->format('W'));
    
        $lastMonday = clone $today;
        $lastMonday->modify('-7 days');
    
        $lastFriday = clone $lastMonday;
        $lastFriday->modify('+4 days');
    
        $this->db->select_sum('hours', 'total_hours');
        $this->db->where('staffid', $staff_id);
        $this->db->where('DATE(timeanddate) >=', $lastMonday->format('Y-m-d'));
        $this->db->where('DATE(timeanddate) <=', $lastFriday->format('Y-m-d'));
    
        $query = $this->db->get('tblstaff_login_info');
        return $query->row()->total_hours;
    }


  
    public function get_total_billable_hours($staff_id) {
        $this->db->select_sum('(end_time - start_time) / 3600', 'total_hours');
        $this->db->from('tbltasks');
        $this->db->join('tbltaskstimers', 'tbltasks.id = tbltaskstimers.task_id');
        $this->db->where('tbltasks.billable', 1);
        $this->db->where('tbltaskstimers.staff_id', $staff_id);
    
        $query = $this->db->get();
        return $query->row()->total_hours;
    }
}
