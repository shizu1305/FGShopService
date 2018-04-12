<?php
/**
*
*/
class UserType_Model
{

  public $id;
  public $name_user_type;

  function __construct()
  {
    # code...
  }

  public function all(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from user_type';
    $result = mysqli_query($conn, $sql);
    $list_user_type = array();

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){
      $user_type = new UserType_Model();
      $user_type->id = $row['id'];
      $user_type->name_user_type = $row['name_user_type'];
      $list_user_type[] = $user_type;
    }
    return $list_user_type;
  }

  public function save(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("INSERT INTO user_type (name_user_type) VALUES (?)");
    $stmt->bind_param("s", $this->name_user_type);
    $rs = $stmt->execute();
    $this->id = $stmt->insert_id;
    $stmt->close();
    return $rs;
  }

  public function findById($id){
		$conn = FT_Database::instance()->getConnection();
		$sql = 'select * from user_type where id='.$id;
		$result = mysqli_query($conn, $sql);
		if(!$result)
			die('Error: ');
		$row = mysqli_fetch_assoc($result);
        $user_type = new UserType_Model();
        $user_type->id = $row['id'];
        $user_type->name_user_type = $row['name_user_type'];
        return $user_type;
	}
	public function delete(){
		$conn = FT_Database::instance()->getConnection();
		$sql = 'delete from user_type where id='.$this->id;
		$result = mysqli_query($conn, $sql);
		return $result;
	}
	public function update(){
		$conn = FT_Database::instance()->getConnection();
		$stmt = $conn->prepare("UPDATE user_type SET name_user_type = ? WHERE id=?");
		$stmt->bind_param("si", $this->name_user_type, $_POST['id']);
		$stmt->execute();
		$stmt->close();
	}
}
