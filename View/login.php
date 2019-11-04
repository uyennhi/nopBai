<?php
    session_start();
    include_once("../model/entity/user.php");
    $information="";
    if(isset($_SESSION['user']))
     header("location:index.php");
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $username = $_REQUEST["username"];
        $password = $_REQUEST["password"];
        $user = User::authentication($username,$password);
        if($user == null)
        {
            $information="Tên đăng nhập hoặc mật khẩu không đúng";
        }
        else{
            $_SESSION["user"] = $username;
            header("location:index.php");
        }
    }
?>
<!DOCTYPE html>
<html>

<!-- Head -->
<head>

<title>Existing Login Form a Flat Responsive Widget Template :: W3layouts</title>

<!-- Meta-Tags -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="Existing Login Form Widget Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //Meta-Tags -->

<link href="../css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />

<!-- Style --> <link rel="stylesheet" href="../css/style.css" type="text/css" media="all">

<!-- Fonts -->
<link href="//fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
<!-- //Fonts -->

</head>
<!-- //Head -->

<!-- Body -->
<body>

  <h1>LOGIN FORM</h1>

  <div class="w3layoutscontaineragileits">
  <h2>Login here</h2>
    <form action="#" method="post">
      <input type="email" placeholder="EMAIL" name="username" required="">
      <input type="password"  placeholder="PASSWORD" name="password" required="">
      <ul class="agileinfotickwthree">
        <li>
          <input type="checkbox" id="brand1" value="">
          <label for="brand1"><span></span>Remember me</label>
          <a href="#">Forgot password?</a>
        </li>
      </ul>
     <div class="aitssendbuttonw3ls">
        <input type="submit" value="LOGIN">
          <?php if(strlen($information)!=0){?>
            <div class="alert alert-danger">
              <?php echo $information ?>
            </div>
            <?php } ?>
      </div>
    </form>
  </div>
  
  
  <div class="w3footeragile">
    <p> &copy; 2017 Existing Login Form. All Rights Reserved | Design by <a href="http://w3layouts.com" target="_blank">W3layouts</a></p>
  </div>

  
  <script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>

  <!-- pop-up-box-js-file -->  
    <script src="../js/jquery.magnific-popup.js" type="text/javascript"></script>
  <!--//pop-up-box-js-file -->
  <script>
    $(document).ready(function() {
    $('.w3_play_icon,.w3_play_icon1,.w3_play_icon2').magnificPopup({
      type: 'inline',
      fixedContentPos: false,
      fixedBgPos: true,
      overflowY: 'auto',
      closeBtnInside: true,
      preloader: false,
      midClick: true,
      removalDelay: 300,
      mainClass: 'my-mfp-zoom-in'
    });
                                    
    });
  </script>

</body>
<!-- //Body -->

</html>
