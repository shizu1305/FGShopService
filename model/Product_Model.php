<?php
/**
*
*/
class Product_Model extends Model
{

  public $id;
  public $name_product;
  public $price;
  public $isbn;
  public $infor;
  public $desc;
  public $status;
  public $discount;
  public $quanity;
  public $add_by;
  public $id_image;
  public $id_product_type;
  public $id_brand;

  function __construct()
  {
    # code...
  }
}
