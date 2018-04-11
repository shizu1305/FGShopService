<?php
/**
*
*/
class ProductType_Model extends Model
{

  public $id;
  public $name_type;
  public $id_group;

  public function all(){
		  $conn = FT_Database::instance()->getConnection();
		$sql = 'select * from product_type';
		$result = mysqli_query($conn, $sql);
		$list_product_type = array();
		if(!$result)
			die('Error: '.mysqli_query_error());
		while ($row = mysqli_fetch_assoc($result)){
      $product = new Product_Model();
      $product->id = $row['id'];
      $product->name_type = $row['name_type'];
      $product->id_group = $row['id_group'];
      $list_product[] = $product;
    }

    return $list_product;
  }

	public function save(){
		$conn = FT_Database::instance()->getConnection();
		$stmt = $conn->prepare("INSERT INTO product (name_type, id_group) VALUES (?, ?)");
		$stmt->bind_param("si", $this->name_type, $this->id_group);
		$rs = $stmt->execute();
		$this->id = $stmt->insert_id;
		$stmt->close();
		return $rs;
	}

	public function findById($id){
		$conn = FT_Database::instance()->getConnection();
		$sql = 'select * from product_type where id='.$id;
		$result = mysqli_query($conn, $sql);

		if(!$result)
			die('Error: ');

		$row = mysqli_fetch_assoc($result);
        $product = new Product_Model();
        $product->id = $row['id'];
        $product->name_type = $row['name_type'];
        $product->id_group = $row['id_group'];

        return $product;
	}

	public function delete(){
		$conn = FT_Database::instance()->getConnection();
		$sql = 'delete from product_type where id='.$this->id;
		$result = mysqli_query($conn, $sql);

		return $result;
	}

	public function update(){
		$conn = FT_Database::instance()->getConnection();
		$stmt = $conn->prepare("UPDATE product SET name_type=?, id_group=?  WHERE id=?");
		$stmt->bind_param("si", $this->name_type, $this->id_group, $_POST['id']);
		$stmt->execute();
		$stmt->close();
	}
}
