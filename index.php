<!doctype html>
<html lang="en">
<?php 
  if(!isset($_SESSION)){
    session_start();
  }
  include('components/header.php');
?>

<body>
  <!-- app-header header-shadow bg-deep-blue header-text-dark -->
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    <?php 
      if($_GET['mod'] != 'login') {
        include('components/navbar.php'); 
      }
      
    ?>    
     <div class="app-main">
      <?php 
        if($_GET['mod'] != 'login') {
          // include('components/navbar.php'); 
          include('components/sidebar.php'); 
        }
      ?>
          <div class="app-main__outer">
          <?php 
            if ($_GET['mod'] == 'schooldata'):
              include 'modules/schooldata.php';
            elseif ($_GET['mod'] == 'schoolsmall'):
              include 'modules/schoolsmall.php';
            elseif ($_GET['mod'] == 'login'):
              include 'view/login.php';
            elseif ($_GET['mod'] == 'logout'):
              include 'view/logout.php';
            elseif ($_GET['mod'] == 'initialize'):
              include 'view/initialize.php';
            else:
              include 'view/default.php';
            endif;
          ?>
            <?php 
            if($_GET['mod'] != 'login') {
              // include('components/navbar.php'); 
              include('components/footer.php');
            }
            ?>
              </div>
        </div>
    </div>
<script type="text/javascript" src="./assets/scripts/main.js"></script></body>
</html>
