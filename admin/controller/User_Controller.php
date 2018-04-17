<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class User_Controller extends Base_Controller
{
    /**
    * action index: show all users
    * method: GET
    */
    public function index()
    {
        $pages = isset($_GET['pages']) ? $_GET['pages'] : 0;
        $token = isset($_GET['token']) ? $_GET['token'] : "null";
        $this->model->load('Users');
        $list_user = $this->model->Users->getTable($pages, $token);
        $num_rows = $this->model->Users->getNumRow();
        $data = array(
            'page_name' => 'User',
            'action_table' => 'index_table',
            'token' => $token,
            'pages' => $pages,
            'title' => 'index',
            'table_name' => 'Users Table',
            'table_subtitle' => 'Here is a table users',
            'list' => $list_user,
            'num_rows' => $num_rows,
        );

        // Load view
        $this->view->load('index', $data);
    }

    /**
    * action edit: show form edit a user
    * method: GET
    */
    public function edit()
    {
        $token = isset($_GET['token']) ? $_GET['token'] : "null";
        $this->model->load('Users');
        $users = $this->model->Users->findById($_GET['id']);

        $this->model->load('UserType');
        $user_types = $this->model->UserType->all();

        $data = array(
            'page_name' => 'User',
            'action_table' => 'edit_user',
            'action_name' => 'Edit User',
            'token' => $token,
            'title' => 'edit',
            'users' => $users,
            'user_types' => $user_types,
        );

        // Load view
        $this->view->load('index', $data);
    }

     /**
    * action edit: update user database
    * method: POST
    */
    public function update()
    {
        $this->model->load('Users');
        //echo isset($_POST['username']) ? $_POST['username'] : 'null';
        $users = $this->model->Users->findById($_GET['id']);
        $users->name = $_POST['name'];
        $users->username = $_POST['username'];
        $users->password = $_POST['password'];
        $users->birthdate = $_POST['birthdate'];
        $users->phone = $_POST['phone'];
        $users->gender = $_POST['gender'];
        $users->identify_number = $_POST['identify_number'];
        $users->wallet = $_POST['wallet'];
        $users->is_social = $_POST['is_social'];
        $users->status = $_POST['status'];
        $users->id_user_type = $_POST['id_user_type'];
        $users->update();

        go_back();

    }


    /**
    * action create: create a user
    * method: GET
    */
    public function create()
    {
        $token = isset($_GET['token']) ? $_GET['token'] : "null";

        $this->model->load('UserType');
        $user_types = $this->model->UserType->all();

        $data = array(
            'page_name' => 'User',
            'action_table' => 'create_user',
            'action_name' => 'Add User',
            'token' => $token,
            'title' => 'index',
            'user_types' => $user_types,
        );

        // Load view
        $this->view->load('index', $data);
    }

     /**
    * action store: save a user to database
    * method: POST
    */
    public function store()
    {
        $this->model->load('Users');
        $this->model->Users->name = $_POST['name'];
        $this->model->Users->username = $_POST['username'];
        $this->model->Users->password = $_POST['password'];
        $this->model->Users->birthdate = $_POST['birthdate'];
        $this->model->Users->phone = $_POST['phone'];
        $this->model->Users->gender = $_POST['gender'];
        $this->model->Users->identify_number = $_POST['identify_number'];
        $this->model->Users->wallet = $_POST['wallet'];
        $this->model->Users->is_social = $_POST['is_social'];
        $this->model->Users->status = $_POST['status'];
        $this->model->Users->id_user_type = $_POST['id_user_type'];
        $this->model->Users->save();

        go_back();
    }


    /**
    * action delete: delete
    * method: GET
    */
    public function delete()
    {
        $this->model->load('Users');
        $user = $this->model->Users->findById($_GET['id']);
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
                    //redirect_to(URL . "controller=user&action=index&pages=0&token=$token");
                    redirect_to(URL . "controller=dashboard&action=index&token=$token");
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
            $token = $_GET['token'];
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
