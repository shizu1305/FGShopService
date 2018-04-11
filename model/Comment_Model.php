<?php
/**
*
*/
class Comment_Model extends Model
{

  public $id;
  public $id_user;
  public $id_product;
  public $content;
  public $time_comment;

  function __construct()
  {
    # code...
  }
}
