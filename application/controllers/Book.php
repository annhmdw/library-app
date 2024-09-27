<?php

use GuzzleHttp\Client;

class Book extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Book_model');
        $this->load->model('Category_model');
        $this->load->model('Loan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $this->load->model('Book_model');
        $data['books'] = $this->Book_model->get_all_book();

        $data['title'] = 'Book List';
        $this->load->view('templates/header', $data);
        $this->load->view('book/index', $data);
        $this->load->view('templates/footer');
    }

    public function insert()
    {
        $data['title'] = 'Add Book Form';
        $data['categories'] = $this->Category_model->get_all_active_category();

        $this->form_validation->set_rules('book_name', 'Name', 'required|min_length[5]');
        $this->form_validation->set_rules('publisher', 'Publisher', 'required');
        $this->form_validation->set_rules('book_cover', 'Cover', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('book/addBook');
            $this->load->view('templates/footer');
        } else {
            $this->Book_model->insert_book();
            $array_msg = array('status' => 'Success', 'msg' => 'Book data has been added!', 'type' => 'success');
            $this->session->set_flashdata('msg', $array_msg);
            redirect('Book');
        }
    }


    public function delete($id)
    {
        $status = $this->Book_model->get_book_by_id($id)->book_status;
        if ($status == 0) {
            $book = $this->Book_model->get_book_by_id($id);
            if ($book && $book->cover) {
                unlink($book->cover);
            }
            $this->Book_model->delete_book($id);
            $array_msg = array('status' => 'Success', 'msg' => 'Book data has been successfully deleted !', 'type' => 'success');
            $this->session->set_flashdata('msg', $array_msg);
            redirect('Book');
        } else {
            $array_msg = array('status' => 'Failed', 'msg' => 'Book data failed to delete because is still active!', 'type' => 'error');
            $this->session->set_flashdata('msg', $array_msg);
            redirect('Book');
        };
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Book Form';
        $data['book'] = $this->Book_model->get_book_by_id($id);
        $data['categories'] = $this->Category_model->get_all_active_category();

        $this->form_validation->set_rules('book_name', 'Name', 'required|min_length[5]');
        $this->form_validation->set_rules('publisher', 'Publisher', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('book/editBook', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->input->post('book_cover') > '') {
                $book = $this->Book_model->get_book_by_id($id);
                if ($book && $book->cover && file_exists($book->cover)) {
                    unlink($book->cover);
                }                
            }
            $this->Book_model->edit_book();
            $array_msg = array('status' => 'Success', 'msg' => 'Category data has been edited!', 'type' => 'success');
            $this->session->set_flashdata('msg', $array_msg);
            redirect('Book');
        }
    }

    public function update_status($id) {

        $count = $this->Loan_model->count_book_id($id);

        if ($count == 0) {
            $response =  true;
            $this->Book_model->update_status();
        } else {
            $response =  false;
        };
        
        echo json_encode($response);
    }

    public function upload()
    {
        $config = [
            'upload_path' => './uploads/',
            'allowed_types' => 'jpg|png|jpeg|webp',
            'max_size' => 2048,
            'file_name' => uniqid(),
            'overwrite' => true,
            'remove_spaces' => true,
        ];

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('book_cover')) {
            $error = array('error' => $this->upload->display_errors());
            echo json_encode($error);
        } else {
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            $file_url = './uploads/' . $file_name;
            echo json_encode($file_url);
        }
    }

    public function revertFile() {
        // Only allow DELETE requests
        if ($this->input->server('REQUEST_METHOD') == 'DELETE') {
            
            // Get the filename from the request body
            $filename = file_get_contents('php://input');
            
            // Specify the directory where temporary files are stored
            $filePath = './uploads/' . $filename;

            // Check if the file exists
            if (file_exists($filePath)) {
                // Delete the file
                if (unlink($filePath)) {
                    // Respond with success
                    $this->output
                        ->set_status_header(200)
                        ->set_output(json_encode(['message' => 'File deleted successfully']));
                } else {
                    // Error deleting the file
                    $this->output
                        ->set_status_header(500)
                        ->set_output(json_encode(['error' => 'File could not be deleted']));
                }
            } else {
                // File not found
                $this->output
                    ->set_status_header(404)
                    ->set_output(json_encode(['error' => 'File not found']));
            }
        } else {
            // If the request method is not DELETE, return 405 Method Not Allowed
            $this->output
                ->set_status_header(405)
                ->set_output(json_encode(['error' => 'Method Not Allowed']));
        }
    }
}
