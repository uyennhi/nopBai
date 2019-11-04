<?php
include_once("../model/entity/contacts.php");
$rs = Contact::getListFromDB();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

  <?php 
  $id = $_REQUEST["m"];
  if($_SERVER["REQUEST_METHOD"] == "POST") {
             //   $maQuaTrinhHocTap = $_REQUEST["txtMaQuaTrinhHocTap"];
    $name = $_REQUEST["txtname"];
    $phone = $_REQUEST["txtphone"];
    $email = $_REQUEST["txtemail"];
    $conn = new mysqli("localhost","root","","contactsdb")  ;    
    $conn->set_charset("utf8");
    if($conn->connect_error)
      die("kết nối thất bại. Chi tiết lỗi".$conn->connect_error);
                // bước 2: thao tác với db
    $query = "UPDATE contacts  SET name='$name',phone='$phone',email='$email' WHERE id=$id";
    if ($conn->query($query) === TRUE) {
      header('Location:index.php');
      exit;
    } else {
      echo "Error: " .$query . "<br>" . $conn->error;
    }
                //bước 3 : đóng kết nối db
    $conn->close();

  }


  ?>  

  <h1>Thông tin </h1><hr>
  <?php
  foreach($rs as $key => $value){
    if($value->id==$id)
    {    

     ?>
     <form  class="form-horizontal" action="edit.php?m=<?php echo($id) ?>" method="post">
      <div class="form-group">
        <label class="control-label col-sm-2" >Name</label>
        <div class="col-sm-5">
          <input type="text" class="form-control"  name="txtname" placeholder="name" value='<?php echo $value->name ?>' >
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" >Phone</label>
        <div class="col-sm-5">
         <input type="tel" class="form-control" name="txtphone" placeholder="phone 012-345-6789" value='<?php echo $value->phone ?>' pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
       </div>
     </div>
     <div class="form-group">
      <label class="control-label col-sm-2" >Email</label>
      <div class="col-sm-5">
        <input type="Email" class="form-control" name="txtemail" value='<?php echo $value->email ?>' placeholder="email">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success">Edit</button>
        <a class="btn btn-danger" href="index.php">Cancel</a>
      </div>
    </div>
  </form>
  <?php
}}
?>
</body>
</html>