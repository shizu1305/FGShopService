<?php  if(!defined('PATH_SYSTEM')) die('Bad request!');

class Product_Controller extends Base_Controller {

  public function indexAction() {
    $this->view->load('product');
  }

}
