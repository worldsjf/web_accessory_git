<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller {

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

        $this->load->model('ProductModel');
        $data['product'] = $this->ProductModel->selectAllProduct();

        $this->load->view('product/list',$data);
        $this->load->view('admin_template/footer');
    }

    public function create()
    { 
        $this->checkLogin(); 
        $this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
        //gọi brand
        $this->load->model('BrandModel');
        $data['brand'] = $this->BrandModel->selectBrand();
        //gọi category
        $this->load->model('CategoryModel');
        $data['category'] = $this->CategoryModel->selectCategory();

        $this->load->view('product/create',$data);
        $this->load->view('admin_template/footer');
    }

    public function store(){
        $this->form_validation->set_rules('title', 'Title', 'trim|required', ['required' => 'You must provide a %s']);
        $this->form_validation->set_rules('slug', 'Slug', 'trim|required', ['required' => 'You must provide a %s']);
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required', ['required' => 'You must provide a %s']);
        $this->form_validation->set_rules('description', 'Description', 'trim|required', ['required' => 'You must provide a %s']);
        
        if ($this->form_validation->run() == TRUE)
        {
               //upload image
               $ori_filename = $_FILES['image']['name'];
               $new_name = time()."".str_replace(' ','-',$ori_filename);
               $config = [ 
                   'upload_path' => './uploads/product',
                   'allowed_types' => 'gif|jpg|png|jpeg',
                   'file_name' => $new_name,
               ];
               
               $this->load->library('upload', $config);
               if ( ! $this->upload->do_upload('image'))
               {
                        $error = array('error' => $this->upload->display_errors()); // Change display_error() to display_errors()
                        $this->load->view('admin_template/header');
                        $this->load->view('admin_template/navbar');
                        $this->load->view('product/create', $error);
                        $this->load->view('admin_template/footer');
               } else {
                $filename = $this->upload->data('file_name');
                $data = [
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'slug' => $this->input->post('slug'),
                    'quantity' => $this->input->post('quantity'),
                    'category_id' => $this->input->post('category_id'),
                    'brand_id' => $this->input->post('brand_id'),
                    'status' => $this->input->post('status'),
                    'image' =>$filename
                ];
                $this->load->model('ProductModel');
                $this->ProductModel->insertProduct($data);
                $this->session->set_flashdata('success', 'Add Success Product');
                redirect(base_url('product/list'));
                }


        } else {
            $this->create();
        }
    }
    public function edit($id){
        $this->checkLogin(); 
            $this->load->view('admin_template/header');
            $this->load->view('admin_template/navbar');

            $this->load->model('CategoryModel');
            $data['category'] = $this->CategoryModel->selectCategoryById($id);

            $this->load->view('category/edit', $data);
            $this->load->view('admin_template/footer');
    }
    public function update($id){
        $this->form_validation->set_rules('title', 'Title', 'trim|required', ['required' => 'You must provide a %s']);
        $this->form_validation->set_rules('slug', 'Slug', 'trim|required', ['required' => 'You must provide a %s']);
        $this->form_validation->set_rules('description', 'Description', 'trim|required', ['required' => 'You must provide a %s']);
        
        if ($this->form_validation->run() == TRUE)
        {
                if(!empty($_FILES['image']['name'])){
               //upload image
               $ori_filename = $_FILES['image']['name'];
               $new_name = time()."".str_replace(' ','-',$ori_filename);
               $config = [ 
                   'upload_path' => './uploads/category',
                   'allowed_types' => 'gif|jpg|png|jpeg',
                   'file_name' => $new_name,
               ];
               
               $this->load->library('upload', $config);
               if ( ! $this->upload->do_upload('image'))
               {
                        $error = array('error' => $this->upload->display_errors()); // Change display_error() to display_errors()
                        $this->load->view('admin_template/header');
                        $this->load->view('admin_template/navbar');
                        $this->load->view('category/edit/'.$id, $error);
                        $this->load->view('admin_template/footer');
               } else {
                $cate_filename = $this->upload->data('file_name');
                $data = [
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'slug' => $this->input->post('slug'),
                    'status' => $this->input->post('status'),
                    'image' =>$cate_filename
                ];
               
            }
        }else{
            $data = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'slug' => $this->input->post('slug'),
                'status' => $this->input->post('status'),
            ];
        }
        $this->load->model('CategoryModel');
        $this->CategoryModel->updateCategory($id,$data);
        $this->session->set_flashdata('success', 'Update Success Category');
        redirect(base_url('category/list'));
        } else {
            $this->edit($id);
        }
    }
    public function delete($id){
        $this->load->model('CategoryModel');
        $this->CategoryModel->deleteCategory($id);
        $this->session->set_flashdata('success', 'Delete Success Category');
        redirect(base_url('category/list'));
    }

}
