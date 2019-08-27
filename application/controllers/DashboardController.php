<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller {

			public function __construct(){
			  parent::__construct();
				$this->load->model('MainModel');
                $userRole=$this->session->userdata('user_status');
				if($userRole !="active"){
					redirect('admin');

				}
			 
			}
		 
			 public function index(){
				 date_default_timezone_set("Asia/Dhaka");
				 $data['main'] = "Dashboard";
				 $data['active'] = "view Dashboard";
				 $data['pageContent'] = $this->load->view('dashboard', $data, true);
				 $this->load->view('layouts/main', $data);
			 }
		 
			 public function create(){
				 
			 }
			 



}
