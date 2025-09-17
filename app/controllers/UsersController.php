<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: UsersController
 * 
 * Automatically generated via CLI.
 */

class UsersController extends Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->call->model('UsersModel');
        $data['users'] = $this->UsersModel->page();
        $this->call->view('users/index', $data);
    }

    public function create()
    {
        if($this->io->method() === 'post'){
            $username = $this->io->post('username');
            $email = $this->io->post('email');  

            $data = [
                'username' => $username,
                'email' => $email
            ];

            if($this->UsersModel->insert($data)){
                redirect();
            } else {
                echo 'Failed to create user.';
            }
        }else{
           $this->call->view('users/create');
        }
        
    }

    function update($id)
    {
        $user = $this->UsersModel->find($id);
        if (!$user) {
            echo "User not found.";
            return;
        }
        if($this->io->method() === 'post'){
            $username = $this->io->post('username');
            $email = $this->io->post('email');  

            $data = [
                'username' => $username,
                'email' => $email
            ];

            if($this->UsersModel->update($id, $data)){
                redirect();
            } else {
                echo 'Failed to update user.';
            }
        }else{
            $data['user'] = $user;
            $this->call->view('users/update', $data);
        }
    }

    public function delete($id)
    {
        $this->call->model('UsersModel');
        if($this->UsersModel->delete($id)){
            redirect();
        } else {
            echo 'Failed to delete user.';
        }
    }

     public function UserData() 
    {
        
        $page = 1;
        if(isset($_GET['page']) && ! empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        $q = '';
        if(isset($_GET['q']) && ! empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 10;

        $all = $this->UsersModel->page($q, $records_per_page, $page);
        $data['all'] = $all['records'];
        $total_rows = $all['total_rows'];
        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap'); // or 'tailwind', or 'custom'
        $this->pagination->initialize($total_rows, $records_per_page, $page, site_url('user/index').'?q='.$q);
        $data['page'] = $this->pagination->paginate();
        $this->call->view('users/index', $data);
    }
}