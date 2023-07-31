<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('LoginModel');
	}
	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('login/index');
		$this->load->view('template/footer');
		
	}
	public function login(){
		$this->form_validation->set_rules('email', 'Email', 'required','trim|required',['required'=>'You must provide a %s']);
		$this->form_validation->set_rules('password', 'Password', 'required','trim|required',['required'=>'You must provide a %s']);
		if ($this->form_validation->run())
		{
				$email=$this->input->post('email');
				$password=md5( $this->input->post('password'));
				$result =$this->LoginModel->checkLogin($email,$password);
				if($result){
					$session_array = [
						'id'=>$result[0]->id,
						'username'=>$result[0]->username,
						'email'=>$result[0]->email,
					];
					$this->session->set_userdata('LoggedIn',$session_array);
					$this->session->set_flashdata('success','Login Successfully');
					redirect(base_url('/dashboard'));
				}else{
					$this->session->set_flashdata('error',' wrong Email or Password please login again');
					redirect(base_url('login'));
				}
		}
		else
		{
			$this->index();
		}
	}

}
