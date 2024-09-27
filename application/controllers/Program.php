<?php

class Program extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Program_model');
        $this->load->model('Student_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->load->model('Program_model');
        $data['programs'] = $this->Program_model->get_all_program();
        
        $data['title'] = 'Program List';
        $this->load->view('templates/header', $data);
        $this->load->view('program/index', $data);
        $this->load->view('templates/footer');

    }

    public function insert()
    {
        $data['title'] = 'Add Program Form';

        $this->form_validation->set_rules('program_name', 'Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $array_msg = array('status' => 'Failed', 'msg' => 'Program data failed to edit!', 'type' => 'error');
            $this->session->set_flashdata('msg', $array_msg);
            redirect('program');
        } else {
            $this->Program_model->insert_program();
            $array_msg = array('status' => 'Success', 'msg' => 'Program data has been added!', 'type' => 'success');
            $this->session->set_flashdata('msg', $array_msg);
            redirect('program');
        }
    }

    public function delete($id)
    {
        $status = $this->Program_model->get_program_by_id($id)->program_status;

        if ($status == 0) {
            $this->Program_model->delete_program($id);
            $array_msg = array('status' => 'Success', 'msg' => 'Program data has been successfully deleted!', 'type' => 'success');
            $this->session->set_flashdata('msg', $array_msg);
            redirect('program');
        } else {
            $array_msg = array('status' => 'Failed', 'msg' => 'Program data failed to delete because is still active!', 'type' => 'error');
            $this->session->set_flashdata('msg', $array_msg);
            redirect('program');
        };
    }

    public function edit()
    {
        $this->form_validation->set_rules('program_name', 'Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $array_msg = array('status' => 'Failed', 'msg' => 'Program data failed to edit!', 'type' => 'error');
            $this->session->set_flashdata('msg', $array_msg);
            redirect('program');
        } else {
            $this->Program_model->edit_program();
            $array_msg = array('status' => 'Success', 'msg' => 'Program data has been edited!', 'type' => 'success');
            $this->session->set_flashdata('msg', $array_msg);
            redirect('program');
        }
    }

    public function update_status($id) {

        $count = $this->Student_model->count_program_id($id);

        if ($count == 0) {
            $response =  true;
            $this->Program_model->update_status();
        } else {
            $response =  false;
        };
        
        echo json_encode($response);
    }

}

?>