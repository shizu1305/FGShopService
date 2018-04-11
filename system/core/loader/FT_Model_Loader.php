<?php  if(!defined('PATH_SYSTEM')) die('Bad request!');

class FT_Model_Loader {

  public function load($model, $args) {
    //if model is exists, is load
    if (empty($this->{$model})) {
      //Concat Model
      $class = $model . '_Model';
      require_once(PATH_MODEL . '/' . $class . '.php');
      $this->{$model} = new $class($args);
    }
  }

}
