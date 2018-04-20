<?php
/**
*
*/
class Order_Model
{

  public $id;
  public $id_user;
  public $status;
  public $delivery_address;
  public $delivery_date;
  public $order_date;
  public $desc;

  function __construct()
  {
    # code...
  }

  public function getNumRow() {
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("SELECT id FROM image");

    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->store_result();
    /*Fetch the value*/
    $stmt->fetch();

    return $stmt->num_rows;
  }
}
