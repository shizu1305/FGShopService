<?php
/**
*
*/
class Brand_Model
{

  public $id;
  public $name_brand;

  function __construct()
  {
    # code...
  }

  public function all(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from brand';
    $result = mysqli_query($conn, $sql);
    $list_brand = array();

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){
      $brand = new Brand_Model();
      $brand->id = $row['id'];
      $brand->name_brand = $row['name_brand'];
      $list_brand[] = $brand;
    }
    return $list_brand;
  }

  public function getNumRow() {
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("SELECT id FROM brand");

    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->store_result();
    /*Fetch the value*/
    $stmt->fetch();

    return $stmt->num_rows;
  }

  public function getTable($pages, $token){

    //set the number of items to display per page
    $items_per_page = 10;
    $controller = 'brand';

    $conn = FT_Database::instance()->getConnection();

    $sql = 'select * from brand LIMIT ' . $items_per_page . ' OFFSET ' . $pages;

    $result = mysqli_query($conn, $sql);
    $lists = array();

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){

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
      $lists[] = [
        '#' => $id,
        'Name' => $row['name_brand'],

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
    $stmt = $conn->prepare("INSERT INTO brand (name_brand) VALUES (?)");
    $stmt->bind_param("s", $this->name_brand);
    $rs = $stmt->execute();
    $this->id = $stmt->insert_id;
    $stmt->close();
    return $rs;
  }

  public function findById($id){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from brand where id='.$id;
    $result = mysqli_query($conn, $sql);
    if(!$result)
      die('Error: ');
    $row = mysqli_fetch_assoc($result);
        $brand = new Brand_Model();
        $brand->id = $row['id'];
        $brand->name_brand = $row['name_brand'];
        return $brand;
  }

  public function delete(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'delete from brand where id='.$this->id;
    $result = mysqli_query($conn, $sql);
    return $result;
  }
  public function update(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("UPDATE brand SET name_brand = ? WHERE id=?");
    $stmt->bind_param("si", $this->name_brand, $_GET['id']);
    $stmt->execute();
    $stmt->close();
  }
}
