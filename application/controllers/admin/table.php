<?php

use app\services\utilities\Str;

defined('BASEPATH') or exit('No direct script access allowed');

class table extends AdminController
{
 

       
    /* This is admin dashboard view */
    public function index()
    {
     
        return view("admin/table/table");
        
    }

  
}
