<?php

class Category extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model');
        $this->load->model('Book_model');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $this->load->model('Category_model');
        $data['categories'] = $this->Category_model->get_all_category();

        $data['title'] = 'Category List';
        $this->load->view('templates/header', $data);
        $this->load->view('book/category/index', $data);
        $this->load->view('templates/footer');
    }

    public function insert()
    {
        $data['title'] = 'Add Category Form';
        $data['categories'] = $this->Category_model->get_all_category();

        $this->form_validation->set_rules('category_name', 'Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $array_msg = array('status' => 'Failed', 'msg' => 'Category data failed to added!', 'type' => 'error');
            $this->session->set_flashdata('msg', $array_msg);
            redirect('category');
        } else {
            $this->Category_model->insert_category();
            $array_msg = array('status' => 'Success', 'msg' => 'Category data has been added!', 'type' => 'success');
            $this->session->set_flashdata('msg', $array_msg);
            redirect('category');
        }
    }

    public function delete($id)
    {
        $status = $this->Category_model->get_category_by_id($id)->category_status;
        if ($status == 0) {
            $this->Category_model->delete_category($id);
            $array_msg = array('status' => 'Success', 'msg' => 'Category data has been successfully deleted!', 'type' => 'success');
            $this->session->set_flashdata('msg', $array_msg);
            redirect('Category');
        } else {
            $array_msg = array('status' => 'Failed', 'msg' => 'Category data failed to delete because is still active!', 'type' => 'error');
            $this->session->set_flashdata('msg', $array_msg);
            redirect('Category');
        };
    }

    public function edit()
    {
        $data['title'] = 'Edit Category Form';
        $this->form_validation->set_rules('category_name', 'Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $array_msg = array('status' => 'Failed', 'msg' => 'Category data failed to edited!', 'type' => 'error');
            $this->session->set_flashdata('msg', $array_msg);
            redirect('category');
        } else {
            $this->Category_model->edit_category();
            $array_msg = array('status' => 'Success', 'msg' => 'Category data has been edited!', 'type' => 'success');
            $this->session->set_flashdata('msg', $array_msg);
            redirect('category');
        }
    }

    public function update_status($id) {

        $count = $this->Book_model->count_category_id($id);

        if ($count == 0) {
            $response =  true;
            $this->Category_model->update_status();
        } else {
            $response =  false;
        };
        
        echo json_encode($response);
    }
}
