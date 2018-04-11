<?php
  //path system
  define('PATH_SYSTEM', __DIR__.'/system');
  define('PATH_APPLICATION', __DIR__.'/admin');
  define('PATH_MODEL', __DIR__.'/model');

  //Get Parameter config
  require (PATH_SYSTEM . '/config/config.php');

  //open file FT_Common.php, file have function FT_Load() run system
  include_once PATH_SYSTEM . '/core/FT_Common.php';

  //Run program
  FT_Load();
 ?>
