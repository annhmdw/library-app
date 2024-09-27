<?php

class Book_model extends CI_model
{
    public function get_all_book()
    {
        $this->db->select('*,  book_categories.category_name');
        $this->db->from('books');
        $this->db->join('book_categories', 'book_categories.id_category = books.category_id');
        return $this->db->get()->result();
    }

    public function get_all_active_book()
    {
        $this->db->select('*');
        $this->db->from('books');
        $this->db->where('book_status', 1);

        return $this->db->get()->result();
    }

    public function insert_book()
    {
        $data = [
            'book_name' => $this->input->post('book_name'),
            'publisher' => $this->input->post('publisher'),
            'category_id' => $this->input->post('category_id'),
            'cover' => $this->input->post('book_cover') // This will be the URL returned by FilePond
        ];

        $this->db->insert('books', $data);
    }

    public function delete_book($id)
    {
        $this->db->where('id_book', $id);
        $this->db->where('book_status', 0);
        $this->db->delete('books');
    }

    public function get_book_by_id($id)
    {
        return $this->db->get_where('books', ['id_book' => $id])->row();
    }

    public function edit_book()
    {
        if ($this->input->post('book_cover') != '') {
            $data = [
                'book_name' => $this->input->post('book_name'),
                'publisher' => $this->input->post('publisher'),
                'category_id' => $this->input->post('category_id'),
                'cover' => $this->input->post('book_cover') // This will be the URL returned by FilePond
            ];
        } else {
            $data = [
                'book_name' => $this->input->post('book_name'),
                'publisher' => $this->input->post('publisher'),
                'category_id' => $this->input->post('category_id'),
            ];
        }

        $this->db->where('id_book', $this->input->post('id_book'));
        $this->db->update('books', $data);
    }

    public function current_status($id)
    {
        $this->db->select('book_status');
        $this->db->from('books');
        $this->db->where('id_book', $id);
        return $this->db->get()->row();
    }

    public function update_status()
    {
        $data = [
            "book_status" => $this->input->post('book_status', true),
        ];

        $this->db->where('id_book', $this->input->post('id_book'));
        $this->db->update('books', $data);
    }

    public function count_category_id($value)
    {
        $this->db->where('category_id', $value);
        $query = $this->db->get('books');
        return $query->num_rows();
    }

    public function available_book()
    {
        $this->db->select('books.id_book, books.book_name');
        $this->db->from('books');
        $this->db->where('books.book_status', 1);
        $this->db->where_not_in('books.id_book', 'SELECT DISTINCT book_id FROM book_loans', FALSE);
        return $this->db->get()->result();
    }

    public function count_available_book()
    {
        $this->db->select('books.id_book, books.book_name');
        $this->db->from('books');
        $this->db->where('books.book_status', 1);
        $this->db->where_not_in('books.id_book', 'SELECT DISTINCT book_id FROM book_loans', FALSE);
        return $this->db->get()->num_rows();
    }

    public function count_book() 
    {
        return $this->db->get('books')->num_rows();
    }
}
