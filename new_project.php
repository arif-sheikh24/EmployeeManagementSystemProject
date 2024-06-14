<?php if(!isset($conn)){ include 'db_connect.php'; } ?>

<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="" id="manage-project">

        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="" class="control-label">Name</label>
					<input type="text" class="form-control form-control-sm" name="name" value="<?php echo isset($name) ? $name : '' ?>">
				</div>
			</div>
          	
		</div>
		<div class="row">
			<div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Start Date</label>
              <input type="date" class="form-control form-control-sm" autocomplete="off" name="start_date" id="start_date" value="<?php echo isset($start_date) ? $start_date : '' ?>"required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Estimated Date</label>
              <input type="date" class="form-control form-control-sm" autocomplete="off" name="end_date" id="end_date" value="<?php echo isset($end_date) ? $end_date : '' ?>"required>
            </div>
          </div>
		</div>
		
                <div class="row">
				<div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">End Date (Actual)</label>
                            <input type="date" class="form-control form-control-sm" name="Edate" id="Edate" 
							value="<?php echo isset($end_date) ? $end_date : '' ?>">
                        </div>
                    </div>

		  <div class="col-md-6">
				<div class="form-group">
					<label for="">Status</label>
					<select name="status" id="status" class="custom-select custom-select-sm">
						<option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Opened</option>
						<option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>On Progress</option>
						<option value="2" <?php echo isset($status) && $status == 2 ? 'selected' : '' ?>>Done</option>
					</select>
				</div>
			</div>
		</div>
        <div class="row">
        	
           <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Project Manager</label>
              <select class="form-control form-control-sm select2" name="manager_id">
              	<option></option>
              	<?php 
              	$managers = $conn->query("SELECT *,concat(Username) as name FROM users where id=2 order by concat(username) asc ");
              	while($row= $managers->fetch_assoc()):
              	?>
              	<option value="<?php echo $row['id'] ?>" <?php echo isset($manager_id) && $manager_id == $row['id'] ? "selected" : '' ?>><?php echo ucwords($row['username']) ?></option>
              	<?php endwhile; ?>
              </select>
            </div>
          </div>
    
      	<input type="hidden" name="manager_id" value="<?php echo $_SESSION['login_id'] ?>">
    
          <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Project Team Members</label>
              <select class="form-control form-control-sm select2" multiple="multiple" name="user_ids[]">
              	<option></option>
              	<?php 
              	$employees = $conn->query("SELECT *,concat(username) as name FROM users where type = 3 order by concat(username) asc ");
              	while($row= $employees->fetch_assoc()):
              	?>
              	<option value="<?php echo $row['id'] ?>" <?php echo isset($user_ids) && in_array($row['id'],explode(',',$user_ids)) ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
              	<?php endwhile; ?>
              </select>
            </div>
          </div>
        </div>
		<div class="row">
			<div class="col-md-10">
				<div class="form-group">
					<label for="" class="control-label">Description</label>
					<textarea name="description" id="" cols="30" rows="10" class="summernote form-control">
						<?php echo isset($description) ? $description : '' ?>
					</textarea>
				</div>
			</div>
		</div>
        </form>
    	</div>
    	<div class="card-footer border-top border-info">
    		<div class="d-flex w-100 justify-content-center align-items-center">
    			<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-project">Save</button>
    			<button class="btn btn-flat bg-gradient-secondary mx-2" type="button" onclick="location.href='index.php?page=project_list'">Cancel</button>
    		</div>
    	</div>
	</div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get references to the start date and end date input fields
    var startDateInput = document.getElementById('start_date');
    var endDateInput = document.getElementById('end_date');

    // Function to update the min attribute of the end date input based on the selected start date
    function updateEndDateMin() {
        // Get the selected start date value
        var startDateValue = new Date(startDateInput.value);

        // Set the minimum allowed value for the end date input to the selected start date
        endDateInput.min = startDateInput.value;

        // If the selected start date is after the current end date, reset the end date to the start date
        if (startDateValue > new Date(endDateInput.value)) {
            endDateInput.value = startDateInput.value;
        }
    }

    // Event listener to update the min attribute of the end date input when the start date changes
    startDateInput.addEventListener('change', function() {
        updateEndDateMin();
    });

    // Set the initial min attribute of the end date input to the current date and time
    endDateInput.min = new Date().toISOString().slice(0, 16);

    // Show start date input when the end date input is clicked
    endDateInput.addEventListener('click', function() {
        startDateInput.style.display = 'block';
    });
});

</script>
<script>
	$('#manage-project').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_project',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved',"success");
					setTimeout(function(){
						location.href = 'index.php?page=project_list'
					},2000)
				}
			}
		})
	})
</script>
<script>
	document.addEventListener('DOMContentLoaded', function() {
    var endDateInput = document.getElementById('end_date');
    var edateInput = document.getElementById('Edate');

    // Function to update Edate based on end_date
    function updateEdate() {
        var endDateValue = endDateInput.value;
        edateInput.value = endDateValue + 'T00:00'; // Default to midnight if only date is given
    }

    // Update Edate when end_date changes
    endDateInput.addEventListener('change', updateEdate);

    // Set initial Edate based on end_date
    updateEdate(); // Run once at the beginning to set the initial value
});
</script>
