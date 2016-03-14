<?php
  include_once 'backend/init.php';
  include_once 'backend/functions.php';
  sec_session_start();
	if(login_check($mysqli) == true){
   $logged = 'in';
  }else{
   $logged = 'out';
  }
  if(isset($_SESSION['email'])) {
		$user = $_SESSION['email'];
	}else{
    header('Location:login.php');
    exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="">

    <title>360 Cope</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    <link href="css/bootstrap-switch.css" rel="stylesheet" />
    <link href="assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    <link href="assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
  </head>
  <body>
  
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <h4 class="msg"></h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="modalTittle">Modal Tittle</h4>
            </div>
            <div class="modal-body" id="modalBody"></div>
            <div class="modal-footer" id="modalFooter">
            </div>
        </div>
    </div>
  </div>

  <section id="container" >
    <header class="header white-bg">
      <div class="sidebar-toggle-box">
        <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
      </div>
      <a href="index.php" class="logo">360<span>Copé</span></a>
		<div class="top-nav ">
        <ul class="nav pull-right top-menu">
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img alt="" src="img/avatar1_small.jpg">
              <span class="username"><?php echo $_SESSION['name'] ?></span>
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
              <li><a href="profile.php"><i class=" icon-suitcase"></i>Profile</a></li>
              <li><a href="logout.php"><i class="icon-key"></i> Log Out</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </header>
    <aside>
      <div id="sidebar"  class="nav-collapse ">
        <ul class="sidebar-menu" id="nav-accordion">
          <li>
            <a href="index.php">
              <i class="icon-laptop"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <?php if($_SESSION['isAdmin'] != 1){ ?>
            <li class="sub-menu">
              <a href="javascript:;" >
                <i class="icon-sitemap"></i>
                <span>My Account</span>
              </a>
              <ul class="sub">
                <li><a  href="listAprons.php">Apron Inventory</a></li>
                <li><a  href="multipleInspection.php">Multiple Inspection</a></li>
                <li><a  href="addApron.php">Add New Apron</a></li>
                <li><a  href="importApron.php">Import Multiple Aprons</a></li>
                <li><a  href="replaceApron.php">Replace Aprons</a></li>
              </ul>
            </li>
            <li class="sub-menu">
              <a href="javascript:;" >
                <i class="icon-barcode"></i>
                <span>Barcodes</span>
              </a>
              <ul class="sub">
                <li><a  href="listBarcode.php">Single Barcode</a></li>
                <li><a  href="barcode.php">Bulk Barcodes</a></li>
              </ul>
            </li>
		  <li class="sub-menu">
			<a  href="javascript:;">
			  <i class=" icon-bar-chart"></i>
			  <span>Reports</span>
			</a>
			<ul class="sub">
			  <li><a  href="fullAprons.php">Full Apron Inventory</a></li>
			  <li><a  href="inserviceAprons.php">In Service Aprons</a></li>
			  <li><a  href="damagedAprons.php">Damaged Aprons</a></li>
			  <li><a  href="missingAprons.php">Missing Aprons</a></li>
			  <li><a  href="replacingAprons.php">Replacing Aprons</a></li>
			  <li><a  href="oosAprons.php">Discontinued Aprons</a></li>
			</ul>
		  </li>
          <?php } ?>
          <?php if($_SESSION['isAdmin'] == 1){ ?>
			  <li>
          <a href="barcode2.php">
            <i class="icon-barcode"></i>
            <span>Barcodes</span>
          </a>
        </li>
        <li class="sub-menu">
				<a  href="javascript:;">
				  <i class=" icon-bar-chart"></i>
				  <span>Reports</span>
				</a>
				<ul class="sub">
				  <li><a  href="fullAprons2.php">Full Apron Inventory</a></li>
				  <li><a  href="inserviceAprons2.php">In Service Aprons</a></li>
				  <li><a  href="damagedAprons2.php">Damaged Aprons</a></li>
				  <li><a  href="missingAprons2.php">Missing Aprons</a></li>
				  <li><a  href="replacingAprons2.php">Replacing Aprons</a></li>
				  <li><a  href="oosAprons2.php">Discontinued Aprons</a></li>
				</ul>
			  </li>
			  <li>
				<a  href="users.php">
				  <i class=" icon-sitemap"></i>
				  <span>Users</span>
				</a>
			  </li>
          <?php } ?>
            <li class="sub-menu">
              <a href="javascript:;" >
                <i class="icon-cogs"></i>
                <span>Configuration</span>
              </a>
              <ul class="sub">
                <li><a  href="listCore.php">Core Materials</a></li>
                <li><a  href="listGarment.php">Garment</a></li>
                <li><a  href="listManufacturer.php">Manufacturer</a></li>
              </ul>
            </li>
            <?php if($_SESSION['isAdmin'] != 1){ ?>
              <li>
                <a href="packages.php">
                  <i class="icon-tasks"></i>
                  <span>Packages</span>
                </a>
              </li>
              <li>
                <a href="faq.php">
                  <i class="icon-copy"></i>
                  <span>FAQ</span>
                </a>
              </li>
              <li>
                <a href="contact.php">
                  <i class="icon-comments"></i>
                  <span>Contact</span>
                </a>
              </li>
              <li>
                <a href="IntelliTrack.pdf" >
                  <i class="icon-book"></i>
                  <span>Brochure</span>
                </a>
              </li>
            <?php } ?>
        </ul>
        <footer class="site-footer">
          <div class="text-center">
            2014 &copy; 360Cope
          </div>
        </footer> 
      </div>
    </aside>
    <section id="main-content">
      <section class="wrapper">