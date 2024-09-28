<?php

class Student extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Student_model');
        $this->load->model('Program_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->model('Student_model');
        $data['students'] = $this->Student_model->get_all_student();

        $data['title'] = 'Student List';
        $this->load->view('templates/header', $data);
        $this->load->view('student/index', $data);
        $this->load->view('templates/footer');
    }

    public function insert()
    {
        $data['title'] = 'Add Student Form';
        $data['programs'] = $this->Program_model->get_all_active_program();

        $this->form_validation->set_rules('student_name', 'Nama', 'required');
        $this->form_validation->set_rules('student_address', 'Address', 'required');
        $this->form_validation->set_rules('nrp', 'NRP', 'required|numeric|min_length[6]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('student/addStudent');
            $this->load->view('templates/footer');
        } else {
            $this->Student_model->insert_student();
            $array_msg = array('status' => 'Success', 'msg' => 'Student data has been added!', 'type' => 'success');
            $this->session->set_flashdata('msg', $array_msg);
            redirect('student');
        }
    }

    public function delete($id)
    {
        $this->Student_model->delete_student($id);
        $array_msg = array('status' => 'Success', 'msg' => 'Student data has been deleted!', 'type' => 'success');
        $this->session->set_flashdata('msg', $array_msg);
        redirect('student');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Student Form';
        $data['student'] = $this->Student_model->get_student_by_id($id);
        $data['programs'] = $this->Program_model->get_all_active_program();

        $this->form_validation->set_rules('student_name', 'Nama', 'required');
        $this->form_validation->set_rules('student_address', 'Address', 'required');
        $this->form_validation->set_rules('nrp', 'NRP', 'required|numeric|min_length[6]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('student/editStudent', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Student_model->edit_student();
            $array_msg = array('status' => 'Success', 'msg' => 'Student data has been edited!', 'type' => 'success');
            $this->session->set_flashdata('msg', $array_msg);
            redirect('student');
        }
    }
}
