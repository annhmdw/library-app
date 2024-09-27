<?php

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Student_model');
        $this->load->model('Book_model');
        $this->load->model('Loan_model');
    }

    public function index() {
        
        $data['title'] = 'Dashboard';
        $data['student_count'] = $this->Student_model->count_student();
        $data['book_count'] = $this->Book_model->count_book();
        $data['available_book'] = $this->Book_model->count_available_book();
        $data['loan_count'] = $this->Loan_model->count_loan();
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }

}

?>