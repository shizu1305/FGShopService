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
  public $quanity;
  public $add_by;
  public $id_product_type;
  public $id_brand;

  function __construct()
  {
    # code...
  }

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
      $product->isbn = $isbn['isbn'];
      $product->infor = $row['infor'];
      $product->desc = $row['desc'];
      $product->status = $row['status'];
      $product->quanity = $row['quanity'];
      $product->add_by = $row['add_by'];
      $product->id_product_type = $row['id_product_type'];
      $product->id_brand = $row['id_brand'];
      $list_product[] = $product;
    }
    return $list_product;
  }

  public function getNumRow() {
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("SELECT id FROM product");

    if ($stmt) {
      $stmt->execute();
      $stmt->bind_result($id);
      $stmt->store_result();
      /*Fetch the value*/
      $stmt->fetch();
      return $stmt->num_rows;
    } else {
      return 0;
    }
  }

  public function getTable($pages, $token){

    //set the number of items to display per page
    $items_per_page = 10;
    $controller = 'product';

    $conn = FT_Database::instance()->getConnection();

    $sql = 'select * from product LIMIT ' . $items_per_page . ' OFFSET ' . $pages;

    $result = mysqli_query($conn, $sql);
    $lists = array();

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){

      require_once(PATH_ROOT . '/model/' . 'Users_Model.php');
      $add_by = new Users_Model();
      $add_by = $add_by->findById($row['add_by']);
      $add_by = $add_by->name;

      require_once(PATH_ROOT . '/model/' . 'ProductType_Model.php');
      $product_type = new ProductType_Model();
      $product_type = $product_type->findById($row['id_product_type']);
      $product_type = $product_type->name_type;

      require_once(PATH_ROOT . '/model/' . 'Brand_Model.php');
      $brand = new Brand_Model();
      $brand = $brand->findById($row['id_brand']);
      $brand = $brand->name_brand;

      $id = $row['id'];
      $href =  "admin.php?controller=$controller&action=delete&id=$id&token=$token";
      $confirm = "swal({
            title: 'Are you sure?',
            text: 'You will not be able to recover this imaginary file!',
            icon: 'warning',
            buttons: [
              'No, cancel it!',
              'Yes, I am sure!'
            ],
            dangerMode: true,
          }).then(function(isConfirm) {
            if (isConfirm) {
              swal({
                title: 'Shortlisted!',
                text: 'Candidates are successfully shortlisted!',
                icon: 'success',
              }).then(function() {
                form.submit(); // <--- submit form programmatically
              });
              window.location.href = '".$href."';
            } else {
              swal('Cancelled', 'Your imaginary file is safe :)', 'error');
            }
      })";

      $name_product = strlen($row['name_product']) > 40 ? substr($row['name_product'],0,40)."..." : $row['name_product'];

      $lists[] = [
        '#' => $id,
        'Name' => $name_product,
        'Price' => $row['price'],
        'Quanity' => $row['quanity'],
        'Add' => $add_by,
        'Type' => $product_type,
        'Brand' => $brand,

        '<div class="text-center"><i class="ti-pencil-alt"></i></div>' =>
        '<div class="text-center"><a href="admin.php?controller='. $controller . '&action=edit&id=' . $id . '&token='.$token.'"><i class="ti-pencil-alt"></i></a></div>',

        '<div class="text-center"><i class="ti-close"></i></div>' =>
        '<div class="text-center"><a href="#"><i class="ti-close"  onclick="'.$confirm.'"></i></a></div>',
      ];
    }
    return $lists;
  }

  public function save(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("INSERT INTO product (name_product, price, isbn, infor, `desc`, status, quanity, add_by, id_product_type, id_brand) VALUES (?, ?, ?, ?, ?, ? , ?, ?, ?, ?)");
    $stmt->bind_param("sdssssiiii", $this->name_product, $this->price, $this->isbn, $this->infor, $this->desc, $this->status, $this->quanity, $this->add_by, $this->id_product_type, $this->id_brand);
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
        $product->quanity = $row['quanity'];
        $product->add_by = $row['add_by'];
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
    $stmt = $conn->prepare("UPDATE product SET name_product = ?, price = ?, isbn = ?, infor = ?, `desc` = ?, status = ?, quanity = ?, add_by = ?, id_product_type = ?, id_brand = ? WHERE id = ?");
    $stmt->bind_param("ssssssssssi", $this->name_product, $this->price, $this->isbn, $this->infor, $this->desc, $this->status, $this->quanity, $this->add_by, $this->id_product_type, $this->id_brand, $_GET['id']);
    $stmt->execute();
    $stmt->close();
  }
}

