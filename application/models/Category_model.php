<?php

class Category_model extends CI_model
{
    public function get_all_category()
    {
        return $this->db->get('book_categories')->result();
    }

    public function insert_category() 
    {
        $data['category_name'] = $this->input->post('category_name');

        $this->db->insert('book_categories', $data);
    }

    public function get_all_active_category() 
    {
        $this->db->select('*');
        $this->db->from('book_categories');
        $this->db->where('category_status', 1);

        return $this->db->get()->result();
    }

    public function delete_category($id) 
    {
        $this->db->where('id_category', $id);
        $this->db->where('category_status', 0);
        $this->db->delete('book_categories');
    }

    public function get_category_by_id($id)
    {
        return $this->db->get_where('book_categories', ['id_category' => $id])->row();
    }

    public function edit_category() 
    {
        $data['category_name'] = $this->input->post('category_name');

        $this->db->where('id_category', $this->input->post('id_category'));
        $this->db->update('book_categories', $data);
    }

    public function update_status()
    {
        $data = [
            "category_status" => $this->input->post('category_status', true),
        ];

        $this->db->where('id_category', $this->input->post('id_category'));
        $this->db->update('book_categories', $data);
    }

}


?>