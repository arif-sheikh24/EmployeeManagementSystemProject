<?php 
include('inc/head.php'); 
if (isset($_SESSION['login_email'])) {
	
}
else{
	header('location:index.php');
}

?>
<body>




<section id="sections" class="py-4 mb-4 bg-faded">
	<div class="container">
		<div class="row">
			<div class="col-md"></div>
			<div class="col-md-2">
				<a href="#" class="btn btn-primary btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#addPostModal"><i class="fa fa-plus"></i> Apply Leave</a>
			</div>
			<div class="col-md-2">
				<a href="#" class="btn btn-warning btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#addCateModal"><i class="fa fa-spinner"></i> Pendings</a>
			</div>
			<div class="col-md-2">
				<a href="#" class="btn btn-success btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#addUsertModal"><i class="fa fa-check"></i> Approved</a>
			</div>
			<div class="col-md-2">
				<a href="#" class="btn btn-danger btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#rejectedLeavesModal"><i class="fa fa-xmark"></i> Rejected</a>
			</div>
			<div class="col-md"></div>
		</div>
	</div>

</section>


<section id="post">
	<div class="container">
		<div class="row">
		<table class="table table-bordered table-hover table-striped">
		<colgroup>
                    <col width="5%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="5%">
                    <col width="20%">
					<col width="10%">
                </colgroup>
						<thead>
							<th>#</th>
							<th>Name</th>
							<th>Leave Type</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Days</th>
							<th>Reason</th>
							<th>Status</th>
						</thead>
						 <tbody>
							 <?php 
								$sql = "SELECT * FROM leaves WHERE email='".$_SESSION['login_email']."'";
								$que = mysqli_query($con,$sql);
								$cnt=1;
								while ($result = mysqli_fetch_assoc($que)) {
									$start_date = new DateTime($result['leavedate']);
								    $end_date = new DateTime($result['leaveedate']);
								    $interval = $start_date->diff($end_date);
								    $total_days = $interval->days + 1; // Add 1 to include both start and end dates
								?>

								
							 <tr>
								<td><?php echo $cnt;?></td>
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
</section>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>



<div class="modal fade" id="addPostModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<div class="modal-title">
					<h5>Apply Leave</h5>
				</div>
				<button class="close" data-dismiss="modal"><span>&times;</span></button>
			</div>
			<div class="modal-body">
				<form action="" method="post">
				<div class="form-group">
						<label>Employee Name</label>
						<input type="text" name="name" value="<?php echo $_SESSION['login_firstname'] . ' ' . $_SESSION['login_lastname']; ?>" readonly>
					</div>
					<div class="form-group">
						<label>Employee Id</label>
						<input type="text" name="username" value="<?php echo $_SESSION['login_username']?>" readonly>
					</div>
					<div class="form-group">
						<input type="hidden" name="email" value="<?php echo $_SESSION['login_email']?>">
						<label class="form-control-label">Select Leave Type :</label>
						<select name="department" class="form-control" >
							<option value="Sick">Sick</option>
							<option value="Casual">Casual</option>
							<option value="Vacation">Vacation</option>
							<option value="Bereavement">Bereavement</option>
							<option value="Time off without pay">Time off without pay</option>
							<option value="Finance">Maternity / Paternity</option>
							<option value="Customer Support">Others</option>
						</select>
					</div>
					
					<div class="form-group">
						<label class="form-control-label">Leave start Date</label>
						<input type="date" name="leavedate" class="form-control" min="<?php echo date('Y-m-d'); ?>" />
						<label class="form-control-label">Leave End Date</label>
						<input type="date" name="leaveedate" class="form-control" min="<?php echo date('Y-m-d'); ?>" />
					</div>
					<div class="form-group">
						<label>Reason For Leave</label>
						<textarea name="editor1" class="form-control"  placeholder="Please complete reason in 30 words"></textarea>
					</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger" style="border-radius:0%;" data-dismiss="modal">Close</button>
				<input type="hidden" name="status" value="0">
				<input type="submit" class="btn btn-success" style="border-radius:0%;" name="apply"  value="Apply">
			</div>
		</form>
		</div>
	</div>
</div>

<div class="modal fade" id="addCateModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-warning text-white">
				<div class="modal-title">
					<h5>Pending Leaves</h5>
				</div>
				<button class="close" data-dismiss="modal"><span>&times;</span></button>
			</div>
			<div class="modal-body">
			<table class="table table-bordered table-hover table-striped">
			<colgroup>
                    <col width="5%">
                    <col width="10%">
                    <col width="15%">
                    <col width="10%">
                    <col width="10%">
                    <col width="5%">
                    <col width="20%">
					<col width="10%">
                </colgroup>
						<thead>
							<th>#</th>
							<th>Name</th>
							<th>Leave Type</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Days</th>
							<th>Reason</th>
							<th>Status</th>
						</thead>
						 <tbody>
							 <?php 
								$sql = "SELECT * FROM leaves WHERE status = 0 && email='".$_SESSION['login_email']."'";
								$que = mysqli_query($con,$sql);
								$cnt=1;
								while ($result = mysqli_fetch_assoc($que)) {
									$start_date = new DateTime($result['leavedate']);
								    $end_date = new DateTime($result['leaveedate']);
								    $interval = $start_date->diff($end_date);
								    $total_days = $interval->days + 1; // Add 1 to include both start and end dates
								?>

								
							 <tr>
								<td><?php echo $cnt;?></td>
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

<div class="modal fade" id="addUsertModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-success text-white">
				<div class="modal-title">
					<h5>Total Approved Leaves</h5>
				</div>
				<button class="close" data-dismiss="modal"><span>&times;</span></button>
			</div>
			<div class="modal-body">
			<table class="table table-bordered table-hover table-striped">
			<colgroup>
                    <col width="5%">
                    <col width="10%">
                    <col width="15%">
                    <col width="10%">
                    <col width="10%">
                    <col width="5%">
                    <col width="20%">
					<col width="10%">
                </colgroup>
						<thead>
							<th>#</th>
							<th>Name</th>
							<th>Leave Type</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Days</th>
							<th>Reason</th>
							<th>Status</th>
						</thead>
						 <tbody>
							 <?php 
								$sql = "SELECT * FROM leaves WHERE status = 1 AND email='".$_SESSION['login_email']."'";
								$que = mysqli_query($con,$sql);
								$cnt=1;
								while ($result = mysqli_fetch_assoc($que)) {
									$start_date = new DateTime($result['leavedate']);
								    $end_date = new DateTime($result['leaveedate']);
								    $interval = $start_date->diff($end_date);
								    $total_days = $interval->days + 1; // Add 1 to include both start and end dates
								?>

								
							 <tr>
								<td><?php echo $cnt;?></td>
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
									 else if($result['status'] == 1){
										echo "<span class='badge badge-success'>Approved</span>";
									 }
									 else{
										echo "<span class='badge badge-danger'>Rejected</span>";
									 }
							 $cnt++;}
								  ?>
								 </td>
							 </tr>
						 </tbody>
					</table>
			</div>
			
		</div>
	</div>
</div>
<div class="modal fade" id="rejectedLeavesModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Rejected Leaves</h5>
                <button class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-hover table-striped">
				<colgroup>
                    <col width="5%">
                    <col width="10%">
                    <col width="15%">
                    <col width="10%">
                    <col width="10%">
                    <col width="5%">
                    <col width="20%">
					<col width="10%">
                </colgroup>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Leave Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Days</th>
                            <th>Reason</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sql = "SELECT * FROM leaves WHERE status = 2 AND email = ?";
                        $stmt = $con->prepare($sql);
                        $stmt->bind_param('s', $_SESSION['login_email']); // Bind the email parameter
                        $stmt->execute();
                        $result = $stmt->get_result();

                        $cnt = 1;
                        while ($row = $result->fetch_assoc()) {
                            $start_date = new DateTime($row['leavedate']);
                            $end_date = new DateTime($row['leaveedate']);
                            $total_days = $start_date->diff($end_date)->days + 1;
                            ?>

                            <tr>
                                <td><?php echo $cnt++; ?></td>
                                <td><?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($row['department'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($row['leavedate'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($row['leaveedate'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo $total_days; ?></td>
                                <td><?php echo htmlspecialchars($row['leavereason'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td>
                                    <span class='badge badge-danger'>Rejected</span>
                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var leavedateInput = document.querySelector('input[name="leavedate"]');
    var leaveedateInput = document.querySelector('input[name="leaveedate"]');

    leavedateInput.addEventListener('change', function() {
        leaveedateInput.min = leavedateInput.value;
    });
});
</script>

<script src="js1/jquery.min.js"></script>
<script src="js1/tether.min.js"></script>
<script src="js1/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.9.1/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('editor1');
</script>
</body>
</html>
<?php 
if (isset($_POST['apply'])){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$department = $_POST['department'];
	$username = $_POST['username'];
	$leavedate = $_POST['leavedate'];
	$leaveedate = $_POST['leaveedate'];
	$totalday = $_POST['totalday'];
	$editor1 = $_POST['editor1'];
	$status = $_POST['status'];

	$sql = "INSERT INTO leaves(name,email,department,username,leavedate,leaveedate,totalday,leavereason,status)VALUES('$name','$email','$department','$username','$leavedate','$leaveedate','$totalday','$editor1','$status')";

	$run = mysqli_query($con,$sql);

	if($run == true){
		
		echo "<script> 
				alert('Leave Requested, Please wait for approval status');
				window.open('index.php?page=leave','_self');
			  </script>";
	}else{
		echo "<script> 
		alert('Failed To Apply');
		</script>";
	}
}

?>

