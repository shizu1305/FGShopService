<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Dashboard_Controller extends Base_Controller
{
  public function index() {
        $token = isset($_GET['token']) ? $_GET['token'] : "null";
        $data = array(
            'page_name' => 'Dashboard',
            'action_table' => 'null',
            'token' => $token,
            'title' => 'index'
        );

        // Load view
        $this->view->load('index', $data);
  }
}
