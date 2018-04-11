<?php  if(!defined('PATH_SYSTEM')) die('Bad request!');

class View_Controller extends FT_Controller {

  public function indexAction() {
    $data = [
        'title' => 'Welcome to kenhoang.com'
    ];

    //Load view
    $this->view->load('view', $data);

    //Show view
    $this->view->show();
  }

}
