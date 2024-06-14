<?php

require_once ( 'db_connect.php');

//$sql = "SELECT * from `users_leave`";
$sql = "Select users.id, users.firstName, users.lastName, users_leave.start, users_leave.end, users_leave.reason, users_leave.status, users_leave.token From users, users_leave Where users.id = users_leave.id order by users_leave.token";

//echo "$sql";
$result = mysqli_query($conn, $sql);

?>

<div class="header">
                <div class="left">
                    <h1>users Leaves</h1>
                    
                </div>
            </div>
            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bxs-graduation'></i>
                        <h3>Leaves</h3>
                    </div>
                    <table id="myTable" class="display">
                    <div class="divider"></div>
                    <tr>
				<th>Emp. ID</th>
				<th>Token</th>
				<th>Name</th>
				<th>Start Date</th>
				<th>End Date</th>
				<th>Total Days</th>
				<th>Reason</th>
				<th>Status</th>
				<th>Options</th>
			</tr>

            <?php
				while ($users = mysqli_fetch_assoc($result)) {

				$date1 = new DateTime($users['start']);
				$date2 = new DateTime($users['end']);
				$interval = $date1->diff($date2);
				$interval = $date1->diff($date2);
				//echo "difference " . $interval->days . " days ";

					echo "<tr>";
					echo "<td>".$users['id']."</td>";
					echo "<td>".$users['token']."</td>";
					echo "<td>".$users['firstName']." ".$users['lastName']."</td>";
					
					echo "<td>".$users['start']."</td>";
					echo "<td>".$users['end']."</td>";
					echo "<td>".$interval->days."</td>";
					echo "<td>".$users['reason']."</td>";
					echo "<td>".$users['status']."</td>";
					echo "<td><a href=\"approve.php?id=$users[id]&token=$users[token]\"  onClick=\"return confirm('Are you sure you want to Approve the request?')\">Approve</a> | <a href=\"cancel.php?id=$users[id]&token=$users[token]\" onClick=\"return confirm('Are you sure you want to Canel the request?')\">Cancel</a></td>";

				}


			?>

                    </table>
                    <script>
                        $(document).ready(function() {
                            $('#myTable').DataTable();
                        });
                    </script>
                </div>
                
            </div>