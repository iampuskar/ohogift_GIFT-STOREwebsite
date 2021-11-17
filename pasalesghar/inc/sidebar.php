 <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Pasale's Ghar</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo ADMIN_IMAGES_URL;  ?>puca.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $_SESSION['full_name'] ?></h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->    

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="dashboard">Dashboard</a></li>
                       <li><a href="banner">Banner</a></li>
                        <li><a href="aboutus">About us</a></li>
                         <li><a href="faq">FAQ</a></li>
                          <li><a href="ppolicy">Privacy Policy</a></li>
                    </ul>
                  </li>
                   <li><a><i class="fa fa-list"></i> Category <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="category">Category</a></li>
                    </ul>
                  </li>

                   <li><a><i class="fa fa-shopping-basket"></i> Product <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="product">Product List / Add</a></li>
                      
                    </ul>
                  </li>


                   <li><a><i class="fa fa-users"></i> User<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="user">User</a></li>
                    </ul>
                  </li>

                   <li><a><i class="fa fa-shopping-cart"></i> Order<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="order">order</a></li>
                    </ul>
                  </li>

                   <li><a><i class="fa fa-dollar"></i> Advertisement <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="advertisement">Advertisement</a></li>
                    </ul>
                  </li>

                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo ADMIN_IMAGES_URL; ?>puca.jpg" alt=""><?php echo $_SESSION['full_name'] ?>
                    <span class=" fa fa-angle-down"></span>
                  </a> 
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->