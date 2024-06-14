<?php
include('includes/connection.php');
$fetch_query = mysqli_query($connection, "select max(id) as id from users");
      $row = mysqli_fetch_row($fetch_query);
	
?>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<form action="" id="manage_user">
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
				<div class="row">
					<div class="col-md-6 border-right">
						<div class="form-group">
							<label for="" class="control-label">First Name</label>
							<input type="text" name="firstname" class="form-control form-control-sm" required value="<?php echo isset($firstname) ? $firstname : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Last Name</label>
							<input type="text" name="lastname" class="form-control form-control-sm" required value="<?php echo isset($lastname) ? $lastname : '' ?>">
						</div>
						<?php if($_SESSION['login_type'] == 1): ?>
						<div class="form-group">
							<label for="" class="control-label">User Role</label>
							<select name="type" id="type" class="custom-select custom-select-sm">
								<option value="3" <?php echo isset($type) && $type == 3 ? 'selected' : '' ?>>Employee</option>
								<option value="2" <?php echo isset($type) && $type == 2 ? 'selected' : '' ?>>Project Manager</option>
								<option value="1" <?php echo isset($type) && $type == 1 ? 'selected' : '' ?>>Admin</option>
							</select>
						</div>
						<?php else: ?>
							<input type="hidden" name="type" value="3">
						<?php endif; ?>

						

						<div class="form-group">
    						<label for="gender" class="control-label">Gender</label>
    							<select name="gender" id="gender" class="form-control form-control-sm" required>
        							<option value="">Select Gender</option>
        							<option value="Male" <?php echo isset($gender) && $gender == 'Male' ? 'selected' : '' ?>>Male</option>
        							<option value="Female" <?php echo isset($gender) && $gender == 'Female' ? 'selected' : '' ?>>Female</option>
        							<option value="Other" <?php echo isset($gender) && $gender == 'Other' ? 'selected' : '' ?>>Other</option>
    							</select>
						</div>

						<div class="form-group">
    <label for="blood" class="control-label">Blood Group</label>
    <select name="blood" id="blood" class="form-control form-control-sm" required>
        <option value="">Select Blood Group</option>
        <option value="A+" <?php echo isset($blood) && $blood == 'A+' ? 'selected' : '' ?>>A+</option>
        <option value="A-" <?php echo isset($blood) && $blood == 'A-' ? 'selected' : '' ?>>A-</option>
        <option value="B+" <?php echo isset($blood) && $blood == 'B+' ? 'selected' : '' ?>>B+</option>
        <option value="B-" <?php echo isset($blood) && $blood == 'B-' ? 'selected' : '' ?>>B-</option>
        <option value="AB+" <?php echo isset($blood) && $blood == 'AB+' ? 'selected' : '' ?>>AB+</option>
        <option value="AB-" <?php echo isset($blood) && $blood == 'AB-' ? 'selected' : '' ?>>AB-</option>
        <option value="O+" <?php echo isset($blood) && $blood == 'O+' ? 'selected' : '' ?>>O+</option>
        <option value="O-" <?php echo isset($blood) && $blood == 'O-' ? 'selected' : '' ?>>O-</option>
    </select>
</div>

						

						
                                    <div class="form-group">
                                        <label>Shift <span class="text-danger">*</span></label>
                                        <select class="select" name="shift" required>
                                            <option value="">Select</option>
                                            <?php
                                             $fetch_query = mysqli_query($connection, "select start_time, end_time from tbl_shift where status=1");
                                                while($shift = mysqli_fetch_array($fetch_query)){ 
                                            ?>
                                            <option value="<?php echo $shift['start_time']; ?>-<?php echo $shift['end_time']; ?>"><?php echo $shift['start_time']; ?>-<?php echo $shift['end_time']; ?></option>
                                            <?php } ?>
                                            
                                        </select>
                                    </div>
									<div class="col-sm-6">
                                    <div class="form-group">
    <label>Department</label>
    <select class="select" name="department" required>
        <option value="">Select</option>
        <?php
        $fetch_query = mysqli_query($connection, "select department_name from tbl_department where status=1");
        while($dept = mysqli_fetch_array($fetch_query)){ 
            ?>
            <option value="<?php echo $dept['department_name']; ?>" <?php echo isset($department) && $department == $dept['department_name'] ? 'selected' : ''; ?>>
                <?php echo $dept['department_name']; ?>
            </option>
        <?php } ?>
    </select>
</div>

                                </div>
						<div class="form-group">
							<label for="" class="control-label">Contact No</label>
							<input type="text" name="contact" class="form-control form-control-sm" required value="<?php echo isset($contact) ? $contact : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">NID No</label>
							<input type="text" name="nid" class="form-control form-control-sm" required value="<?php echo isset($nid) ? $nid : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Avatar</label>
							<div class="custom-file">
		                      <input type="file" class="custom-file-input" id="customFile" name="img" onchange="displayImg(this,$(this))">
		                      <label class="custom-file-label" for="customFile">Choose file</label>
		                    </div>
						</div>
						<div class="form-group d-flex justify-content-center align-items-center">
							<img src="<?php echo isset($avatar) ? 'assets/uploads/' .$avatar :'' ?>" alt="Avatar" id="cimg" class="img-fluid img-thumbnail ">
						</div>
						
					</div>
					<div class="col-md-6">
					<div class="form-group">
							<label for="" class="control-label">Employee Id</label>
							<input type="text" name="username" class="form-control form-control-sm" required value="<?php echo isset($username) ? $username : '' ?>">
						</div>

						<div class="form-group">
							<label for="" class="control-label">Present Address</label>
							<input type="text" name="presentaddress" class="form-control form-control-sm" required value="<?php echo isset($presentaddress) ? $presentaddress : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Permanent Address</label>
							<input type="text" name="parmanentaddress" class="form-control form-control-sm" required value="<?php echo isset($parmanentaddress) ? $parmanentaddress : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">University</label>
							<input type="text" name="designation" class="form-control form-control-sm" required value="<?php echo isset($designation) ? $designation : '' ?>">
						</div>
						<div class="form-group">
    <label for="" class="control-label">Subject</label>
    <input type="text" name="subject" class="form-control form-control-sm" required value="<?php echo isset($subject) ? $subject : ''; ?>">
</div>

						<div class="form-group">
							<label for="" class="control-label">Last Completed Degree</label>
							<input type="text" name="degree" class="form-control form-control-sm" required value="<?php echo isset($degree) ? $degree : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Emergency Contact No</label>
							<input type="text" name="emergencycontact" class="form-control form-control-sm" required value="<?php echo isset($emergencycontact) ? $emergencycontact : '' ?>">
						</div>
						


						<div class="form-group">
							<label class="control-label">Email</label>
							<input type="email" class="form-control form-control-sm" name="email" required value="<?php echo isset($email) ? $email : '' ?>">
							<small id="#msg"></small>
						</div>
						<div class="form-group">
							<label class="control-label">Password</label>
							<input type="password" class="form-control form-control-sm" name="password" <?php echo !isset($id) ? "required":'' ?>>
							<small><i><?php echo isset($id) ? "Leave this blank if you dont want to change you password":'' ?></i></small>
						</div>
						<div class="form-group">
							<label class="label control-label">Confirm Password</label>
							<input type="password" class="form-control form-control-sm" name="cpass" <?php echo !isset($id) ? 'required' : '' ?>>
							<small id="pass_match" data-status=''></small>
						</div>
						
					
						
						
				</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex">
					<button class="btn btn-primary mr-2">Save</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = 'index.php?page=user_list'">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>
<script>
	$('[name="password"],[name="cpass"]').keyup(function(){
		var pass = $('[name="password"]').val()
		var cpass = $('[name="cpass"]').val()
		if(cpass == '' ||pass == ''){
			$('#pass_match').attr('data-status','')
		}else{
			if(cpass == pass){
				$('#pass_match').attr('data-status','1').html('<i class="text-success">Password Matched.</i>')
			}else{
				$('#pass_match').attr('data-status','2').html('<i class="text-danger">Password does not match.</i>')
			}
		}
	})
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$('#manage_user').submit(function(e){
		e.preventDefault()
		$('input').removeClass("border-danger")
		start_load()
		$('#msg').html('')
		if($('[name="password"]').val() != '' && $('[name="cpass"]').val() != ''){
			if($('#pass_match').attr('data-status') != 1){
				if($("[name='password']").val() !=''){
					$('[name="password"],[name="cpass"]').addClass("border-danger")
					end_load()
					return false;
				}
			}
		}
		$.ajax({
			url:'ajax.php?action=save_user',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved.',"success");
					setTimeout(function(){
						location.replace('index.php?page=user_list')
					},750)
				}else if(resp == 2){
					$('#msg').html("<div class='alert alert-danger'>Email already exist.</div>");
					$('[name="email"]').addClass("border-danger")
					end_load()
				}
			}
		})
	})
</script>