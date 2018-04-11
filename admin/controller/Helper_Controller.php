<?php  if(!defined('PATH_SYSTEM')) die('Bad request!');

/**
* @filesource system/core/FT_Controller.php
*/

class Helper_Controller extends FT_Controller {
  public function indexAction() {
    //Load helper
    $this->helper->load('string');

    //Call function string_to_int
    echo string_to_int('kenhoang.com');
  }
}
