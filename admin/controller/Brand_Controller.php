<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Brand_Controller extends Base_Controller
{
    /**
    * action index: show all users
    * method: GET
    */
    public function index()
    {
        $pages = isset($_GET['pages']) ? $_GET['pages'] : 0;
        $token = isset($_GET['token']) ? $_GET['token'] : "null";
        $this->model->load('Brand');
        $list_brand = $this->model->Brand->getTable($pages, $token);
        $num_rows = $this->model->Brand->getNumRow();
        $data = array(
            'page_name' => 'Brand',
            'action_table' => 'index_table',
            'token' => $token,
            'pages' => $pages,
            'title' => 'index',
            'table_name' => 'Brand Table',
            'table_subtitle' => 'Here is a table brand',
            'list' => $list_brand,
            'num_rows' => $num_rows,
        );

        // Load view
        $this->view->load('index', $data);
    }

    /**
    * action edit: show form edit a brand
    * method: GET
    */
    public function edit()
    {
        $token = isset($_GET['token']) ? $_GET['token'] : "null";

        $this->model->load('Brand');
        $brand = $this->model->Brand->findById($_GET['id']);

        $data = array(
            'page_name' => 'Brand',
            'action_table' => 'brand/edit',
            'action_name' => 'Edit Brand',
            'token' => $token,
            'title' => 'edit',
            'object' => $brand,
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
        $this->model->load('Brand');
        $users = $this->model->Brand->findById($_GET['id']);
        $users->name_brand = $_POST['name_brand'];
        $users->update();

        go_back();

    }


    /**
    * action create: create a brand
    * method: GET
    */
    public function create()
    {
        $token = isset($_GET['token']) ? $_GET['token'] : "null";

        $data = array(
            'page_name' => 'Brand',
            'action_table' => 'brand/create',
            'action_name' => 'Add Brand',
            'token' => $token,
            'title' => 'create',
        );

        // Load view
        $this->view->load('index', $data);
    }

     /**
    * action store: save a brand to database
    * method: POST
    */
    public function store()
    {
        $this->model->load('Brand');
        $this->model->Brand->name_brand = $_POST['name_brand'];
        $this->model->Brand->save();

        go_back();
    }


    /**
    * action delete: delete
    * method: GET
    */
    public function delete()
    {
        $this->model->load('Brand');
        $user = $this->model->Brand->findById($_GET['id']);
        $user->delete();

        go_back();
    }

}
