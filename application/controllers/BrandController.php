<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BrandController extends CI_Controller {

    public function checkLogin(){
        if(!$this->session->userdata('LoggedIn')){ 
            redirect(base_url('/login'));
        }
    }

    public function index()
	{ 
        $this->checkLogin(); 
        $this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
        $this->load->view('brand/list');
        $this->load->view('admin_template/footer');
	}
    public function created()
	{ 
        $this->checkLogin(); 
        $this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
        $this->load->view('brand/create');
        $this->load->view('admin_template/footer');
	}
}