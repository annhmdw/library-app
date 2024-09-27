<?php

class Program_model extends CI_model
{
    public function get_all_program()
    {
        return $this->db->get('programs')->result();
    }

    public function get_all_active_program() 
    {
        $this->db->select('*');
        $this->db->from('programs');
        $this->db->where('program_status', 1);

        return $this->db->get()->result();
    }

    public function insert_program()
    {
        $data['program_name'] = $this->input->post('program_name');

        $this->db->insert('programs', $data);
    }


    public function delete_program($id)
    {
        $this->db->where('id_program', $id);
        $this->db->delete('programs');
    }

    public function get_program_by_id($id)
    {
        return $this->db->get_where('programs', ['id_program' => $id])->row();
    }

    public function edit_program()
    {
        $data['program_name'] = $this->input->post('program_name');

        $this->db->where('id_program', $this->input->post('id_program'));
        $this->db->update('programs', $data);
    }

    public function update_status()
    {
        $data = [
            "program_status" => $this->input->post('program_status', true),
        ];

        $this->db->where('id_program', $this->input->post('id_program'));
        $this->db->update('programs', $data);
    }
}
