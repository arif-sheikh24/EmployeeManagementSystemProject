<?php 
	include('inc/head.php'); 
	
	if (isset($_SESSION['login_email'])) {
		
	}
	
?>
<?php 
	
	if(isset($_POST['submit'])){
		$user = $_POST['email'];
		$password = $_POST['password'];

		$password = md5($_POST['password']);

		include 'inc/config.php';

		$sql = "SELECT * FROM users WHERE email = '$user' AND password = '$password'";

		$run = mysqli_query($con,$sql);
		$check = mysqli_num_rows($run);

		if($check == 1){
			session_start();
			$_SESSION['email'] = $user; 
			echo "<script> 
					window.open('','_self');
				  </script>";
		}else{
			echo "<script> 
			alert('Email or Password Invaild');
			window.open('index.php','_self');
			</script>";
		}
	}

 ?>
<body>
	

	<section id="sections" class="py-4 mb-4 bg-faded">
		<div class="container">
			<div class="row">
				<div class="col-md"></div>
				<div class="col-md-2">
					<a href="#" class="btn btn-warning btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#addPostModal"><i class="fa fa-spinner"></i> Pending Leaves</a>
				</div>
				<div class="col-md-2">
					<a href="#" class="btn btn-success btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#addCateModal"><i class="fa fa-check"></i> Approved</a>
				</div>
				<div class="col-md-2">
					<a href="#" class="btn btn-danger btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#addUsertModal"><i class="fa fa-xmark"></i> Rejected</a>
				</div>
				
				<div class="col-md"></div>
			</div>
		</div>
	
	</section>
	
	<!----Section2 for showing Post Model ---->
	<!-- Section2 for showing Post Model -->
<!-- Section2 for showing Post Model -->
<section id="post">
    <div class="container">
        <div class="row">
            <table class="table table-bordered table-hover table-striped">
			<colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="20%">
                    <col width="14%">
                    <col width="10%">
                    <col width="10%">
                    <col width="5%">
					<col width="35%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead class="text-left">
                    <th>#</th>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Leave Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Days</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Action</th> <!-- Add Action column -->
                </thead>
                <tbody>
                    <?php 
                        $sql = "SELECT * FROM leaves ORDER BY id DESC";
                        $que = mysqli_query($con,$sql);
                        $cnt = 1;
                        while ($result = mysqli_fetch_assoc($que)) {
                            $start_date = new DateTime($result['leavedate']);
                            $end_date = new DateTime($result['leaveedate']);
                            $interval = $start_date->diff($end_date);
                            $total_days = $interval->days + 1; // Add 1 to include both start and end dates
                    ?>
					
                    <tr>
                        <td><?php echo $cnt;?></td>
                        <td><?php echo $result['username']; ?></td>
                        <td><?php echo $result['name']; ?></td>
                        <td><?php echo $result['department']; ?></td>
                        <td><?php echo $result['leavedate']; ?></td>
                        <td><?php echo $result['leaveedate']; ?></td>
                        <td><?php echo $total_days; ?></td>
                        <td><?php echo $result['leavereason']; ?></td>
                        <td>
                            <?php 
                                if ($result['status'] == 0) {
                                    echo "<span class='badge badge-warning'>Pending</span>";
                                } elseif($result['status'] == 1) {
                                    echo "<span class='badge badge-success'>Approved</span>";
                                } else {
                                    echo "<span class='badge badge-danger'>Rejected</span>";
                                }
                            ?>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#updateStatusModal<?php echo $result['id']; ?>">Update Status</button>
                            <!-- Modal -->
                            <div class="modal fade" id="updateStatusModal<?php echo $result['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateStatusLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateStatusLabel">Update Status</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="update_status.php" method="POST">
                                                <input type="hidden" name="leave_id" value="<?php echo $result['id']; ?>">
                                                <div class="form-group">
                                                    <label for="status">Select Status:</label>
                                                    <select class="form-control" id="status" name="status">
                                                        
                                                        <option value="1">Approved</option>
                                                        <option value="2">Rejected</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                            $cnt++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	
	
	<!-- Creating Modal -->
    <!-- Header Post -->
	<div class="modal fade" id="addPostModal">
		<div class="modal-dialog modal-lg" style="max-width: 850px;">
			<div class="modal-content">
				<div class="modal-header bg-warning text-white">
					<div class="modal-title">
						<h5>Pending</h5>
					</div>
					<button class="close" data-dismiss="modal"><span>&times;</span></button>
				</div>
				<div class="modal-body">
				<table class="table table-bordered table-hover table-striped">
				<colgroup>
                    <col width="5%">
                    <col width="10%">
					<col width="10%">
                    <col width="15%">
                    <col width="16%">
                    <col width="15%">
                    <col width="5%">
                    <col width="10%">
					<col width="10%">
					<col width="10%">
                </colgroup>
							<thead>
								<th>#</th>
								<th>ID</th>
								<th>Name</th>
								<th>Leave Type</th>
								<th>Start Date</th>
                                <th>End Date</th>
								<th>Days</th>
								<th>Reason</th>
								<th>Status</th>
								<th>Action</th>
							</thead>
							 <tbody>
							 	<?php 
									$sql = "SELECT * FROM leaves WHERE status = 0";
									$que = mysqli_query($con,$sql);
									$cnt = 1;
									while ($result = mysqli_fetch_assoc($que)) {
										$start_date = new DateTime($result['leavedate']);
								    $end_date = new DateTime($result['leaveedate']);
								    $interval = $start_date->diff($end_date);
								    $total_days = $interval->days + 1; // Add 1 to include both start and end dates
									?>

									
							 	<tr>
									<td><?php echo $cnt;?></td>
                                    <td><?php echo $result['username']; ?></td>
							 		<td><?php echo $result['name']; ?></td>
							 		<td><?php echo $result['department']; ?></td>
							 		<td><?php echo $result['leavedate']; ?></td>
                                     <td><?php echo $result['leaveedate']; ?></td>
									 <td><?php echo $total_days; ?></td>
							 		<td><?php echo $result['leavereason']; ?></td>
							 		<td>
							 			<?php 
							 			if ($result['status'] == 0) {
							 				echo "Pending";
							 				?>
							 				</td>
							 		<td>
							 			<form action="accept.php?id=<?php echo $result['id']; ?>" method="POST">
							 				<input type="hidden" name="appid" value="<?php echo $result['id']; ?>">
							 				<input type="submit" class="btn btn-sm btn-success" name="approve" value="Approve">
							 			</form>
										 <form action="reject.php?id=<?php echo $result['id']; ?>" method="POST">
    									<input type="hidden" name="appid" value="<?php echo $result['id']; ?>">
    									<input type="submit" class="btn btn-sm btn-danger" name="reject" value="Reject">
										</form>
										
							 		</td>
							 				<?php
							 			}
							 			elseif ($result['status'] == 1){
							 				echo "Approved";
							 			}
										else{
											echo "Rejected";
										}
							 	$cnt++;	}
							 		 ?>
							 	</tr>
								 
							 </tbody>
						</table>
					
				</div>
				
			</form>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="addCateModal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-success text-white">
					<div class="modal-title">
						<h5>Approved Leaves</h5>
					</div>
					<button class="close" data-dismiss="modal"><span>&times;</span></button>
				</div>
				<div class="modal-body">
				<table class="table table-bordered table-hover table-striped">
					
					<colgroup>
                    <col width="5%">
                    <col width="10%">
					<col width="10%">
                    <col width="15%">
                    <col width="16%">
                    <col width="15%">
                    <col width="5%">
                    <col width="10%">
					<col width="10%">
                </colgroup>
							<thead>
								<th>#</th>
								<th>ID</th>
								<th>Name</th>
								<th>Leave Type</th>
								<th>Start Date</th>
                                <th>End Date</th>
								<th>Day</th>
								<th>Reason</th>
								<th>Status</th>
							</thead>
							 <tbody>
							 	<?php 
									$sql = "SELECT * FROM leaves WHERE status = 1";
									$que = mysqli_query($con,$sql);
									$cnt = 1;
									while ($result = mysqli_fetch_assoc($que)) {
										$start_date = new DateTime($result['leavedate']);
								    $end_date = new DateTime($result['leaveedate']);
								    $interval = $start_date->diff($end_date);
								    $total_days = $interval->days + 1; // Add 1 to include both start and end dates
									?>

									
							 	<tr>
									<td><?php echo $cnt;?></td>
                                    <td><?php echo $result['username']; ?></td>
							 		<td><?php echo $result['name']; ?></td>
							 		<td><?php echo $result['department']; ?></td>
							 		<td><?php echo $result['leavedate']; ?></td>
                                    <td><?php echo $result['leaveedate']; ?></td>
									<td><?php echo $total_days; ?></td>
							 		<td><?php echo $result['leavereason']; ?></td>
							 		<td>
							 			<?php 
							 			if ($result['status'] == 0) {
											echo "<span class='badge badge-warning'>Pending</span>";
							 			}
							 			elseif($result['status'] == 1){
											echo "<span class='badge badge-success'>Approved</span>";
							 			}
										else{
											echo "<span class='badge badge-danger'>Rejected</span>";
										}
							 	$cnt++;	}
							 		 ?>
							 		</td>
							 	</tr>

							 </tbody>
						</table>
					
				</div>
			
			</div>
		</div>
	</div>
	
	<!-- User Modal -->
	<div class="modal fade" id="addUsertModal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-danger text-white">
					<div class="modal-title">
						<h5>Rejected</h5>
					</div>
					<button class="close" data-dismiss="modal"><span>&times;</span></button>
				</div>
				<div class="modal-body">
				<table class="table table-bordered table-hover table-striped">
				<colgroup>
                    <col width="5%">
                    <col width="10%">
					<col width="10%">
                    <col width="15%">
                    <col width="16%">
                    <col width="15%">
                    <col width="5%">
                    <col width="10%">
					<col width="10%">
                </colgroup>
							<thead>
								<th>#</th>
								<th>ID</th>
								<th>Name</th>
								<th>Leave Type</th>
								<th>Start Date</th>
                                <th>End Date</th>
								<th>Day</th>
								<th>Reason</th>
								<th>Status</th>
							</thead>
							 <tbody>
							 <?php 
									$sql = "SELECT * FROM leaves WHERE status = 2";
									$que = mysqli_query($con,$sql);
									$cnt = 1;
									while ($result = mysqli_fetch_assoc($que)) {
										$start_date = new DateTime($result['leavedate']);
								    $end_date = new DateTime($result['leaveedate']);
								    $interval = $start_date->diff($end_date);
								    $total_days = $interval->days + 1; // Add 1 to include both start and end dates
									?>

									
							 	<tr>
									 <td><?php echo $cnt;?></td>
                                     <td><?php echo $result['username']; ?></td>
							 		<td><?php echo $result['name']; ?></td>
							 		<td><?php echo $result['department']; ?></td>
							 		<td><?php echo $result['leavedate']; ?></td>
                                     <td><?php echo $result['leaveedate']; ?></td>
									 <td><?php echo $total_days; ?></td>
							 		<td><?php echo $result['leavereason']; ?></td>
							 		<td>
							 			<?php 
							 			if ($result['status'] == 0) {
											echo "<span class='badge badge-warning'>Pending</span>";
							 			}
							 			elseif($result['status'] == 1){
											echo "<span class='badge badge-success'>Approved</span>";
							 			}
										else{
											echo "<span class='badge badge-danger'>Rejected</span>";
										}
							 	$cnt++;	}
							 		 ?>
							 		</td>
							 	</tr>

							 </tbody>
						</table>
				</div>
				
			</div>
		</div>
	</div>
	
  
  <script src="js/jquery.min.js"></script>
  <script src="js/tether.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.9.1/standard/ckeditor.js"></script>
  <script>
	CKEDITOR.replace('editor1');
  </script>
  
</body>
</html>

