<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Image_Controller extends Base_Controller
{
    /**
    * action index: show all Image
    * method: GET
    */
    public function index()
    {
        $pages = isset($_GET['pages']) ? $_GET['pages'] : 0;
        $token = isset($_GET['token']) ? $_GET['token'] : "null";
        $this->model->load('Image');
        $list_Image = $this->model->Image->getTable($pages, $token);
        $num_rows = $this->model->Image->getNumRow();
        $data = array(
            'page_name' => 'Image',
            'action_table' => 'index_table',
            'token' => $token,
            'pages' => $pages,
            'title' => 'index',
            'table_name' => 'Image Table',
            'table_subtitle' => 'Here is a table Image',
            'list' => $list_Image,
            'num_rows' => $num_rows,
        );

        // Load view
        $this->view->load('index', $data);
    }

    /**
    * action edit: show form edit a Image
    * method: GET
    */
    public function edit()
    {
        $token = isset($_GET['token']) ? $_GET['token'] : "null";

        $this->model->load('Image');
        $Image = $this->model->Image->findById($_GET['id']);

        $data = array(
            'page_name' => 'Image',
            'action_table' => 'image/edit',
            'action_name' => 'Edit Image',
            'token' => $token,
            'title' => 'edit',
            'object' => $Image,
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
        $this->model->load('Image');
        $Image = $this->model->Image->findById($_GET['id']);
        $Image->big_img = $_POST['big_img'];
        $Image->small_img = $_POST['small_img'];
        $Image->details_img = $_POST['details_img'];
        $Image->update();

        go_back();

    }


    /**
    * action create: create a Image
    * method: GET
    */
    public function create()
    {
        $token = isset($_GET['token']) ? $_GET['token'] : "null";

        $data = array(
            'page_name' => 'Image',
            'action_table' => 'image/create',
            'action_name' => 'Add Image',
            'token' => $token,
            'title' => 'create',
        );

        // Load view
        $this->view->load('index', $data);
    }

     /**
    * action store: save a Image to database
    * method: POST
    */
    public function store()
    {
        $this->model->load('Image');
        $this->model->Image->big_img = $_POST['big_img'];
        $this->model->Image->small_img = $_POST['small_img'];
        $this->model->Image->details_img = $_POST['details_img'];
        $this->model->Image->save();

        go_back();
    }


    /**
    * action delete: delete
    * method: GET
    */
    public function delete()
    {
        $this->model->load('Image');
        $user = $this->model->Image->findById($_GET['id']);
        $user->delete();

        go_back();
    }

}
