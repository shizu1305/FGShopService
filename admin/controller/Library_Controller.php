<?php  if(!defined('PATH_SYSTEM')) die('Bad request!');

/**
* @filesource system/core/FT_Controller.php
*/

class Library_Controller extends FT_Controller {
  public function indexAction() {
    //Create new library
    $this->library->load('upload');

    //Call method upload
    $this->library->upload->upload();
  }
}

?>
