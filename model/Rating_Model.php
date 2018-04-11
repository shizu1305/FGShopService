<?php
/**
*
*/
class Rating_Model extends Model
{

  public $id;
  public $id_product;
  public $id_user;
  public $content;
  public $stars;
  public $time_rate;

  function __construct()
  {
    # code...
  }
}
