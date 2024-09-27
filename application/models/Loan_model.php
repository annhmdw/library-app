<?php

class Loan_model extends CI_model
{
    public function get_all_loan()
    {
        $this->db->select('*,  students.student_name as borrower_name');
        $this->db->from('book_loans');
        $this->db->join('students', 'students.id_student = book_loans.student_id');
        $this->db->join('books', 'books.id_book = book_loans.book_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function insert_loan($data)
    {
        $this->db->insert('book_loans', $data);
    }

    public function delete_loan($id)
    {
        $this->db->where('id_loan', $id);
        $this->db->delete('book_loans');
    }

    public function get_loan_by_id($id)
    {
        return $this->db->get_where('book_loans', ['id_loan' => $id])->row();
    }

    public function edit_loan()
    {
        $data = [
            "bookName" => $this->input->post('bookName', true),
            "bookCategory" => $this->input->post('bookCategory', true),
            "publisher" => $this->input->post('publisher', true),
            "cover" => $this->input->post('cover', true),
            "cover" => $this->input->post('cover', true),
            "bookStatus" => $this->input->post('bookStatus', true),
        ];

        $this->db->where('id_loan', $this->input->post('id_loan'));
        $this->db->update('book_loans', $data);
    }

    public function count_book_id( $value)
    {
        $this->db->where('book_id', $value);
        $query = $this->db->get('book_loans');
        return $query->num_rows();
    }

    public function count_student_id( $value)
    {
        $this->db->where('student_id', $value);
        $query = $this->db->get('book_loans');
        return $query->num_rows();
    }

    public function count_loan()
    {
        return $this->db->get('book_loans')->num_rows();
    }
}
