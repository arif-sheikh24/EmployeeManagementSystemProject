<?php include 'db_connect.php'; ?>
<div class="col-lg-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <?php if ($_SESSION['login_type'] != 3): ?>
                <div class="card-tools">
                    <a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=new_project"><i class="fa fa-plus"></i> Add New project</a>
                </div>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <table class="table table-hover table-condensed" id="list">
                <colgroup>
                    <col width="5%">
                    <col width="25%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Project</th>
                        <th>Date Started</th>
                        <th>Estimated Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $stat = array("Pending", "Started", "On-Progress", "Done");
                    $where = "";
                    if($_SESSION['login_type'] == 2){
						$where = " where manager_id = '{$_SESSION['login_id']}' ";
					}elseif($_SESSION['login_type'] == 3){
						$where = " where concat('[',REPLACE(user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
					}
                    $qry = $conn->query("SELECT * FROM project_list $where ORDER BY name ASC");
                    while ($row = $qry->fetch_assoc()):
                        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
                        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                        $desc = strtr(html_entity_decode($row['description']), $trans);
                        $desc = str_replace(array("<li>", "</li>"), array("", ", "), $desc);

                        $tprog = $conn->query("SELECT * FROM task_list WHERE project_id = {$row['id']}")->num_rows;
                        $cprog = $conn->query("SELECT * FROM task_list WHERE project_id = {$row['id']} AND status = 3")->num_rows;
                        $prog = $tprog > 0 ? ($cprog / $tprog) * 100 : 0;
                        $prog = $prog > 0 ? number_format($prog, 2) : $prog;
                        $prod = $conn->query("SELECT * FROM user_productivity WHERE project_id = {$row['id']}")->num_rows;
                        if ($row['status'] == 0 && strtotime(date('Y-m-d')) >= strtotime($row['start_date'])):
                            if ($prod > 0 || $cprog > 0)
                                $row['status'] = 2;
                            else
                                $row['status'] = 1;
                        elseif ($row['status'] == 0 && strtotime(date('Y-m-d')) > strtotime($row['end_date'])):
                            $row['status'] = 4;
                        endif;
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i++ ?></td>
                            <td class="text-left">
                                <b><a class="text-left" class="dropdown-item view_project" href="./index.php?page=view_project&id=<?php echo $row['id'] ?>" data-id="<?php echo $row['id'] ?>"><?php echo ucwords($row['name']) ?></a></b>
                                <p class="truncate"><?php echo strip_tags($desc) ?></p>
                            </td>
                            <td class="text-left"><b><?php echo date("M d, Y", strtotime($row['start_date'])) ?></b></td>
                            <td class="text-left"><b><?php echo date("M d, Y", strtotime($row['end_date'])) ?></b></td>
                            <td class="text-left"><b><?php echo date("M d, Y", strtotime($row['Edate'])) ?></b></td>
                            
                            <td class="text-left" style="align-items:left;">
                            <dd>
        <?php
        if ($prog >= 0 && $prog < 50) {
            echo "<span class='badge badge-primary'>Started</span>";
        } elseif ($prog >= 50 && $prog < 90) {
            echo "<span class='badge badge-info'>On Progress</span>";
        } elseif ($prog >= 90 && $prog <= 100) {
            echo "<span class='badge badge-success'>Done</span>";
        } else {
            echo "<span class='badge badge-secondary'>Pending</span>";
        }
        ?>
    </dd>
</td>

                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    Action
                                </button>
                                <div class="dropdown-menu" style="">
                                    <a class="dropdown-item view_project" href="./index.php?page=view_project&id=<?php echo $row['id'] ?>" data-id="<?php echo $row['id'] ?>">View</a>
                                    <div class="dropdown-divider"></div>
                                    <?php if ($_SESSION['login_type'] != 3): ?>
                                        <a class="dropdown-item" href="./index.php?page=edit_project&id=<?php echo $row['id'] ?>">Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete_project" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>
    table p {
        margin: unset !important;
    }

    table td {
        vertical-align: middle !important;
    }
</style>
<script>
    $(document).ready(function() {
        $('#list').dataTable()

        $('.delete_project').click(function() {
            _conf("Are you sure to delete this project?", "delete_project", [$(this).attr('data-id')])
        })
    })

    function delete_project($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_project',
            method: 'POST',
            data: {
                id: $id
            },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)
                }
            }
        })
    }
</script>
