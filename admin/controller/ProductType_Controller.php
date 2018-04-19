<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class ProductType_Controller extends Base_Controller
{
    /**
    * action index: show all users
    * method: GET
    */
    public function index()
    {
        $pages = isset($_GET['pages']) ? $_GET['pages'] : 0;
        $token = isset($_GET['token']) ? $_GET['token'] : "null";
        $this->model->load('ProductType');
        $list_ProductType = $this->model->ProductType->getTable($pages, $token);
        $num_rows = $this->model->ProductType->getNumRow();
        $data = array(
            'page_name' => 'ProductType',
            'action_table' => 'index_table',
            'token' => $token,
            'pages' => $pages,
            'title' => 'index',
            'table_name' => 'ProductType Table',
            'table_subtitle' => 'Here is a table ProductType',
            'list' => $list_ProductType,
            'num_rows' => $num_rows,
        );

        // Load view
        $this->view->load('index', $data);
    }

    /**
    * action edit: show form edit a ProductType
    * method: GET
    */
    public function edit()
    {
        $token = isset($_GET['token']) ? $_GET['token'] : "null";

        $this->model->load('ProductType');
        $ProductType = $this->model->ProductType->findById($_GET['id']);

        $this->model->load('GroupProductType');
        $group_product_types = $this->model->GroupProductType->all();

        $data = array(
            'page_name' => 'ProductType',
            'action_table' => 'product_type/edit',
            'action_name' => 'Edit ProductType',
            'token' => $token,
            'title' => 'edit',
            'object' => $ProductType,
            'group_product_types' => $group_product_types
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
        $this->model->load('ProductType');
        $users = $this->model->ProductType->findById($_GET['id']);
        $users->name_type = $_POST['name_type'];
        $users->id_group = $_POST['id_group'];
        $users->update();

        go_back();

    }


    /**
    * action create: create a ProductType
    * method: GET
    */
    public function create()
    {
        $token = isset($_GET['token']) ? $_GET['token'] : "null";

        $this->model->load('GroupProductType');
        $group_product_types = $this->model->GroupProductType->all();

        $data = array(
            'page_name' => 'ProductType',
            'action_table' => 'product_type/create',
            'action_name' => 'Add ProductType',
            'token' => $token,
            'title' => 'create',
            'group_product_types' => $group_product_types
        );

        // Load view
        $this->view->load('index', $data);
    }

     /**
    * action store: save a ProductType to database
    * method: POST
    */
    public function store()
    {
        $this->model->load('ProductType');
        $this->model->ProductType->name_type = $_POST['name_type'];
        $this->model->ProductType->id_group = $_POST['id_group'];
        $this->model->ProductType->save();

        go_back();
    }


    /**
    * action delete: delete
    * method: GET
    */
    public function delete()
    {
        $this->model->load('ProductType');
        $user = $this->model->ProductType->findById($_GET['id']);
        $user->delete();

        go_back();
    }

}
