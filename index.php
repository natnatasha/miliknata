<?php 
    include "controller.php"; 
    
    $myFunction = new CRUD();
    session_start();
    
    if(isset($_POST['getLogin'])){
        $username = strtolower(htmlspecialchars($_POST['username']));
        $password = htmlspecialchars($_POST['password']);
        $response = $myFunction->login($username,$password);
        if ($response['response'] == "positive") {
          $_SESSION['username']  = $username;
          $_SESSION['user_role'] = $response['user_role'];
          
            if ($response['user_role'] == "Kesiswaan") {
              header("Location:pagekesiswaan.php");
            }else if($response['user_role'] == "Pembimbing"){
              $_SESSION['rayon'] = $response['rayon'];
              header("Location:pagepembimbing.php");
            }
        }else{ ?>
            <script>
              alert("<?php echo $response['alert'] ?>");
            </script>
        <?php } 
    }
   ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login</title>
  </head>
  <body>
    <style>
    body{
      background-color: #f1c40f !important;
    }
      .material-half-bg .cover{
        background-color: #34495e !important;
      }
    .btn-primary{
      background-color: #f39c12 !important;
      border: none;
    }
    .form-control:focus{
      border-color: #f39c12;
    }
    </style>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="login-box">
        <form class="login-form" method="post">
          <h2 class="login-head"><i>ABSENSIKU</i></h2>
          <div class="form-group">
            <label class="control-label">USERNAME</label>
            <input class="form-control" type="text" name="username" placeholder="Masukkan Username" autocomplete="off" autofocus>
          </div>
          <div class="form-group">
            <label class="control-label">PASSWORD</label>
            <input class="form-control" type="password" name="password" placeholder="Masukkan Password">
          </div>
          <div class="form-group btn-container">
            <button style="margin-top: 30px;" class="btn btn-primary btn-block" name="getLogin"><i class="fa fa-sign-in fa-lg fa-fw"></i>LOGIN</button>
          </div>
        </form>
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
    </script>
  </body>
</html>