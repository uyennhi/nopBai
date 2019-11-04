<?php
session_start();
if ($_SESSION['user']==null)
{
  header('Location:login.php');
  exit;
}
    include_once("../model/entity/contacts.php");
    $rsName =  Contact::getListName();
    if(isset($_GET["str"]))
    {
         $rs = Contact::search($_GET["str"]);
    }
    else
    {
       $rs = Contact::getListBanhBa();
    }
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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<style type="text/css">
.has-search .form-control {
  padding-left: 2.375rem;
}

.has-search .form-control-feedback {
  position: absolute;
  z-index: 2;
  display: block;
  width: 2.375rem;
  height: 2.375rem;
  line-height: 2.375rem;
  text-align: center;
  pointer-events: none;
  color: #aaa;
}
</style>
<body>

  <div class="container mt-3">
    <h2 style="text-align: center;">Contacts</h2>
    <div class="form-group has-search">
      <span class="fa fa-search form-control-feedback"></span>
      <input class="form-control" id="myInput" type="text" placeholder="Search..">
    </div>

    <br>
    <h1 style="text-align: right;">
      <a class="btn btn-success" style="margin-right: 95px;" href="add.php">Add</a>
    </h1>
    <div class="row">
      <div class="col-11">
        <table class="table table-bordered">
      <thead>
        <tr>
          <th></th>
          <th>Firstname</th>
          <th>Lastname</th>
          <th>Email</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="myTable">
        <?php
          foreach($rs as $key => $value){
             echo "  <tr>";
             echo " <td style='text-transform: uppercase;'>$value->firstChar</td>";
             echo " <td style='text-transform: uppercase;'>$value->name</td>";
             echo " <td>$value->phone</td>";
             echo " <td>$value->email</td>";
             echo " <td>";
             echo "  <a class='btn btn-primary' style='color:white 'href='edit.php?m=$value->id'>Edit</a>";
             echo "  <a class='btn btn-danger' style='color:white 'href='delete.php?m=$value->id'>Delete</a>";
             echo " </td>";
             echo " </tr>";
        }
          ?>
      </tbody>
    </table>
        
      </div>
       <div class="col-1">
        <div style="margin-top: 50px">
            <ul style="padding: 0;" class="">
             <?php
             foreach($rsName as $key => $value){
              
               echo " <li style='text-transform: uppercase;   list-style: none; margin-top: 20px;'><a style='text-decoration: none;
  color: black;' href='index.php?str=$value' >$value</a></li>";
              
             }
             ?>
          </ul>
        </div>
     

       </div>
    </div>
     <h1 style="text-align: right; margin-right: 95px;">
      <?php
        if(isset($_GET["str"]))
        {
           echo ' <a class="btn btn-success" href="index.php">HOME</a> ';
        }
       ?>
       
      <a class="btn btn-success" href="logout.php">Close</a>
    </h1>
  </div>

  <script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>

</body>
</html>
