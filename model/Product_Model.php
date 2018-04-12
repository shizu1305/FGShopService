<?php
/**
*
*/
class Product_Model
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

  public function all(){
		$conn = FT_Database::instance()->getConnection();
		$sql = 'select * from product';
		$result = mysqli_query($conn, $sql);
		$list_product = array();
		if(!$result)
			die('Error: '.mysqli_query_error());
		while ($row = mysqli_fetch_assoc($result)){
      $product = new Product_Model();
      $product->id = $row['id'];
      $product->name_product = $row['name_product'];
      $product->price = $row['price'];
      $product->isbn = $row['isbn'];
      $product->infor = $row['infor'];
      $product->desc = $row['desc'];
      $product->status = $row['status'];
      $product->discount = $row['discount'];
      $product->quanity = $row['quanity'];
      $product->add_by = $row['add_by'];
      $product->id_image = $row['id_image'];
      $product->id_product_type = $row['id_product_type'];
      $product->id_brand = $row['id_brand'];
      $list_product[] = $product;
    }

  return $list_product;
  }

	public function save(){
		$conn = FT_Database::instance()->getConnection();
		$stmt = $conn->prepare("INSERT INTO product (name_product, price, isbn, infor, desc, status, discount, quanity, add_by, id_image, id_product_type, id_brand) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssssiiiiii", $this->name_product, $this->price, $this->isbn, $this->infor, $this->desc, $this->status, $this->discount, $this->quanity, $this->add_by, $this->id_image, $this->id_product_type, $this->id_brand);
		$rs = $stmt->execute();
		$this->id = $stmt->insert_id;
		$stmt->close();
		return $rs;
	}

	public function findById($id){
		$conn = FT_Database::instance()->getConnection();
		$sql = 'select * from product where id='.$id;
		$result = mysqli_query($conn, $sql);

		if(!$result)
			die('Error: ');

		$row = mysqli_fetch_assoc($result);
        $product = new Product_Model();
        $product->id = $row['id'];
        $product->name_product = $row['name_product'];
        $product->price = $row['price'];
        $product->isbn = $row['isbn'];
        $product->infor = $row['infor'];
        $product->desc = $row['desc'];
        $product->status = $row['status'];
        $product->discount = $row['discount'];
        $product->quanity = $row['quanity'];
        $product->add_by = $row['add_by'];
        $product->id_image = $row['id_image'];
        $product->id_product_type = $row['id_product_type'];
        $product->id_brand = $row['id_brand'];

        return $product;
	}

	public function delete(){
		$conn = FT_Database::instance()->getConnection();
		$sql = 'delete from product where id='.$this->id;
		$result = mysqli_query($conn, $sql);

		return $result;
	}

	public function update(){
		$conn = FT_Database::instance()->getConnection();
		$stmt = $conn->prepare("UPDATE product SET name_product=?, price=?, isbn=?, infor=?, desc=?, status=?, discount=?, quanity=?, add_by=?, id_image=?, id_product_type=?, id_brand=?  WHERE id=?");
		$stmt->bind_param("sssssiiiiiii", $this->name_product, $this->price, $this->isbn, $this->infor, $this->desc, $this->status, $this->discount, $this->quanity, $this->add_by, $this->id_image, $this->id_product_type, $this->id_brand, $_POST['id']);
		$stmt->execute();
		$stmt->close();
	}
}
