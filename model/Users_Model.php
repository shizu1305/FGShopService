<?php
/**
*
*/
class Users_Model
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

  public function all(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from users';
    $result = mysqli_query($conn, $sql);
    $list_users = array();

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){
      $users = new Users_Model();
      $users->id = $row['id'];
      $users->name = $row['name'];
      $users->username = $row['username'];
      $users->password = $row['password'];
      $users->birthdate = $row['birthdate'];
      $users->phone = $row['phone'];
      $users->gender = $row['gender'];
      $users->identify_number = $row['identify_number'];
      $users->wallet = $row['wallet'];
      $users->is_social = $row['is_social'];
      $users->status = $row['status'];
      $users->token = $row['token'];
      $users->id_user_type = $row['id_user_type'];
      $list_users[] = $users;
    }
    return $list_users;
  }

  public function getNumRow() {
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("SELECT id FROM users");

    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->store_result();
    /*Fetch the value*/
    $stmt->fetch();

    return $stmt->num_rows;
  }

  public function getTable($pages){

    //set the number of items to display per page
    $items_per_page = 10;

    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from users LIMIT ' . $items_per_page . ' OFFSET ' . $pages;
    //$sql = 'select * from users';
    $result = mysqli_query($conn, $sql);
    $lists = array();

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){
      require_once(PATH_ROOT . '/model/' . 'UserType_Model.php');
      $user_type = new UserType_Model();
      $object = $user_type->findById($row['id_user_type']);
      $role = $object->name_user_type;
      $id = $row['id'];
      $lists[] = [
        '#' => $id,
        'Username' => $row['username'],
        'Name' => $row['name'],
        'Gender' => $row['gender'],
        'Birthdate' => $row['birthdate'],
        'Identify' => $row['identify_number'],
        'Wallet' => $row['wallet'],
        'Role' => $role,

        '<div class="text-center"><i class="ti-pencil-alt"></i></div>' =>
        '<div class="text-center"><a href="#"><i class="ti-pencil-alt"></i></a></div>',

        '<div class="text-center"><i class="ti-close"></i></div>' =>
        '<div class="text-center"><a href="#"><i class="ti-close"></i></a></div>',
      ];
    }
    return $lists;
  }

  public function save(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("INSERT INTO users (name, username, password, birthdate, phone, gender, identify_number, wallet, is_social, status, token, id_user_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssss", $this->name, $this->username, $this->password, $this->birthdate, $this->phone, $this->getnder, $this->identify_number, $this->wallet, $this->is_social, $this->status, $this->token, $this->id_user_type);
    $rs = $stmt->execute();
    $this->id = $stmt->insert_id;
    $stmt->close();
    return $rs;
  }

  public function findById($id){
		$conn = FT_Database::instance()->getConnection();
		$sql = 'select * from users where id='.$id;
		$result = mysqli_query($conn, $sql);
		if(!$result)
			die('Error: ');
		$row = mysqli_fetch_assoc($result);
        $users = new Users_Model();
        $users->id = $row['id'];
        $users->name = $row['name'];
        $users->username = $row['username'];
        $users->password = $row['password'];
        $users->birthdate = $row['birthdate'];
        $users->phone = $row['phone'];
        $users->gender = $row['gender'];
        $users->identify_number = $row['identify_number'];
        $users->wallet = $row['wallet'];
        $users->is_social = $row['is_social'];
        $users->status = $row['status'];
        $users->token = $row['token'];
        $users->id_user_type = $row['id_user_type'];
        return $users;
	}

	public function delete(){
		$conn = FT_Database::instance()->getConnection();
		$sql = 'delete from users where id='.$this->id;
		$result = mysqli_query($conn, $sql);
		return $result;
	}
	public function update(){
		$conn = FT_Database::instance()->getConnection();
		$stmt = $conn->prepare("UPDATE users SET name = ?, username = ?, password = ?, birthdate = ?, phone = ?, gender = ?, identify_number = ?, wallet = ?, is_social = ?, status = ?, token = ?, id_user_type WHERE id=?");
		$stmt->bind_param("ssssssssssssi", $this->name, $this->username, $this->password, $this->birthdate, $this->phone, $this->getnder, $this->identify_number, $this->wallet, $this->is_social, $this->status, $this->token, $this->id_user_type, $_POST['id']);
		$stmt->execute();
		$stmt->close();
	}

  public function validate_login($username, $password) {

    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? AND password = ?");

    $stmt->bind_param("ss", $username, $password);

    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->store_result();
    /*Fetch the value*/
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        /*Close statement*/
        $stmt->close();
        return $id;
     } else {
        /*Close statement*/
        $stmt->close();
        return 0;
     }
  }

  public function validate_logout($token) {
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("SELECT id FROM users WHERE token = ?");

    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->store_result();
    /*Fetch the value*/
    $stmt->fetch();
    if ($stmt->num_rows > 0) {
        /*Close statement*/
        $stmt->close();
        return $id;
     } else {
        /*Close statement*/
        $stmt->close();
        return 0;
     }
  }

  public function generate_token($id) {
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("UPDATE users SET token = ? WHERE id = ?");
    $token = csrf_token();
    $stmt->bind_param("si", $token, $id);
    $stmt->execute();
    $stmt->close();
    return $token;
  }

  public function remove_token($id) {
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("UPDATE users SET token = ? WHERE id = ?");
    $token = "";
    $stmt->bind_param("si", $token, $id);
    $stmt->execute();
    $stmt->close();
  }
}
