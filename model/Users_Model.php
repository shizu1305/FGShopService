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
}
