<?php

class Loan extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Loan_model');
        $this->load->model('Book_model');
        $this->load->model('Student_model');
        $this->load->helper('date');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->model('Loan_model');
        $data['loans'] = $this->Loan_model->get_all_loan();

        $data['title'] = 'Loan List';
        $this->load->view('templates/header', $data);
        $this->load->view('book/loan/index', $data);
        $this->load->view('templates/footer');
    }

    public function insert()
    {
        $data['title'] = 'Add Loan Form';
        $data['students'] = $this->Student_model->get_all_student();
        $data['books'] = $this->Book_model->get_books_not_in_loans();

        $this->form_validation->set_rules('student_id', 'Student ID', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('book/loan/addLoan');
            $this->load->view('templates/footer');
        } else {

            $id_student = $this->input->post('student_id');
            $id_book = $this->input->post('book_id');
            $student = $this->Student_model->get_student_by_id($id_student);

            $now = date('YmdHis');
            $expired_date = date('YmdHis', strtotime('+3 days', strtotime($now)));
            $code = $student->nrp . '-' . $id_book . '-' . date('Ymd');

            $data = array(
                'book_id' => $id_book,
                'borrower_name' => $student->student_name,
                'student_id' => $id_student,
                'loan_date' => $now,
                'code' => $code,
                'expired_date' => $expired_date,
            );

            $this->Loan_model->insert_loan($data);
            $array_msg = array('status' => 'Success', 'msg' => 'Loan data has been added!', 'type' => 'success');
            $this->session->set_flashdata('msg', $array_msg);
            redirect('loan');
        }
    }

    public function delete($id)
    {
        $this->Loan_model->delete_loan($id);
        $array_msg = array('status' => 'Success', 'msg' => 'Loan data has been deleted!', 'type' => 'success');
        $this->session->set_flashdata('msg', $array_msg);
        redirect('loan');
    }

}
