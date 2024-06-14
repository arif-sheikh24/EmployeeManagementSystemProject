<?php include 'db_connect.php' ?>
<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <b>Project Progress</b>
            <div class="card-tools">
                <button class="btn btn-flat btn-sm bg-gradient-success btn-success" id="print"><i class="fa fa-print"></i> Print</button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive" id="printable">
                <table class="table m-0 table-bordered">
                <colgroup>
                    
                    <col width="5%">
                    <col width="20%">
                    <col width="10%">
                    <col width="40%">
                    <col width="20%">
                </colgroup>
                    <thead>
                        <th>#</th>
                        <th>Project</th>
                        <th>Total Task</th>
                        <th>Progress</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                    <?php
                            $stat = array("Pending", "Started", "On-Progress", "On-Progress", "On-Progress", "Done");
                            $where = "";
                            if ($_SESSION['login_type'] == 1 || $_SESSION['login_type'] == 2) {
                                $where = ""; // Show all projects for types 1 and 2
                            } elseif ($_SESSION['login_type'] == 3) {
                                // Show only projects where the employee is involved
                                $where = " WHERE CONCAT('[',REPLACE(user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
                            }
                            $qry = $conn->query("SELECT * FROM project_list $where order by name asc");
                            $i = 0;
                            while ($row = $qry->fetch_assoc()) :
                                $i++;
                                $prog = 0;
                                $tprog = $conn->query("SELECT * FROM task_list where project_id = {$row['id']}")->num_rows;
                                $cprog = $conn->query("SELECT * FROM task_list where project_id = {$row['id']} and status = 3")->num_rows;
                                $prog = $tprog > 0 ? ($cprog / $tprog) * 100 : 0;
                                $prog = $prog > 0 ? number_format($prog, 2) : $prog;
                                $prod = $conn->query("SELECT * FROM user_productivity where project_id = {$row['id']}")->num_rows;
                                // Determine status based on progress
                                if ($prog >= 0 && $prog < 50) {
                                    $row['status'] = 1; // Started
                                } elseif ($prog >= 50 && $prog < 90) {
                                    $row['status'] = 2; // On-Progress
                                } elseif ($prog >= 90 && $prog <= 100) {
                                    $row['status'] = 5; // Done
                                }
                        ?>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td>
                                    <a><?php echo ucwords($row['name']) ?></a>
                                    <br>
                                    <small>Due: <?php echo date("Y-m-d",strtotime($row['end_date'])) ?></small>
                                </td>
                                <td class="text-center"><?php echo number_format($tprog) ?></td>
                                <td class="project_progress">
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prog ?>%"></div>
                                    </div>
                                    <small><?php echo $prog ?>% Complete</small>
                                </td>
                                <td class="project-state" >
                                    <?php
                                    if($stat[$row['status']] =='Pending'){
                                        echo "<span class='badge badge-secondary'>{$stat[$row['status']]}</span>";
                                    } elseif($stat[$row['status']] =='Started'){
                                        echo "<span class='badge badge-primary'>{$stat[$row['status']]}</span>";
                                    } elseif($stat[$row['status']] =='On-Progress'){
                                        echo "<span class='badge badge-info'>{$stat[$row['status']]}</span>";
                                    } elseif($stat[$row['status']] =='Done'){
                                        echo "<span class='badge badge-success'>{$stat[$row['status']]}</span>";
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>  
                </table>
            </div>
        </div>
    </div>
</div>
<script>
$('#print').click(function(){
    var printContents = document.getElementById('printable').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
});
</script>
