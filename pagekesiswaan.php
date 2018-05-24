<?php  
      error_reporting(0);
      include "controller.php";
      $function = new CRUD();
      session_start();
      $sesAuth = $function->selectWhere("tb_user","username",$_SESSION['username']);

      if ($function->sessionCheck() == "false") {
        header("Location:index.php");
      }

      if($_SESSION['user_role'] != "Kesiswaan"){
        header('Location:index.php');
      }

      if (isset($_GET['logout'])) {
        $function->logout();
      }
?>
<style>
  .app-header{
    background-color: #34495e !important;
  }
  .app-header__logo{
    background-color: #f39c12 !important;
  }
  .app-sidebar__toggle:hover{
     background-color: #f39c12 !important;
  }
  .app-sidebar__toggle{
     background-color: #34495e !important;
  }
</style>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>CBT PRODUKTIF</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/jquery-3.2.1.min.js"></script>
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.html">ABSENSIKU</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav ">
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="?page=admin"><i class="fa fa-cog fa-lg"></i>Kelola Admin</a></li>
            <li><a class="dropdown-item" href="?logout"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay"  data-toggle="sidebar"></div>
    <aside class="app-sidebar"  style="background-color: #34495e !important; ">
      <div class="app-sidebar__user">
        <div>
          <p class="app-sidebar__user-name"><?= $sesAuth['nama'] ?></p>
          <p class="app-sidebar__user-designation"><?= $sesAuth['user_role'] ?></p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item " href="pagekesiswaan.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Data Input</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="?page=rayon"><i class="icon fa fa-circle-o"></i>Rayon</a></li>
            <li><a class="treeview-item" href="?page=rombel"><i class="icon fa fa-circle-o"></i>Rombel</a></li>
            <li><a class="treeview-item" href="?page=siswa"><i class="icon fa fa-circle-o"></i>Siswa</a></li>
            <li><a class="treeview-item" href="?page=repush"><i class="icon fa fa-circle-o"></i>Reward & Punishment</a></li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Absensi</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
              <li><a class="treeview-item" href="?page=absensi"><i class="icon fa fa-circle-o"></i>Input Absensi</a></li>
              <li><a class="treeview-item" href="?page=ubahabsensi"><i class="icon fa fa-circle-o"></i>Ubah Absensi</a></li>
              <li><a class="treeview-item" href="?page=absenrayon"><i class="icon fa fa-circle-o"></i>Absensi Per-Rayon</a></li>
              <li><a class="treeview-item" href="?page=absenrombel"><i class="icon fa fa-circle-o"></i>Absensi Per-Rombel</a></li>
              <li><a class="treeview-item" href="?page=absenperiode"><i class="icon fa fa-circle-o"></i>Absensi Periode Rombel</a></li>
              <li><a class="treeview-item" href="?page=periodeabsen"><i class="icon fa fa-circle-o"></i>Absensi Periode Rayon</a></li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">BKP</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
              <li><a class="treeview-item" href="?page=bkp"><i class="icon fa fa-circle-o"></i>Input BKP</a></li>
              <li><a class="treeview-item" href="?page=hapusbkp"><i class="icon fa fa-circle-o"></i>Hapus BKP</a></li>
              <li><a class="treeview-item" href="?page=bkprayon"><i class="icon fa fa-circle-o"></i>BKP Per-Rayon</a></li>
              <li><a class="treeview-item" href="?page=bkprombel"><i class="icon fa fa-circle-o"></i>BKP Per-Rombel</a></li>
              <li><a class="treeview-item" href="?page=bkpperiode"><i class="icon fa fa-circle-o"></i>BKP Periode Rayon</a></li>
              <li><a class="treeview-item" href="?page=periode"><i class="icon fa fa-circle-o"></i>BKP Periode Rombel</a></li>
              <li><a class="treeview-item" href="?page=siswasp"><i class="icon fa fa-circle-o"></i>Siswa SP</a></li>
          </ul>
        </li>
      </ul>
    </aside>
    <main class="app-content">
      <?php 
        @$page = $_GET['page'];
        switch ($page) {
          case 'siswa':
            include "siswa.php";
          break;
          case 'rayon':
            include "rayon.php";
          break;
          case 'rombel':
            include "rombel.php";
          break;
          case 'repush':
            include "repush.php";
          break;
          case 'absensi':
            include "absensi.php";
          break;
          case 'ubahabsensi':
            include "ubahabsensi.php";
          break;
          case 'bkp':
            include "bkp.php";
          break;
          case 'hapusbkp':
            include "hapusbkp.php";
          break;
          case 'absenrayon':
            include "absenrayon.php";
          break;
          case 'absenrombel':
            include "absenrombel.php";
          break;
          case 'absenperiode':
            include "absenperiode.php";
          break;
          case 'periodeabsen':
            include "periodeabsen.php";
          break;
          case 'bkprayon':
            include "bkprayon.php";
          break;
          case 'bkprombel':
            include "bkprombel.php";
          break;
          case 'bkpperiode':
            include "bkpperiode.php";
          break;
          case 'periode':
            include "periode.php";
          break;
          case 'siswasp':
            include "siswasp.php";
          break;
          case 'profil':
            include "profil.php";
          break;
          case 'admin':
            include "keloladmin.php";
          break;
          case 'detail':
            include "detailabsen.php";
          break;
          case 'detailr':
            include 'detailabsenr.php';
          break;
          case 'detailp':
            include "detailabsenp.php";
          break;
          case 'detil':
            include "detailbkp.php";
          break;
          case 'detilr':
            include "detailbkpr.php";
          break;
          case 'detilp':
            include "detailbkpp.php";
          break;
          case 'cetaksp':
            include "cetaksp.php";
          break;
          default:
            include "dashboardkesiswaan.php";
          break;
        }
       ?>
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="js/plugins/chart.js"></script>
    <script type="text/javascript" src="js/plugins/sweetalert.min.js"></script>
    <?php include 'alerts_response.php'; ?>
    <script type="text/javascript">
      var data = {
      	labels: ["January", "February", "March", "April", "May"],
      	datasets: [
      		{
      			label: "My First dataset",
      			fillColor: "rgba(220,220,220,0.2)",
      			strokeColor: "rgba(220,220,220,1)",
      			pointColor: "rgba(220,220,220,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(220,220,220,1)",
      			data: [65, 59, 80, 81, 56]
      		},
      		{
      			label: "My Second dataset",
      			fillColor: "rgba(151,187,205,0.2)",
      			strokeColor: "rgba(151,187,205,1)",
      			pointColor: "rgba(151,187,205,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(151,187,205,1)",
      			data: [28, 48, 40, 19, 86]
      		}
      	]
      };
      var pdata = [
      	{
      		value: 300,
      		color: "#46BFBD",
      		highlight: "#5AD3D1",
      		label: "Complete"
      	},
      	{
      		value: 50,
      		color:"#F7464A",
      		highlight: "#FF5A5E",
      		label: "In-Progress"
      	}
      ]
      
      var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      var lineChart = new Chart(ctxl).Line(data);
      
      var ctxp = $("#pieChartDemo").get(0).getContext("2d");
      var pieChart = new Chart(ctxp).Pie(pdata);
    </script>
     <script type="text/javascript" src="js/plugins/bootstrap-datepicker.min.js"></script>
 <script type="text/javascript" src="js/plugins/select2.min.js"></script>
 <script type="text/javascript" src="js/plugins/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
      $('#sl').click(function(){
        $('#tl').loadingBtn();
        $('#tb').loadingBtn({ text : "Signing In"});
      });
      
      $('#el').click(function(){
        $('#tl').loadingBtnComplete();
        $('#tb').loadingBtnComplete({ html : "Sign In"});
      });
      
      $('#demoDate').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        todayHighlight: true
      });

      $('#demoDate1').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        todayHighlight: true
      });

      $('#tglhr').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        todayHighlight: true
      });
      
      $('#demoSelect').select2();
 </script>
 <!-- Data table plugin-->
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
      $('#sampleTable').DataTable();
      $('#sampleTable1').DataTable();
      $('#sampleTable2').DataTable();
    </script>
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
    </script>
  </body>
</html>