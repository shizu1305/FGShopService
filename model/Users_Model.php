<?php
/**
*
*/
class Users_Model extends Model
{

  public $id;
  public $name;
  public $username;
  public $password;
  public $birthdate;
  public $phone;
  public $gender;
  public $identify_number;
  public $wallet;
  public $is_social;
  public $status;
  public $token;
  public $id_user_type;

  function __construct()
  {
    # code...
  }
}
