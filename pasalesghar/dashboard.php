<?php 
error_reporting(E_ALL);
$page_title="Dashboard";
require 'inc/top-link.php';
//debugger($_SESSION, true);
if(!isset($_SESSION,$_SESSION['session_id']) || empty($_SESSION['session_id']) || empty($_SESSION['full_name'])){
  redirect('index','error','Please login first.');
} 
//debugger($_SESSION, true);
?>



    <div class="container body">
      <div class="main_container">
      <?php require 'inc/sidebar.php'; ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Plain Page</h3>
                <?php flash(); ?>
              </div>

              <div class="title_right">
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Plain Page</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      Add content to the page ...
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            &copy;<?php echo date('Y') ?> All rights Reserved.
           Powered by Pasale Admin
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

   <?php require 'inc/footer.php'; ?>



