<?php

error_reporting(0);
if(empty($_SESSION['login_username']))
{
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
$id = $_SESSION['login_username'];
$fetch_query = mysqli_query($connection, "select shift from users where id='$id'");
$shift = mysqli_fetch_array($fetch_query);

$fetch_emp = mysqli_query($connection, "select * from users where id='$id'");
$emp = mysqli_fetch_array($fetch_emp);
$empid = $emp['username'];


$curr_date = date('Y-m-d');
date_default_timezone_set('Asia/Dhaka'); 
$time = date('Y-m-d H:i:s');
$intime = "";
$outtime = "";
$checkout_status='';
$shifttime = $shift['shift']; 
$shifttime = substr($shifttime, 0,8);
if(time()>strtotime($shifttime))
{
  $intime = "Late";
}
else
{
  $intime = "On Time";
} 

$outtimeshift = $shift['shift'];
$outtimeshift = substr($outtimeshift, 0,8);

if(time()>strtotime($outtimeshift))
{
  $outtime = "Early";
}
else
{
  $outtime = "Over Time";
}


    if(isset($_REQUEST['turn-it']))
    {
      $shift = $shift['shift'];
      $location = $_REQUEST['location'];
      $msg = $_REQUEST['msg'];
      $emp_id = $id;
      $date = $curr_date;
      $check_in = $time;
      $in_status = $intime;
      
      
      $insert_query = mysqli_query($connection, "insert into tbl_attendance set employee_id='$emp_id', shift='$shift', location='$location', message='$msg', date='$date',  check_in='$check_in', in_status='$in_status'");

    }
?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 ">
                       
                         
                    </div>
                    
                </div>
                <div class="row">
                  <?php
                   $date = date('Y-m-d');
                   $fetch_attend = mysqli_query($connection,"select employee_id from tbl_attendance where date='$date' and employee_id='$id'");
                  $row = mysqli_num_rows($fetch_attend);
                  if($row==0){
                   ?>
                    <div class="col-lg-8 offset-lg-2">
                       <form method="post">
                            <div class="row">
                              <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Shift <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="shift" value="<?php echo $_SESSION['login_shift'] ?>" disabled>
                                          
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Location <span class="text-danger">*</span></label>
                                        <select class="select" name="location" required>
                                            <option value="">Select</option>
                                            <?php
                                             $fetch_query = mysqli_query($connection, "select location from tbl_location");
                                                while($loc = mysqli_fetch_array($fetch_query)){ 
                                            ?>
                                            <option value="<?php echo $loc['location']; ?>"><?php echo $loc['location']; ?></option>
                                            <?php } ?>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Message </label>
                                        <textarea class="form-control" name="msg"></textarea>  
                                          
                                    </div>
                                </div>
                               
                    </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" name="turn-it"><img src="img/login.png" width="40"> Turn It!</button>
                            </div>
                        </form>
                    </div>
                  <?php } else {
                    
                    $fetch_checkin = mysqli_query($connection,"select date from tbl_attendance where check_out='00:00:00' and employee_id='$id'");
                    $rows = mysqli_num_rows($fetch_checkin);
                    if($rows>0){
                    $data = mysqli_fetch_array($fetch_checkin);
                    $chekdate = $data['date'];
                    }
                    if(isset($_REQUEST['check-out']))
                    {
                      $check_out = $time;
                      $insert_query = mysqli_query($connection, "update tbl_attendance set check_out='$check_out', out_status='$outtime' where employee_id='$id' and date='$chekdate'");
                       $checkout_status=0; 
                    }
                    ?>
                    
                   <div class="col-lg-12 offset-lg-2">
                       <div class="row">
                              <div class="col-sm-6">
                    <center><h3>Thank You For Today</h3></center>
                    <form method="post">
                     <div class="m-t-20 text-center">
                      <?php
                      $curr_date = date('Y-m-d');
                      $fetch_checkout = mysqli_query($connection,"select out_status from tbl_attendance where date='$curr_date' and employee_id='$id'");
                      $result = mysqli_fetch_array($fetch_checkout);
                      $result = $result['out_status'];
                      if($result=='' || $checkout_status==1){
                      ?>
                                <button class="btn btn-primary submit-btn" name="check-out" onclick="return confirmDelete()"><img src="img/login.png" width="40">  Check Out!</button>
                      <?php  } else{?>
                        <button disabled class="btn btn-primary submit-btn" name="check-out" onclick="return confirmDelete()"><img src="img/login.png" width="40">  Done!</button>
                        <h5>See you Next office day!</h5>
                      <?php } ?>
                              
                            </div>
                          </form>
                          </div>
                        </div>
                      </div>
                   
                  <?php } ?>

                </div>
            </div>
		</div>
    
<?php
    include('footer.php');
?>
<script language="JavaScript" type="text/javascript">
function confirmDelete(){
    return confirm('Are you sure want to check out now?');
}
</script>