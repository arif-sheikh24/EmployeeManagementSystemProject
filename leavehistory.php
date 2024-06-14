<?php
require_once("db_connect.php");
//session_start();
if(!isset($_SESSION["sess_user"])){
  header("Location: index.php");
}
else{
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Admin Panel</title>

    <style>
        h1 {
            text-align: center;
            font-size: 2.5em;
            font-weight: bold;
            padding-top: 1em;
        }

        .mycontainer {
            width: 90%;
            margin: 1.5rem auto;
            min-height: 60vh;
        }

        .mycontainer table {
            margin: 1.5rem auto;
        }
    </style>

</head>

<body>
    
    <div class="mycontainer">

        <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped">
                  <thead>
                      <th>#</th>
                      <th>Employee</th>
                      <th>Leave Application</th>
                      <th>Days</th>
                      <th>From-Date</th>
                      <th>To-Date</th>
                      <th>Status</th>
                  </thead>
                  <tbody>
                    <!-- loading all leave applications of the user -->
                    <?php
                          $leaves = mysqli_query($conn,"SELECT * FROM leaves");
                          if($leaves){
                            $numrow = mysqli_num_rows($leaves);
                            if($numrow!=0){
                              $cnt=1;
                              while($row1 = mysqli_fetch_array($leaves)){
                                $datetime1 = new DateTime($row1['fromdate']);
                                $datetime2 = new DateTime($row1['todate']);
                                $interval = $datetime1->diff($datetime2);
                                echo "<tr>
                                        <td>$cnt</td>
                                        <td>{$row1['ename']}</td>
                                        <td>{$row1['descr']}</td>
                                        <td>{$interval->format('%a Day/s')}</td>
                                        <td>{$datetime1->format('Y/m/d')}</td>
                                        <td>{$datetime2->format('Y/m/d')}</td>
                                        <td><b>{$row1['status']}</b></td>
                                      </tr>";
                             $cnt++; }
                            } else {
                              echo"<tr class='text-center'><td colspan='12'>YOU DON'T HAVE ANY LEAVE HISTORY! PLEASE APPLY TO VIEW YOUR STATUS HERE!</td></tr>";
                            }
                          }
                          else{
                            echo "Query Error : " . "SELECT descr,status FROM leaves WHERE eid='".$_SESSION['sess_eid']."'" . "<br>" . mysqli_error($conn);;
                          }
                      ?>
                  </tbody>
              </table>
          </div>
    </div>

    <footer class="footer navbar navbar-expand-lg navbar-light bg-light" style="color:white;">
    <div>
    <p class="text-center">&copy; <?php echo date("Y"); ?> - Online Leave Application</p>
      <p class="text-center">Developed By Yash Sojitra and Darshan Mamtani</p>
    </div>
    </footer>
</body>

</html>

<?php
}

ini_set('display_errors', true);
error_reporting(E_ALL);
?>