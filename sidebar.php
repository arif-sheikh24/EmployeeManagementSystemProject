  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="dropdown">
   	<a href="./" class="brand-link">
        
      <img src="image/logo1.png" class="logo" alt="logo" style="max-width: 200px;
        width: 180px;
	      max-height: 30px;
        height: 100px;
        padding-left: 30px;" >

    </a>
      
    </div>
    <div class="sidebar pb-4 mb-4">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item dropdown">
            <a href="./" class="nav-link nav-home">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          
          <?php if($_SESSION['login_type'] == 1): ?>
          <li class="nav-item">
            <a href="./index.php?page=calender" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Calendar
              </p>
            </a>
          </li>
        <?php endif; ?>
        <?php if($_SESSION['login_type'] == 2): ?>
          <li class="nav-item">
            <a href="./index.php?page=calender" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Calendar
              </p>
            </a>
          </li>
        <?php endif; ?>

        <?php if($_SESSION['login_type'] == 3): ?>
          <li class="nav-item">
            <a href="./index.php?page=My_Profile" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                My Profile
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./index.php?page=employeecalender" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Calendar
              </p>
            </a>
          </li>
          
        <?php endif; ?>
        <li class="nav-item">
            <a href="#" class="nav-link nav-edit_project nav-view_project">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>
                Projects
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php if($_SESSION['login_type'] != 3): ?>
              <li class="nav-item">
                <a href="./index.php?page=new_project" class="nav-link nav-new_project tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
            <?php endif; ?>
              <li class="nav-item">
                <a href="./index.php?page=project_list" class="nav-link nav-project_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li> 

        <?php if($_SESSION['login_type'] == 3): ?>
          <li class="nav-item">
            <a href="./index.php?page=attendence" class="nav-link nav-attendence">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Attendence
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="./index.php?page=attendence" class="nav-link nav-attendence tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add Attandence</p>
                </a>
              </li>
            <li class="nav-item">
                <a href="./index.php?page=attendancereport" class="nav-link nav-attendancereport tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Attandence Report</p>
                </a>
              </li>
            </ul>
          </li>
        <?php endif; ?>
        <?php if($_SESSION['login_type'] == 2): ?>
          <li class="nav-item">
            <a href="./index.php?page=attendence" class="nav-link nav-attendence">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Attendence
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="./index.php?page=attendence" class="nav-link nav-attendence tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add Attandence</p>
                </a>
              </li>
            <li class="nav-item">
                <a href="./index.php?page=attendancereport" class="nav-link nav-attendancereport tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Attandence Report</p>
                </a>
              </li>
            </ul>
          </li>
        <?php endif; ?>

          
          
           

          <?php if($_SESSION['login_type'] == 1): ?>
          <li class="nav-item">
            <a href="./index.php?page=leavedashboard" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Leave Management
              </p>
            </a>
          </li>
        <?php endif; ?>
        <?php if($_SESSION['login_type'] == 2): ?>
          <li class="nav-item">
            <a href="./index.php?page=leavedashboard" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Leave Management
              </p>
            </a>
          </li>
        <?php endif; ?>

        <?php if($_SESSION['login_type'] == 3): ?>
          <li class="nav-item">
            <a href="./index.php?page=leave" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Leave 
              </p>
            </a>
          </li>
        <?php endif; ?>

        <?php if($_SESSION['login_type'] == 1): ?>
          <li class="nav-item">
            <a href="./index.php?page=shift" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Shift
              </p>
            </a>
          </li>
        <?php endif; ?>
        <?php if($_SESSION['login_type'] == 1): ?>
          <li class="nav-item">
            <a href="./index.php?page=departments" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Department
              </p>
            </a>
          </li>
        <?php endif; ?>
        <?php if($_SESSION['login_type'] == 1): ?>
          <li class="nav-item">
            <a href="./index.php?page=location" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Location
              </p>
            </a>
          </li>
        <?php endif; ?>

         
          <?php if($_SESSION['login_type'] == 1): ?>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=new_user" class="nav-link nav-new_user tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=user_list" class="nav-link nav-user_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>
        <?php endif; ?>
        
        <?php if($_SESSION['login_type'] != 3): ?>
          <li class="nav-item">
            <a href="#" class="nav-link nav-report">
            <i class="fas fa-th-list nav-icon"></i>
              <p>
                Reports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=reports" class="nav-link nav-reports tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Project Reports</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=report" class="nav-link nav-report tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Attendence Reports</p>
                </a>
              </li>
            </ul>
          </li>
           
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </aside>
  <script>
  	$(document).ready(function(){
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
  		var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
      if(s!='')
        page = page+'_'+s;
  		if($('.nav-link.nav-'+page).length > 0){
             $('.nav-link.nav-'+page).addClass('active')
  			if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
            $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
  				$('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
  			}
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

  		}
     
  	})
  </script>