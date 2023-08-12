<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IndexController extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('IndexModel');
		$this->load->library('cart');
		$this->data['category'] = $this->IndexModel->getCategoryHome();
		$this->data['sliders'] = $this->IndexModel->getSliderHome();
		$this->data[ 'brand'] = $this->IndexModel->getBrandHome();
		$this->load->library("pagination");
	}

	public function index()
	{
		//custom config link
		$config = array();
		$config["base_url"] = base_url() .'/phan-trang'; 
		$config['total_rows'] = ceil($this->IndexModel->countAllProduct()); //đếm tất cả sản phẩm //8 //hàm ceil làm tròn phân trang 
		$config["per_page"] = 4; //từng trang 3 sản phẩn
		$config["uri_segment"] = 2; //lấy số trang hiện tại
		$config['use_page_numbers'] = TRUE; //trang có số
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		//end custom config link
		$this->pagination->initialize($config); 
		$this->page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0; 
		$this->data["links"] = $this->pagination->create_links(); 
		$this->data['allproduct_pagination'] = $this->IndexModel->getIndexPagination($config["per_page"], $this->page);
		//pagination
		//$this->data['allproduct'] = $this->IndexModel->getAllProduct();
		$this->data['items_categories'] = $this->IndexModel->ItemsCategories();
		$this->load->view('pages/template/header', $this->data);
		$this->load->view('pages/template/slider');
		$this->load->view('pages/home', $this->data);
		$this->load->view('pages/template/footer');
	}
	public function contact(){
		$this->load->view('pages/template/header', $this->data);
		$this->load->view('pages/contact');
		$this->load->view('pages/template/footer');
	}
	public function thanks_contact(){
		$this->load->view('pages/template/header', $this->data);
		$this->load->view('pages/  ');
		$this->load->view('pages/template/footer');
	}
	public function category($id)
	{
		//custom config link
		$this->data['slug'] = $this->IndexModel->getCategorySlug($id);
		$config = array();
		$config["base_url"] = base_url() . '/danh-muc/' . $id . '/' . $this->data['slug'];
		$config['total_rows'] = ceil($this->IndexModel->countAllProductByCate($id));
		$config["per_page"] = 2;
		$config["uri_segment"] = 4;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		//end custom config link
		$this->pagination->initialize($config);
		$this->page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$this->data["links"] = $this->pagination->create_links();
		// Update the line below to call the correct method
		$this->data['allproductbycate_pagination'] = $this->IndexModel->getCatePagination($id, $config["per_page"], $this->page);
		
		$this->data['title'] = $this->IndexModel->getCategoryTitle($id);
		$this->config->config["pageTitle"] = $this->data['title'];
		$this->load->view('pages/template/header', $this->data);
		$this->load->view('pages/category', $this->data);
		$this->load->view('pages/template/footer');
	}
	
	public function brand($id)
	{
		$this->data['slug'] = $this->IndexModel->getBrandSlug($id);
		$config = array();
		$config["base_url"] = base_url() .'/thuong-hieu/'. $id . '/' . $this->data['slug'];
		$config['total_rows'] = ceil($this->IndexModel->countAllProductByBrand($id));
		$config["per_page"] = 3;
		$config["uri_segment"] = 4;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		//end custom config link
		$this->pagination->initialize($config);
		$this->page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$this->data["links"] = $this->pagination->create_links();
		// Update the line below to call the correct method
		$this->data['allproductbybrand_pagination'] = $this->IndexModel->getBrandProductPagination($id, $config["per_page"], $this->page);
		
		//$this->data['brand_product'] = $this->IndexModel->getBrandProduct($id);
		$this->data['title'] = $this->IndexModel->getBrandTitle($id);
		$this->config->config["pageTitle"] = $this->data['title'];
		$this->load->view('pages/template/header', $this->data);
		//$this->load->view('pages/template/slider');
		$this->load->view('pages/brand', $this->data);
		$this->load->view('pages/template/footer');
	}
	public function product($id)
	{
		$this->data['product_details'] = $this->IndexModel->getProductDetails($id);
		$this->data['list_comments'] = $this->IndexModel->getListComments($id);
		foreach($this->data['product_details'] as $key =>$val){
			$category_id=$val->category_id;
		}
		$this->data['product_related'] = $this->IndexModel->getProductRelated($id,$category_id);
		$this->data['title'] = $this->IndexModel->getProductTitle($id);
		$this->config->config["pageTitle"] = $this->data['title'];
		$this->load->view('pages/template/header', $this->data);
		//$this->load->view('pages/template/slider');
		$this->load->view('pages/product_details', $this->data);
		$this->load->view('pages/template/footer');
	}
	public function thanks()
	{
		$this->config->config["pageTitle"] = 'Cảm ơn đã đặt hàng';
		$this->load->view('pages/template/header', $this->data);
		//$this->load->view('pages/template/slider');
		$this->load->view('pages/thanks');
		$this->load->view('pages/template/footer');
	}
	public function cart()
	{
		$this->config->config["pageTitle"] = 'Giỏ hàng của bạn';
		$this->load->view('pages/template/header', $this->data);
		//$this->load->view('pages/template/slider');
		$this->load->view('pages/cart');
		$this->load->view('pages/template/footer');
	}
	public function checkout()
	{
	
		if ($this->cart->contents()) {
			$this->load->view('pages/template/header', $this->data);
			//$this->load->view('pages/template/slider');
			
			// Truy xuất dữ liệu người dùng đã đăng nhập từ phiên
			$userdata = $this->session->userdata('LoggedInCustomer');
			$this->load->model('IndexModel');
			$info = null;

		if ($userdata && isset($userdata['id'])) {
			$this->config->config["pageTitle"] = 'Thanh toán đơn hàng';
			$info = $this->IndexModel->getInfo($userdata['id']);
		}
					
					// Truyền dữ liệu người dùng vào trang checkout
					$this->load->view('pages/checkout', ['info' => $info]);

					$this->load->view('pages/template/footer');

				}
				

			}

	public function add_to_cart()
    {
		$product_id = $this->input->post('product_id');
        $quantity = $this->input->post('quantity');
        $this->data['product_details'] = $this->IndexModel->getProductDetails($product_id);

    //dat hang
    foreach($this->data['product_details'] as $key => $pro) {
        $cart = array(
            'id' => $pro->id,
            'qty' => $quantity,
            'price' => $pro->price,
            'name' => $pro->title,
            'options' => array('image' => $pro->image)
        );
	}
        $this->cart->insert($cart);
		redirect(base_url().'gio-hang', 'refresh');
	}

	public function update_cart_item()
	{
		$rowid= $this->input->post('rowid');
		$quantity = $this->input->post('quantity');
		foreach ($this->cart->contents() as $items){
			if($rowid == $items['rowid']){
				$cart = array(
					'rowid' => $rowid,
					'qty' => $quantity
				);
			}
		}
		$this->cart->update($cart);
		//redirect(base_url().'gio-hang', 'refresh');
		redirect($_SERVER['HTTP_REFERER']);
	}

    public function delete_all_cart()
    {
		$this->cart->destroy();
		redirect(base_url().'gio-hang', 'refresh');
    }

	public function delete_item($rowid)
    {
		$this->cart->remove($rowid);
		redirect(base_url().'gio-hang', 'refresh');
    }

	public function login()
	{
		$this->config->config["pageTitle"] = 'Đăng nhập |Đăng ký';
		$this->load->view('pages/template/header');
		//$this->load->view('pages/template/slider');
		$this->load->view('pages/login');
		$this->load->view('pages/template/footer');
	}
	public function login_customer() {
		$this->form_validation->set_rules('email', 'Email', 'trim|required', ['required' => 'Bạn nên điền %s']);
		$this->form_validation->set_rules('password', 'Password', 'trim|required', ['required' => 'Bạn nên điền %s']);
	
		if ($this->form_validation->run() == TRUE) {
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			$this->load->model('LoginModel');
			$result = $this->LoginModel->checkLoginCustomer($email, $password);
	
			if (count($result) > 0) {
				$session_array = [
					'id' => $result[0]->id,
					'username' => $result[0]->name,
					'email' => $result[0]->email,
				];
	
				$this->session->set_userdata('LoggedInCustomer', $session_array);
				$this->session->set_flashdata('success', 'Đăng nhập thành công');
				redirect(base_url('/checkout'));
			} else {
				$this->session->set_flashdata('error', 'Email hoặc Mật khẩu không đúng. Vui lòng đăng nhập lại.');
				redirect(base_url('/dang-nhap'));
			}
		} else {
			$this->login();
		}
	}
	
	public function dang_ky(){
		$this->form_validation->set_rules('email', 'Email', 'trim|required', ['required' => 'Bạn nên điền %s']);
		$this->form_validation->set_rules('password', 'Password', 'trim|required', ['required' => 'Vui lòng nhập mật khẩu']);
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required', ['required' => 'Bạn nên điền %s']);
		$this->form_validation->set_rules('address', 'Address', 'trim|required', ['required' => 'Bạn nên điền %s']);
		$this->form_validation->set_rules('name', 'Name', 'trim|required', ['required' => 'Bạn nên điền %s']);
	
		if ($this->form_validation->run() == TRUE) {
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			$phone = $this->input->post('phone');
			$address = $this->input->post('address');
			$name = $this->input->post('name');
			$data = array(
				'name' => $name,
				'email' => $email,
				'password' => $password,
				'phone' => $phone,
				'address' => $address,
			
			);
			$this->load->model('LoginModel');
			$result = $this->LoginModel->NewCustomer($data);
			if ($result) {
				$session_array = array(
					'username' => $name,
					'email' => $email,
				);
				$this->session->set_userdata('LoggedInCustomer', $session_array);
				$this->session->set_flashdata('success', 'Đăng nhập thành công');
				redirect(base_url('/checkout'));
			} else {
				$this->session->set_flashdata('error', 'Email hoặc mật khẩu sai. Vui lòng đăng nhập lại.');
				redirect(base_url('/dang-nhap'));
			}
		} else {
			$this->login();
			
		}
	}
	
	
	public function confirm_checkout(){
		$this->form_validation->set_rules('email', 'Email','trim|required',['required'=>'Bạn nên điền %s']);
		$this->form_validation->set_rules('phone', 'Phone','trim|required',['required'=>'Bạn nên điền %s']);
		$this->form_validation->set_rules('address', 'Address','trim|required',['required'=>'Bạn nên điền %s']);
		$this->form_validation->set_rules('name', 'Name','trim|required',['required'=>'Bạn nên điền %s']);
		if ($this->form_validation->run() == TRUE)
		{
			$email = $this->input->post('email');
			$shipping_method = $this->input->post('shipping_method');
			$phone = $this->input->post('phone');
			$address = $this->input->post('address');
			$name = $this->input->post('name');
			$data = array(
				'name' =>$name,
				'email' =>$email,
				'method' =>$shipping_method,
				'address' =>$address,
				'phone' =>$phone
				
			);
			$this->load->model('LoginModel');
			

			$result =$this->LoginModel->NewShipping($data);
				if($result){
					//order
					$order_code = rand(00,9999);
					$data_order = array(
						'order_code' =>$order_code,
						'ship_id' =>$result,
						'status' => 1
						 
					);
					$insert_order= $this->LoginModel->insert_order($data_order);
					//order_details
					foreach ($this->cart->contents() as $items) {
						$data_order_details = array(
							'order_code' =>$order_code,
							'product_id' =>$items['id'],
							'quantity' => $items['qty']
						);
						$insert_order_details= $this->LoginModel->insert_order_details($data_order_details);	
					}
					$this->session->set_flashdata('success',' Đặt hàng thành công.');
					$this->cart->destroy();
					redirect(base_url('/thanks'));
				}else{
					$this->session->set_flashdata('error',' Xác nhận thanh toán đơn hàng thất bại.');
					redirect(base_url('/checkout'));
				}
		}else{
			$this->checkout();
		}
	}

	public function dang_xuat(){
		$this->session->unset_userdata('LoggedInCustomer');
		$this->session->set_flashdata('success',' Logout Successfully');
		redirect(base_url('/dang-nhap'));
	}
	public function tim_kiem(){
		if(isset($_GET['keyword']) && $_GET['keyword']!=''){
			$keyword=$_GET['keyword'];
		}
		$this->data['product'] = $this->IndexModel->getProductByKeyword($keyword);
		$this->data['title'] = $keyword;
		$this->config->config["pageTitle"] ='Tìm kiếm từ khóa:' .$keyword;
		$this->load->view('pages/template/header', $this->data);
		//$this->load->view('pages/template/slider');
		$this->load->view('pages/timkiem', $this->data);
		$this->load->view('pages/template/footer');
	}
	public function comment_send(){
		$data = [
			'name' => $this->input->post('name_comment'),
			'product_id' => $this->input->post('pro_id'),
			'email' => $this->input->post('email_comment'),
			'comment' => $this->input->post('comment'),
			'status' => 1
		];
   
		var_dump($data);
   
		$result = $this->IndexModel->insertComment($data);
   }
}
