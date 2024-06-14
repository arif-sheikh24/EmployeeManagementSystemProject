<?php
//session_start(); // Start the session to access session variables
if (empty($_SESSION['login_username'])) {
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <form method="post">
                <!-- Your form elements here -->
            </form>
        </div>
        <div class="table-responsive">
            <table class="datatable table table-stripped ">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Employee Id</th>
                        <th>Date</th>
                        <th>Shift</th>
                        <th>Check In</th>
                        <th>Notes</th>
                        <th>In Status</th>
                        <th>Check Out</th>
                        <th>Out Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Retrieve logged-in user's username from session
                    $logged_in_username = $_SESSION['login_username'];

                    // Construct and execute the SQL query to fetch records for the logged-in user
                    $query = "SELECT users.firstname, users.lastname, users.username, tbl_attendance.date, users.shift, tbl_attendance.check_in, tbl_attendance.message, tbl_attendance.in_status, tbl_attendance.check_out, tbl_attendance.out_status FROM users INNER JOIN tbl_attendance ON tbl_attendance.employee_id=users.username WHERE users.username = '$logged_in_username'";
                    $result = mysqli_query($connection, $query);

                    // Process the fetched records
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['firstname'] . " " . $row['lastname']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['shift']; ?></td>
                            <td><?php echo $row['check_in']; ?></td>
                            <td><?php echo $row['message']; ?></td>
                            <td><?php echo $row['in_status']; ?></td>
                            <td><?php echo $row['check_out']; ?></td>
                            <td><?php echo $row['out_status']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
