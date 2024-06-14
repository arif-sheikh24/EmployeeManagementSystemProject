<?php 
include('db_connect.php');
session_start();
if(isset($_GET['id'])){
$user = $conn->query("SELECT * FROM users where id =".$_GET['id']);
foreach($user->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
}

?>
<div class="container-fluid">
	<div id="msg"></div>
	
	<form action="" id="manage-user">	
		<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
		<div class="form-group">
			<label for="name">First Name</label>
			<input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo isset($meta['firstname']) ? $meta['firstname']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="name">Last Name</label>
			<input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo isset($meta['lastname']) ? $meta['lastname']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="name">User Id</label>
			<input type="text" name="username" id="username" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username']: '' ?>" readonly>
		</div>
		<div class="form-group">
			<label for="name">Blood Group</label>
			<input type="text" name="blood" id="blood" class="form-control" value="<?php echo isset($meta['blood']) ? $meta['blood']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="name">Gender</label>
			<input type="text" name="gender" id="gender" class="form-control" value="<?php echo isset($meta['gender']) ? $meta['gender']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="name">Contact No</label>
			<input type="text" name="contact" id="contact" class="form-control" value="<?php echo isset($meta['contact']) ? $meta['contact']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="name">NID No</label>
			<input type="text" name="nid" id="nid" class="form-control" value="<?php echo isset($meta['nid']) ? $meta['nid']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="name">Present Address</label>
			<input type="text" name="presentaddress" id="presentaddress" class="form-control" value="<?php echo isset($meta['presentaddress']) ? $meta['presentaddress']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="name">Parmanent Address</label>
			<input type="text" name="parmanentaddress" id="parmanentaddress" class="form-control" value="<?php echo isset($meta['parmanentaddress']) ? $meta['parmanentaddress']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="name">Designation</label>
			<input type="text" name="designation" id="designation" class="form-control" value="<?php echo isset($meta['designation']) ? $meta['designation']: '' ?>" readonly>
		</div>
		<div class="form-group">
			<label for="name">Subject</label>
			<input type="text" name="subject" id="subject" class="form-control" value="<?php echo isset($meta['subject']) ? $meta['subject']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="name">Last Completed degree</label>
			<input type="text" name="degree" id="degree" class="form-control" value="<?php echo isset($meta['degree']) ? $meta['degree']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="name">Emergency Contact No</label>
			<input type="text" name="emergencycontact" id="emergencycontact" class="form-control" value="<?php echo isset($meta['emergencycontact']) ? $meta['emergencycontact']: '' ?>" required>
		</div>
		<div class="form-group">
		<label for="name">Shift</label>
			<input type="text" name="shift" id="shift" class="form-control" value="<?php echo isset($meta['shift']) ? $meta['shift']: '' ?>" required>
		</div>
		<label for="name">University</label>
			<input type="text" name="department" id="department" class="form-control" value="<?php echo isset($meta['department']) ? $meta['department']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="text" name="email" id="email" class="form-control" value="<?php echo isset($meta['email']) ? $meta['email']: '' ?>" readonly  autocomplete="off">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
			<small><i>Leave this blank if you dont want to change the password.</i></small>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Avatar</label>
			<div class="custom-file">
              <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" onchange="displayImg(this,$(this))">
              <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
		</div>
		<div class="form-group d-flex justify-content-center">
			<img src="<?php echo isset($meta['avatar']) ? 'assets/uploads/'.$meta['avatar'] :'' ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
		</div>
		
		

	</form>
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
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$('#manage-user').submit(function(e){
		e.preventDefault();
		start_load()
		$.ajax({
			url:'ajax.php?action=update_user',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp ==1){
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}else{
					$('#msg').html('<div class="alert alert-danger">Username already exist</div>')
					end_load()
				}
			}
		})
	})

</script>