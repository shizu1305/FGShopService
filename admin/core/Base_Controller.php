<?php  if(!defined('PATH_SYSTEM')) die('Bad request!');

class Base_Controller extends FT_Controller {

  public function __construct() {
    parent::__construct();
  }

  public function load_header() {
    //Load content header
  }

  public function load_footer() {
    //Load content footer
  }

  //Cancel task show content of view, this time controller
  //needn't call $this->view->show
  public function __destruct() {
    $this->view->show();
  }
}
