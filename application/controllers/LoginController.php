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
	public function register_admin(){
		$this->load->view('template/header');
		$this->load->view('register_admin/index');
		$this->load->view('template/footer');
	}
	public function register_insert(){
		$this->form_validation->set_rules('username', 'Username', 'required','trim|required',['required'=>'You must provide a %s']);
		$this->form_validation->set_rules('email', 'Email', 'required','trim|required',['required'=>'You must provide a %s']);
		$this->form_validation->set_rules('password', 'Password', 'required','trim|required',['required'=>'You must provide a %s']);
		if ($this->form_validation->run())
		{
				$username=$this->input->post('username');
				$email=$this->input->post('email');
				$password=md5( $this->input->post('password'));
				$this->load->model('LoginModel');
				$data = [
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                    'status' => 1,
                   
                ];
               
                $result= $this->LoginModel->RegisterAdmin($data);
				if($result){
					
					
					$this->session->set_flashdata('success','Sign Up Admin success');
					redirect(base_url('/login'));
				}else{
					$this->session->set_flashdata('error',' Sign Up Admin error');
					redirect(base_url('/register-admin'));
				}
		}
		else
		{
			$this->index();
		}
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
	public function login_customer(){
		$this->form_validation->set_rules('email', 'Email','trim|required',['required'=>'Bạn nên điền %s']);
		$this->form_validation->set_rules('password', 'Password','trim|required',['required'=>'Bạn nên điền %s']);
		if ($this->form_validation->run() ==TRUE)
		{
				$email=$this->input->post('email');
				$password=md5( $this->input->post('password'));
				$result =$this->LoginModel->checkLoginCustomer($email,$password);
				if(count($result)>0){
					$session_array = array(
						'id'=>$result[0]->id,
						'username'=>$result[0]->name,
						'email'=>$result[0]->email,
					);
					$this->session->set_userdata('LoggedInCustomer',$session_array);
					$this->session->set_flashdata('success','Login Successfully');
					redirect(base_url('dang-ky'));
				}else{
					$this->session->set_flashdata('error',' wrong Email or Password please login again');
					redirect(base_url('/dang-nhap'));
				}
		}
		else
		{
			redirect(base_url('/dang-nhap'));
		}
	}
}
