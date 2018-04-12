<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class User_Controller extends Base_Controller
{
    /**
    * action index: show all users
    * method: GET
    */
    public function index()
    {
        if (isset($_GET['pages'])) {
            $pages = isset($_GET['pages']);
        } else {
            $pages = 0;
        }
        echo $pages;
        $this->model->load('Users');
        $list_user = $this->model->Users->getTable($pages);
        $data = array(
            'title' => 'index',
            'table_name' => 'Users Table',
            'table_subtitle' => 'Here is a table users',
            'list' => $list_user
        );

        // Load view
        $this->view->load('dashboard', $data);
    }

    /**
    * action show: show a user
    * method: GET
    */
    public function show()
    {
        $this->model->load('User');
        $user = $this->model->User->findById($_GET['id']);
        $data = array(
            'title' => 'show',
            'user' => $user
        );

        // Load view
        $this->view->load('users/show', $data);
    }

    /**
    * action create: create a user
    * method: GET
    */
    public function create()
    {
        $this->view->load('users/create');
    }

     /**
    * action store: save a user to database
    * method: POST
    */
    public function store()
    {
        $this->model->load('User');
        $this->model->User->email = $_POST['email'];
        $this->model->User->password = $_POST['password'];
        $this->model->User->role = $_POST['role'];
        $this->model->User->status = $_POST['status'];
        $this->model->User->token = csrf_token();
        $this->model->User->save();

        go_back();
    }

    /**
    * action edit: show form edit a user
    * method: GET
    */
    public function edit()
    {
        $this->model->load('User');
        $user = $this->model->User->findById($_GET['id']);
        $data = array(
            'title' => 'edit',
            'user' => $user
        );

        // Load view
        $this->view->load('users/edit', $data);
    }

    /**
    * action edit: update user database
    * method: POST
    */
    public function update()
    {
        $this->model->load('User');
        $user = $this->model->User->findById($_POST['id']);
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];
        $user->role = $_POST['role'];
        $user->status = $_POST['status'];             ;
        $user->update();

        go_back();
    }

    /**
    * action delete: show form edit a user
    * method: GET
    */
    public function delete()
    {
        $this->model->load('Users');
        $user = $this->model->User->findById($_GET['id']);
        $user->delete();

        go_back();
    }

    /**
    * action login: validate login
    * method: POST
    */
    public function login() {
        $data = [
            "message" => "",
        ];
        $this->view->load('login', $data);
        if (isset($_POST['log_button'])) {
            $username = $_POST['log_username'];
            $password = $_POST['log_pass'];
            $this->model->load('Users');
            $id = $this->model->Users->validate_login($username, $password);
            if ($id != 0) {

                $user = $this->model->Users->findById($id);
                $id_user_type = $user->id_user_type;

                $this->model->load('UserType');
                $user_type = $this->model->UserType->findById($id_user_type);


                $role = $user_type->name_user_type;
                $this->middleware->load('Admin');
                $admin_midlleware = $this->middleware->Admin->handle($role);

                if ($admin_midlleware) {
                    $token = $this->model->Users->generate_token($id);
                    redirect_to(URL . "controller=user&action=index&token=$token");
                } else {
                   redirect_to(URL . 'controller=utils&action=error&message=Not%20permission');
                }

            } else {
                /*Login faile handle after*/
               redirect_to(URL . 'controller=utils&action=error&message=Login%20failed');
            }
        }
    }

    /**
    * action logout
    * method: GET
    */

    public function logout() {
        if(isset($_GET['token'])) {
            $this->model->load('Users');
            $id = $this->model->Users->validate_logout($_GET['token']);
            if($id != 0) {
                $this->model->Users->remove_token($id);
                redirect_to(URL . "controller=user&action=login");
            } else {
                 /*Token not exists*/
                redirect_to(URL . "controller=utils&action=error&message=Token%20not%20exists&id=$id");
            }
        } else {
            /*Token not exists*/
            redirect_to(URL . "controller=utils&action=error&message=Token%20not%20exists");
        }
    }

}
