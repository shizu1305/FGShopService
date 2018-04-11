<?php  if(!defined('PATH_SYSTEM')) die('Bad request!');

/**
* @filesource system/core/FT_Controller.php
*/

class FT_Controller {
  //Object view
  protected $view     = null;
  //Object model
  protected $model    = null;
  //Object library
  protected $library  = null;
  //Object helper
  protected $helper   = null;

  public function __construct() {
    //Loader for config
    require_once PATH_SYSTEM . '/core/loader/FT_Config_Loader.php';
    $this->config = new FT_Config_Loader();
    $this->config->load('config');

    //Loader Library
    require_once PATH_SYSTEM . '/core/loader/FT_Library_Loader.php';
    $this->library = new FT_Library_Loader();

    //Loader Helper
    require_once PATH_SYSTEM . '/core/loader/FT_Helper_Loader.php';
    $this->helper = new FT_Helper_Loader();

    //Loader View
    require_once PATH_SYSTEM . '/core/loader/FT_View_Loader.php';
    $this->view = new FT_View_Loader();
  }

}

?>
