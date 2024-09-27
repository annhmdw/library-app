<?php


class Student_model extends CI_model
{
    public function get_all_student()
    {
        $this->db->select('*, programs.program_name as program_name');
        $this->db->from('students');
        $this->db->join('programs', 'programs.id_program = students.program_id');
        return $this->db->get()->result();
    }

    public function insert_student()
    {
        $data = [
            "student_name" => $this->input->post('student_name', true),
            "student_address" => $this->input->post('student_address', true),
            "nrp" => $this->input->post('nrp', true),
            "program_id" => $this->input->post('program_id', true),
        ];

        $this->db->insert('students', $data);
    }

    public function delete_student($id)
    {
        $this->db->where('id_student', $id);
        $this->db->delete('students');
    }

    public function get_student_by_id($id)
    {
        return $this->db->get_where('students', ['id_student' => $id])->row();
    }

    public function edit_student()
    {
        $data = [
            "student_name" => $this->input->post('student_name', true),
            "student_address" => $this->input->post('student_address', true),
            "nrp" => $this->input->post('nrp', true),
            "program_id" => $this->input->post('program_id', true),
        ];

        $this->db->where('id_student', $this->input->post('id_student'));
        $this->db->update('students', $data);
    }

    public function count_program_id($value)
    {
        $this->db->where('program_id', $value);
        $query = $this->db->get('students');
        return $query->num_rows();
    }
}
