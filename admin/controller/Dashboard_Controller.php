<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Dashboard_Controller extends Base_Controller
{
  public function index() {
        $token = isset($_GET['token']) ? $_GET['token'] : "null";

        
        $this->model->load('UserType');
        $num_row_usertype = $this->model->UserType->getNumRow();

        $this->model->load('Users');
        $num_row_user = $this->model->Users->getNumRow();

        $this->model->load('Image');
        $num_row_image = $this->model->Image->getNumRow();
        
        $this->model->load('Brand');
        $num_row_brand = $this->model->Brand->getNumRow();

        $this->model->load('GroupProductType');
        $num_row_grouptype = $this->model->GroupProductType->getNumRow();

        $this->model->load('ProductType');
        $num_row_type = $this->model->ProductType->getNumRow();
        
        $this->model->load('Product');
        $num_row_product = $this->model->Product->getNumRow();
        
        $this->model->load('Order');
        $num_row_order = $this->model->Order->getNumRow();
        $data = array(
            'page_name' => 'Dashboard',
            'action_table' => 'null',
            'token' => $token,
            'title' => 'index',
            'num_row_usertype' => $num_row_usertype,
            'num_row_user' => $num_row_user,
            'num_row_image' => $num_row_image,
            'num_row_brand' => $num_row_brand,
            'num_row_grouptype' => $num_row_grouptype,
            'num_row_type' => $num_row_type,
            'num_row_product' => $num_row_product,
            'num_row_order' => $num_row_order,

        );

        // Load view
        $this->view->load('index', $data);
  }
}
