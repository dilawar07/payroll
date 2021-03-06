<?php
  include("auth.php"); //include auth.php file on all secure pages
  include("db.php")
?>

<?php

$conn = mysqli_connect('localhost', 'adiwal', 'adiwal@1.1', 'payroll');
                          if (!$conn)
                          {
                            die("Database Connection Failed" . mysqli_error());
                          }


  $query  ="SELECT * from overtime";

   $res=mysqli_query($conn, $query) or die("Error in Query" . mysqli_error($conn));
  while($row=mysqli_fetch_array($res))
  {
    @$rate           = $row['rate'];
  }

$conn1 = mysqli_connect('localhost', 'adiwal', 'adiwal@1.1', 'payroll');
                          if (!$conn1)
                          {
                            die("Database Connection Failed" . mysqli_error());
                          }



  $query1="select * from salary";
  $res1=mysqli_query($conn1, $query1) or die("Error in Query" . mysqli_error($conn1));
  while($row1=mysqli_fetch_array($res1))
  {
    @$salary           = $row1['salary_rate'];
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Bootstrap, a sleek, intuitive, and powerful mobile first front-end framework for faster and easier web development.">
    <meta name="keywords" content="HTML, CSS, JS, JavaScript, framework, bootstrap, front-end, frontend, web development">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">

    <title>Pridepoint Bank - Payroll</title>

    <link href="assets/must.png" rel="shortcut icon">
    <link href="assets/css/justified-nav.css" rel="stylesheet">


    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="data:text/css;charset=utf-8," data-href="assets/css/bootstrap-theme.min.css" rel="stylesheet" id="bs-theme-stylesheet"> -->
    <!-- <link href="assets/css/docs.min.css" rel="stylesheet"> -->
    <link href="assets/css/search.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="assets/css/styles.css" /> -->
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.min.css">

  </head>
  <body>

    <div class="container">
      <div class="masthead">
        <h3>
          <b><a href="index.php">Pride Payroll</a></b>
            <a data-toggle="modal" href="#colins" class="pull-right"><b>Admin</b></a>
        </h3>
        <nav>
          <ul class="nav nav-justified">
            <li>
              <a href="home_employee.php">Employee</a>
            </li>
            <li>
              <a href="home_deductions.php">Deduction/s</a>
            </li>
            <li class="active">
              <a href="">Income</a>
            </li>
          </ul>
        </nav>
      </div>

        <br>
          <div class="well bs-component">
            <form class="form-horizontal">
              <fieldset>
                <button type="button" data-toggle="modal" data-target="#overtime" class="btn btn-success">Modify Overtime Rate</button>
                <button type="button" data-toggle="modal" data-target="#salary" class="btn btn-primary">Modify Salary Rate</button>
                <p class="pull-right">Overtime rate per hour: <big><b><?php echo $rate; ?>.00</b></big></p><br>
                <p class="pull-right">Salary rate: <big><b><?php echo $salary; ?>.00</b></big></p>
                <p align="center"><big><b>Account</b></big></p>
                <div class="table-responsive">
                  <form method="post" action="" >
                    <table class="table table-bordered table-hover table-condensed" id="myTable">
                      <!-- <h3><b>Ordinance</b></h3> -->
                      <thead>
                        <tr class="info">
                          <th><p align="center">Name</p></th>
                          <th><p align="center">Deduction</p></th>
                          <th><p align="center">Overtime</p></th>
                          <th><p align="center">Bonus</p></th>
                          <th><p align="center">Net Pay</p></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

						$conn2 = mysqli_connect('localhost', 'adiwal', 'adiwal@1.1', 'payroll');
                          if (!$conn)
                          {
                            die("Database Connection Failed" . mysqli_error());
                          }

                          $query2= "SELECT * from overtime";

						  $res2=mysqli_query($conn2, $query2) or die("Error in Query" . mysqli_error($conn2));

                          while($row2=mysqli_fetch_array($res2))
                          {
                            $rate   = $row2['rate'];
                          }

						$conn3 = mysqli_connect('localhost', 'adiwal', 'adiwal@1.1', 'payroll');
                          if (!$conn)
                          {
                            die("Database Connection Failed" . mysqli_error());
                          }




                          $query3  = "SELECT * from salary";

						  $res3=mysqli_query($conn3, $query3) or die("Error in Query" . mysqli_error($conn3));


						  while($row3=mysqli_fetch_array($res3))
                          {
                            $salary_rate   = $row3['salary_rate'];
                          }


						$conn4 = mysqli_connect('localhost', 'adiwal', 'adiwal@1.1', 'payroll');
                          if (!$conn)
                          {
                            die("Database Connection Failed" . mysqli_error());
                          }



                          $query4  = "SELECT * from employee";
						  $res4=mysqli_query($conn4, $query4) or die("Error in Query" . mysqli_error($conn4));



						  while($row4=mysqli_fetch_array($res4))
                          {
                            $lname           = $row4['lname'];
                            $fname           = $row4['fname'];
                            $deduction       = $row4['deduction'];
                            $overtime        = $row4['overtime'];
                            $bonus           = $row4['bonus'];

                            $over     = $row4['overtime'] * $rate;
                            $bonus     = $row4['bonus'];
                            $deduction  = $row4['deduction'];
                            $income   = $over + $bonus + $salary_rate;
                            $netpay   = $income - $deduction;
                        ?>
                        <tr>
                          <td align="center"><?php echo $lname?>, <?php echo $fname?></td>
                          <td align="center"><big><b><?php echo $deduction?></b></big>.00</td>
                          <td align="center"><big><b><?php echo $overtime?></b></big> hrs</td>
                          <td align="center"><big><b><?php echo $bonus?></b></big>.00</td>
                          <td align="center"><big><b><?php echo $netpay?></b></big>.00</td>
                        </tr>
                        <?php } ?>
                      </tbody>

                        <tr class="info">
                          <th><p align="center">Name</p></th>
                          <th><p align="center">Deduction</p></th>
                          <th><p align="center">Overtime</p></th>
                          <th><p align="center">Bonus</p></th>
                          <th><p align="center">Net Pay</p></th>
                        </tr>
                    </table>
                  </form>
                </div>
              </fieldset>
            </form>
          </div>

      <!-- this modal is for OVERTIME -->
      <div class="modal fade" id="overtime" role="dialog">
        <div class="modal-dialog modal-sm">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="padding:20px 50px;">
              <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
              <h3 align="center">Enter the amount of <big><b>Overtime</b></big> rate per hour.</h3>
            </div>
            <div class="modal-body" style="padding:40px 50px;">

              <form class="form-horizontal" action="update_overtime.php" name="form" method="post">
                <div class="form-group">
                    <input type="text" name="rate" class="form-control" value="<?php echo $rate; ?>" required>
                </div>

                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>

      <!-- this modal is for SALARY -->
      <div class="modal fade" id="salary" role="dialog">
        <div class="modal-dialog modal-sm">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="padding:20px 50px;">
              <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
              <h3 align="center">Enter the amount of <big><b>Salary</b></big> rate.</h3>
            </div>
            <div class="modal-body" style="padding:40px 50px;">

              <form class="form-horizontal" action="update_salary.php" name="form" method="post">
                <div class="form-group">
                    <input type="text" name="salary_rate" class="form-control" value="<?php echo $salary; ?>" required>
                </div>

                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>

      <!-- this modal is for my Colins -->
      <div class="modal fade" id="colins" role="dialog">
        <div class="modal-dialog modal-sm">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="padding:20px 50px;">
              <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
              <h3 align="center">You are logged in as <b><?php echo $_SESSION['username']; ?></b></h3>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
              <div align="center">
                <a href="logout.php" class="btn btn-block btn-danger">Logout</a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- <script src="assets/js/docs.min.js"></script> -->
    <script src="assets/js/search.js"></script>
    <script type="text/javascript" charset="utf-8" language="javascript" src="assets/js/dataTables.min.js"></script>

    <!-- FOR DataTable -->
    <script>
      {
        $(document).ready(function()
        {
          $('#myTable').DataTable();
        });
      }
    </script>

    <!-- this function is for modal -->
    <script>
      $(document).ready(function()
      {
        $("#myBtn").click(function()
        {
          $("#myModal").modal();
        });
      });
    </script>

  </body>
</html>
