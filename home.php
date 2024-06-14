<?php include('db_connect.php') ?>

<?php
$twhere ="";
if($_SESSION['login_type'] != 1 )
  $twhere = "  ";
?>
<!-- Info boxes -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- Header Section -->
            <header class="py-4">
                <h3 class="text-center">Welcome <?php echo $_SESSION['login_name']; ?>!</h3>
                <!-- Display the message and the date -->
                <h4 class="text-center">Upcoming Event:</h4>
                <div class="text-center">
                    <?php
                    $current_date = date('Y-m-d H:i:s');
                    $result = $conn->query("SELECT * FROM schedule_list WHERE start_datetime > '$current_date' ORDER BY start_datetime ASC LIMIT 1");
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo "<h5><strong>Title:</strong> " . $row['title'] . " - <strong>Date:</strong> " . date('F d, Y h:i A', strtotime($row['start_datetime'])) . "</h5>";
                    } else {
                        echo "<p>No upcoming events found.</p>";
                    }
                    ?>
                </div>

            </header>
            <!-- End of Header Section -->

            <!-- Rest of your page content goes here -->
            <!-- Include your existing content here -->
        </div>
        
    </div>
</div>
<hr>
<?php 

    $where = "";
    if($_SESSION['login_type'] == 1 || $_SESSION['login_type'] == 2){
      $where = ""; // Show all projects for types 1 and 2
    }elseif($_SESSION['login_type'] == 3){
      // Show only projects where the employee is involved
      $where = " WHERE CONCAT('[',REPLACE(user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
    }
?>
        
<div class="row">
    <div class="col-md-8">
        <div class="card card-outline card-success">
            <div class="card-header">
                <b>Project Progress</b>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0 table-hover">
                        <colgroup>
                            <col width="5%">
                            <col width="30%">
                            <col width="35%">
                            <col width="15%">
                            <col width="15%">
                        </colgroup>
                        <thead>
                            <th>#</th>
                            <th>Project</th>
                            <th>Progress</th>
                            <th>Status</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php
                            $stat = array("Pending", "Started", "On-Progress", "On-Progress", "On-Progress", "Done");
                            $where = "";
                            if ($_SESSION['login_type'] == 1 || $_SESSION['login_type'] == 2) {
                                $where = ""; // Show all projects for types 1 and 2
                            } elseif ($_SESSION['login_type'] == 3) {
                                // Show only projects where the employee is involved
                                $where = " WHERE CONCAT('[',REPLACE(user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
                            }
                            $qry = $conn->query("SELECT * FROM project_list $where order by name asc");
                            $i = 0;
                            while ($row = $qry->fetch_assoc()) :
                                $i++;
                                $prog = 0;
                                $tprog = $conn->query("SELECT * FROM task_list where project_id = {$row['id']}")->num_rows;
                                $cprog = $conn->query("SELECT * FROM task_list where project_id = {$row['id']} and status = 3")->num_rows;
                                $prog = $tprog > 0 ? ($cprog / $tprog) * 100 : 0;
                                $prog = $prog > 0 ? number_format($prog, 2) : $prog;
                                $prod = $conn->query("SELECT * FROM user_productivity where project_id = {$row['id']}")->num_rows;
                                // Determine status based on progress
                                if ($prog >= 0 && $prog < 50) {
                                    $row['status'] = 1; // Started
                                } elseif ($prog >= 50 && $prog < 90) {
                                    $row['status'] = 2; // On-Progress
                                } elseif ($prog >= 90 && $prog <= 100) {
                                    $row['status'] = 5; // Done
                                }
                                if ($row['status'] == 0 && strtotime(date('Y-m-d')) >= strtotime($row['start_date'])) :
                                    if ($prod > 0  || $cprog > 0)
                                        $row['status'] = 2;
                                    else
                                        $row['status'] = 1;
                                elseif ($row['status'] == 0 && strtotime(date('Y-m-d')) > strtotime($row['end_date'])) :
                                    $row['status'] = 4;
                                endif;
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td>
                                        <a><?php echo ucwords($row['name']); ?></a><br>
                                        <small>Due: <?php echo date("Y-m-d", strtotime($row['end_date'])); ?></small>
                                    </td>
                                    <td class="project_progress">
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="<?php echo $prog; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prog; ?>%">
                                            </div>
                                        </div>
                                        <small><?php echo $prog; ?>% Complete</small>
                                    </td>
                                    <td class="project-state">
                                    <?php
                                    if($stat[$row['status']] =='Pending'){
                                        echo "<span class='badge badge-secondary'>{$stat[$row['status']]}</span>";
                                    } elseif($stat[$row['status']] =='Started'){
                                        echo "<span class='badge badge-primary'>{$stat[$row['status']]}</span>";
                                    } elseif($stat[$row['status']] =='On-Progress'){
                                        echo "<span class='badge badge-info'>{$stat[$row['status']]}</span>";
                                    } elseif($stat[$row['status']] =='Done'){
                                        echo "<span class='badge badge-success'>{$stat[$row['status']]}</span>";
                                    }
                                    ?>
                                    </td>
                                    <td>
                                        <a class='btn btn-primary btn-sm' href='./index.php?page=view_project&id=<?php echo $row['id']; ?>'><i class='fas fa-folder'></i> View</a>
                                   
</td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


        <div class="col-md-4">
          <div class="row">
          <div class="col-12 col-sm-6 col-md-12">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <?php
              $total_incomplete_projects = 0;

              // Loop through projects to count incomplete projects
              $qry = $conn->query("SELECT * FROM project_list $where ORDER BY name ASC");
              while ($row = $qry->fetch_assoc()) {
                  // Calculate progress for the current project
                  $total_tasks = $conn->query("SELECT COUNT(*) as total_tasks FROM task_list WHERE project_id = {$row['id']}")->fetch_assoc()['total_tasks'];
                  $completed_tasks = $conn->query("SELECT COUNT(*) as completed_tasks FROM task_list WHERE project_id = {$row['id']} AND status = 3")->fetch_assoc()['completed_tasks'];
                  
                  // Calculate progress percentage
                  $progress = $total_tasks > 0 ? ($completed_tasks / $total_tasks) * 100 : 0;
              
                  // If progress is less than 100%, increment the total count of incomplete projects
                  if ($progress < 100) {
                      $total_incomplete_projects++;
                  }
              }
              ?>

<!-- Display average progress -->


                <h3><?php echo $total_incomplete_projects;  ?> </h3>
                <p>Pojects On Going</p>
              </div>
              <div class="icon">
              <i class="fa fa-hourglass-half"></i>
              </div>
            </div>
          </div>



          <div class="col-12 col-sm-6 col-md-12">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <?php
              $total_projects = 0;

// Loop through projects to count completed projects
$qry = $conn->query("SELECT * FROM project_list $where ORDER BY name ASC");
while ($row = $qry->fetch_assoc()) {
    // Calculate progress for the current project
    $total_tasks = $conn->query("SELECT COUNT(*) as total_tasks FROM task_list WHERE project_id = {$row['id']}")->fetch_assoc()['total_tasks'];
    $completed_tasks = $conn->query("SELECT COUNT(*) as completed_tasks FROM task_list WHERE project_id = {$row['id']} AND status = 3")->fetch_assoc()['completed_tasks'];
    
    // Calculate progress percentage
    $progress = $total_tasks > 0 ? ($completed_tasks / $total_tasks) * 100 : 0;

    // If progress is 100%, increment the total count of completed projects
    if ($progress == 100) {
        $total_projects++;
    }
}
?>


<!-- Display average progress -->


                <h3><?php echo $total_projects;  ?> </h3>
                <p>Pojects Completed</p>
              </div>
              <div class="icon">
              <i class="fa fa-clipboard-check"></i>
              </div>
            </div>
          </div>




          <div class="col-12 col-sm-6 col-md-12">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM project_list $where")->num_rows; ?> </h3>    
                      
                <p>Total Projects</p>
              </div>
              <div class="icon">
                <i class="fa fa-layer-group"></i>
              </div>
            </div>
          </div>
           
          
      
      
          
      </div>
        </div>
      </div>
    </div>
  </div>
