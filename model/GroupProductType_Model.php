<?php
/**
*
*/
class GroupProductType_Model
{

  public $id;
  public $name_group;

  function __construct()
  {
    # code...
  }

   public function all(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from group_product_type';
    $result = mysqli_query($conn, $sql);
    $list_group_product_type = array();

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){
      $group_product_type = new GroupProductType_Model();
      $group_product_type->id = $row['id'];
      $group_product_type->name_group = $row['name_group'];
      $list_group_product_type[] = $group_product_type;
    }
    return $list_group_product_type;
  }

  public function getNumRow() {
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("SELECT id FROM group_product_type");

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
    $controller = 'GroupProductType';

    $conn = FT_Database::instance()->getConnection();

    $sql = 'select * from group_product_type LIMIT ' . $items_per_page . ' OFFSET ' . $pages;

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
        'Name' => $row['name_group'],

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
    $stmt = $conn->prepare("INSERT INTO group_product_type (name_group) VALUES (?)");
    $stmt->bind_param("s", $this->name_group);
    $rs = $stmt->execute();
    $this->id = $stmt->insert_id;
    $stmt->close();
    return $rs;
  }

  public function findById($id){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from group_product_type where id='.$id;
    $result = mysqli_query($conn, $sql);
    if(!$result)
      die('Error: ');
    $row = mysqli_fetch_assoc($result);
        $group_product_type = new GroupProductType_Model();
        $group_product_type->id = $row['id'];
        $group_product_type->name_group = $row['name_group'];
        return $group_product_type;
  }

  public function delete(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'delete from group_product_type where id='.$this->id;
    $result = mysqli_query($conn, $sql);
    return $result;
  }
  public function update(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("UPDATE group_product_type SET name_group = ? WHERE id=?");
    $stmt->bind_param("si", $this->name_group, $_GET['id']);
    $stmt->execute();
    $stmt->close();
  }
}
