<?php
//session_start();
if (empty($_SESSION['login_username'])) {
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
?>
<?php
// Initialize variables for from_date and to_date
$from_date = '';
$to_date = '';

// Check if the form is submitted
if(isset($_POST['srh-btn'])) {
    // Assign values from POST data to the variables
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
}
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <form method="post">
                <div class="form-group row" style="padding: 20px;">
                    <label class="col-lg-0 col-form-label-report" for="from">From</label>
                    <div class="col-lg-3">
                        <input type="date" class="form-control" id="datetimepicker5" name="from_date"
                            placeholder="Select Date" value="<?php echo $from_date; ?>">
                    </div>

                    <label class="col-lg-0 col-form-label" for="from">To</label>
                    <div class="col-lg-3">
                        <input type="date" class="form-control" id="datetimepicker6" name="to_date"
                            placeholder="Select Date" value="<?php echo $to_date; ?>">
                    </div>

                    <div class="col-lg-3">
    <select class="form-control" id="username" name="username">
        <option value="">Select Employee Id</option>
        <?php
        // Query to fetch all users except the one with id=1
        $fetch_username = mysqli_query($connection, "SELECT * FROM users WHERE id != 1");

        // Loop through the results to populate the select options
        while ($row = mysqli_fetch_array($fetch_username)) {
            ?>
            <option value="<?php echo htmlspecialchars($row['username']); ?>" <?php echo isset($_POST['username']) && $_POST['username'] == $row['username'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($row['username']); ?></option>
            <?php
        }
        ?>
    </select>
</div>

                    <div class="col-lg-2">
                        <button type="submit" name="srh-btn" class="btn btn-primary search-button">Search</button>
                    </div>
                </div>
            </form>
        </div><div class="card-tools">
                <button class="btn btn-flat btn-sm bg-gradient-success btn-success" id="print"><i class="fa fa-print"></i> Print</button>
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
                    if (isset($_REQUEST['srh-btn'])) {
                        $from_date = $_POST['from_date'];
                        $to_date = $_POST['to_date'];
                        $username = isset($_POST['username']) ? $_POST['username'] : '';

                        $search_condition = '';

                        // Construct the search condition based on input values
                        if (!empty($from_date) && !empty($to_date)) {
                            $from_date = date('Y-m-d', strtotime($from_date));
                            $to_date = date('Y-m-d', strtotime($to_date));
                            $search_condition .= "DATE(tbl_attendance.date) BETWEEN '$from_date' AND '$to_date'";
                        }
                        if (!empty($username)) {
                            if (!empty($search_condition)) $search_condition .= " AND ";
                            $search_condition .= "users.username = '$username'";
                        }

                        // Execute the search query with the constructed condition
                        if (!empty($search_condition)) {
                            $search_query = mysqli_query($connection, "SELECT users.firstname, users.lastname, users.username, tbl_attendance.date, users.shift, tbl_attendance.check_in, tbl_attendance.message, tbl_attendance.in_status, tbl_attendance.check_out, tbl_attendance.out_status FROM users INNER JOIN tbl_attendance ON tbl_attendance.employee_id=users.username WHERE $search_condition");

                            while ($row = mysqli_fetch_array($search_query)) {
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
                        }
                    } else {
                        // If no search parameters are provided, show all records
                        $fetch_query = mysqli_query($connection, "SELECT users.firstname, users.lastname, users.username, tbl_attendance.date, users.shift, tbl_attendance.check_in, tbl_attendance.message, tbl_attendance.in_status, tbl_attendance.check_out, tbl_attendance.out_status FROM users INNER JOIN tbl_attendance ON tbl_attendance.employee_id=users.username");
                        while ($row = mysqli_fetch_array($fetch_query)) {
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
                    <?php } } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
<script language="JavaScript" type="text/javascript">
    function confirmDelete() {
        return confirm('Are you sure want to delete this Employee?');
    }
</script>
<script>
    $('#print').click(function () {
        start_load();

        var printContents = $('.table-responsive').html(); // Get the HTML content of the element with class="table-responsive"
        var originalContents = $('body').html(); // Save the original HTML content of the page

        // Open a new window
        var printWindow = window.open('', '_blank');

        // Write the print contents to the new window
        printWindow.document.write('<html><head><title>Attendance Report</title></head><body>');
        printWindow.document.write(printContents);
        printWindow.document.write('</body></html>');

        // Close the new window after printing
        printWindow.document.close();
        printWindow.print();
        printWindow.onafterprint = function () {
            printWindow.close(); // Close the print window after printing
            end_load(); // End loading indicator
        };
    });
</script>
<!-- Include this script in the HTML file -->



<!-- Include this script in the HTML file -->
<!-- Include this script in the HTML file -->

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var fromDateInput = document.getElementById('datetimepicker5'); // 'From' date input

    // Get today's date in YYYY-MM-DD format
    
    // Set the minimum date to today
    fromDateInput.min = today;

    // If 'From' date is earlier than today, reset it to today
    if (fromDateInput.value && fromDateInput.value < today) {
        fromDateInput.value = today;
    }
});

</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var fromDateInput = document.getElementById('datetimepicker5');
    var toDateInput = document.getElementById('datetimepicker6');

    // Update 'To' date minimum based on 'From' date
    function updateToDateMin() {
        var fromDate = fromDateInput.value;
        
        // Set the minimum value for the 'To' date
        toDateInput.min = fromDate;

        // If 'To' date is earlier than 'From' date, adjust it
        if (toDateInput.value < fromDate) {
            toDateInput.value = fromDate; // Reset 'To' date to match 'From' date
        }
    }

    // Trigger 'To' date update when 'From' date changes
    fromDateInput.addEventListener('change', updateToDateMin);

    // Initialize the 'To' date minimum if 'From' date is already set
    if (fromDateInput.value) {
        updateToDateMin();
    }
});

    </script>
<script>
    // Function to clear previous search results
    function clearPreviousResults() {
        // Hide or clear previous search results here
    }

    // Event listener for the search button
    document.getElementById("srh-btn").addEventListener("click", function() {
        // Call the function to clear previous results
        clearPreviousResults();
    });
</script>
