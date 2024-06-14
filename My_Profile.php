
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
        <?php
// Get session data
$login_avatar = $_SESSION['login_avatar'];
$login_username = $_SESSION['login_username'];
$login_email = $_SESSION['login_email'];
$login_type_code = $_SESSION['login_type']; // Expected to be a number like 1, 2, 3

// Define the mapping from login type code to descriptive name
$login_type_names = [
    1 => 'Admin',          // 1 represents admin
    2 => 'Project Manager', // 2 represents project manager
    3 => 'Employee'        // 3 represents employee
];

// Get the descriptive name for the login type, or 'Unknown' if the code isn't mapped
$login_type = $login_type_names[$login_type_code] ?? 'Unknown'; // Using null coalescing operator (PHP 7+)
?>

<div class="d-flex flex-column align-items-center text-center p-3 py-5">
    <img class="rounded-circle mt-5" width="150px" src="assets/uploads/<?php echo htmlspecialchars($login_avatar); ?>" alt="User Avatar">
    <span class="font-weight-bold"><?php echo htmlspecialchars($login_username); ?></span>
    <span class="text-black-50"><?php echo htmlspecialchars($login_email); ?></span>
    <span class="text-black-50"><?php echo htmlspecialchars($login_type); ?></span> <!-- Descriptive name for login type -->
</div></div>
        <div class="col-md-8 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">First Name</label><input type="text" class="form-control" placeholder="first name" value="<?php echo $_SESSION['login_firstname'] ?>" readonly></div>
                    <div class="col-md-6"><label class="labels">Last Name</label><input type="text" class="form-control" placeholder="first name" value="<?php echo $_SESSION['login_lastname'] ?>" readonly></div>
                </div>
                <div class="row mt-3">
                <div class="col-md-6"><label class="labels">email</label><input type="text" class="form-control" placeholder="enter email id" value="<?php echo $_SESSION['login_email'] ?>" readonly></div>
                <div class="col-md-6"><label class="labels">Blood</label><input type="text" class="form-control" placeholder="enter address line 2" value="<?php echo $_SESSION['login_blood'] ?>" readonly></div>
                    <div class="col-md-6"><label class="labels">Gender</label><input type="text" class="form-control" placeholder="enter address line 2" value="<?php echo $_SESSION['login_gender'] ?>" readonly></div>
                    <div class="col-md-6"><label class="labels">Designation</label><input type="text" class="form-control" placeholder="enter address line 2" value="<?php echo $_SESSION['login_designation'] ?>" readonly></div>
                    
                    <div class="col-md-6"><label class="labels">nid</label><input type="text" class="form-control" placeholder="education" value="<?php echo $_SESSION['login_nid'] ?>" readonly></div>
                    <div class="col-md-6"><label class="labels">Mobile Number</label><input type="text" class="form-control" placeholder="enter phone number" value="<?php echo $_SESSION['login_contact'] ?>" readonly></div>
                    <div class="col-md-6"><label class="labels">Present Address</label><input type="text" class="form-control" placeholder="enter address line 1" value="<?php echo $_SESSION['login_presentaddress'] ?>" readonly></div>
                    <div class="col-md-6"><label class="labels">Permanent Address</label><input type="text" class="form-control" placeholder="enter address line 2" value="<?php echo $_SESSION['login_parmanentaddress'] ?>" readonly></div>
                    <div class="col-md-6"><label class="labels">Department</label><input type="text" class="form-control" placeholder="education" value="<?php echo $_SESSION['login_department'] ?>" readonly></div>
                    <div class="col-md-6"><label class="labels">Degree</label><input type="text" class="form-control" placeholder="enter phone number" value="<?php echo $_SESSION['login_degree'] ?>" readonly></div>
                    <div class="col-md-6"><label class="labels">Emergenc Contact</label><input type="text" class="form-control" placeholder="enter address line 1" value="<?php echo $_SESSION['login_emergencycontact'] ?>" readonly></div>
                    <div class="col-md-6"><label class="labels">Permanent Address</label><input type="text" class="form-control" placeholder="enter address line 2" value="<?php echo $_SESSION['login_parmanentaddress'] ?>" readonly></div>
                </div>
               
            
            </div>
        </div>
        
    </div>
</div>
</div>
</div>