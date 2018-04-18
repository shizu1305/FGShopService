<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class GroupProductType_Controller extends Base_Controller
{
    /**
    * action index: show all users
    * method: GET
    */
    public function index()
    {
        $pages = isset($_GET['pages']) ? $_GET['pages'] : 0;
        $token = isset($_GET['token']) ? $_GET['token'] : "null";
        $this->model->load('GroupProductType');
        $list_GroupProductType = $this->model->GroupProductType->getTable($pages, $token);
        $num_rows = $this->model->GroupProductType->getNumRow();
        $data = array(
            'page_name' => 'GroupProductType',
            'action_table' => 'index_table',
            'token' => $token,
            'pages' => $pages,
            'title' => 'index',
            'table_name' => 'GroupProductType Table',
            'table_subtitle' => 'Here is a table GroupProductType',
            'list' => $list_GroupProductType,
            'num_rows' => $num_rows,
        );

        // Load view
        $this->view->load('index', $data);
    }

    /**
    * action edit: show form edit a GroupProductType
    * method: GET
    */
    public function edit()
    {
        $token = isset($_GET['token']) ? $_GET['token'] : "null";

        $this->model->load('GroupProductType');
        $GroupProductType = $this->model->GroupProductType->findById($_GET['id']);

        $data = array(
            'page_name' => 'GroupProductType',
            'action_table' => 'group_product_type/edit',
            'action_name' => 'Edit GroupProductType',
            'token' => $token,
            'title' => 'edit',
            'object' => $GroupProductType,
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
        $this->model->load('GroupProductType');
        $users = $this->model->GroupProductType->findById($_GET['id']);
        $users->name_group = $_POST['name_group'];
        $users->update();

        go_back();

    }


    /**
    * action create: create a GroupProductType
    * method: GET
    */
    public function create()
    {
        $token = isset($_GET['token']) ? $_GET['token'] : "null";

        $data = array(
            'page_name' => 'GroupProductType',
            'action_table' => 'group_product_type/create',
            'action_name' => 'Add GroupProductType',
            'token' => $token,
            'title' => 'create',
        );

        // Load view
        $this->view->load('index', $data);
    }

     /**
    * action store: save a GroupProductType to database
    * method: POST
    */
    public function store()
    {
        $this->model->load('GroupProductType');
        $this->model->GroupProductType->name_group = $_POST['name_group'];
        $this->model->GroupProductType->save();

        go_back();
    }


    /**
    * action delete: delete
    * method: GET
    */
    public function delete()
    {
        $this->model->load('GroupProductType');
        $user = $this->model->GroupProductType->findById($_GET['id']);
        $user->delete();

        go_back();
    }

}
