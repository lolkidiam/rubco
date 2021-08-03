<?php
session_start();






//Checking User Logged or Not
if (empty($_SESSION['user'])) {
  header('location:index.php');
}
//Restrict User or Moderator to Access Admin.php page
if ($_SESSION['user']['role'] == 'officehead') {
  header('location:officehead.php');
}
if ($_SESSION['user']['role'] == 'adminone') {
  header('location:adminone.php');
}
if ($_SESSION['user']['role'] == 'admintwo') {
  header('location:admintwo.php');
}
if ($_SESSION['user']['role'] == 'adminthree') {
  header('location:adminthree.php');
}




$conn = mysqli_connect('localhost', 'root', '', 'logindb');
$result = mysqli_query($conn, "SELECT * FROM employee INNER JOIN aproval on employee.empID=aproval.empID");


?>

<html>



<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap.min.css" crossorigin="anonymous" />

  <style>
    .flex-center {
      position: fixed;
      width: 100%;
      height: 10%;
      left: 0;
      right: 0;
      top: 0;
      z-index: 1;
    }

    thead {
      position: sticky;
      width: 100%;
      left: 0;
      right: 0;
      top: 10%;
      z-index: 1;
    }

    .add {
      position: fixed;
      background-color: white;
      width: 100%;
      height: 20%;
      padding: 10;
    }

    .tableClass {
      padding: 20;
      margin-top: 20;
      position: relative;
      top: 10%;
      width: 100%;
      height: 100%;
    }
  </style>

</head>

<body>




  <div class="flex-center">



    <nav class="navbar navbar-dark bg-dark navbar-fixed-top" style="height:70; align-content: center">
      <a class="navbar-brand">
        <img src="rubco.jpg" height="50" class="d-inline-block align-center" alt="" style="padding-bottom: 10" />
        <span class="navbar-text navbar-light h1" style="color: white">
          Rubco
        </span></a>
      <form class="form-inline align-top" style="padding-top: 10" action="logout.php">

        <div class="d-flex flex-column bd-highlight mb-0" style="padding-right: 50; color: white">
          <div class="p-2 bd-highlight" style="height: 30">USER: <?php echo $_SESSION['user']['username']; ?></div>
          <div class="p-2 bd-highlight">ROLE: <?php echo $_SESSION['user']['role']; ?></div>
        </div>

        <button class="btn btn-outline-danger my-2 my-sm-0 padd" type="Logout">
          Logout
        </button>
      </form>
    </nav>


  </div>

  <div class="tableClass">

    <table class="table table-striped table-warning table-hover " style="word-break: break-all;">
      <thead class="bg-warning">
        <tr class="table-active">
          <th scope="col">ID</th>
          <th scope="col">Employee Name</th>
          <th scope="col">officehead</th>
          <th scope="col">admin_3</th>
          <th scope="col">admin_2</th>
          <th scope="col">admin_1</th>
        </tr>
      </thead>
      <tbody>


        <?php
        while ($row = mysqli_fetch_array($result)) {
        ?>

          <tr>
            <td scope="row"><?php echo $row["empID"] ?></th>
            <td><?php echo $row["employeeName"] ?></th>
            <td class="bg-<?php echo (($row["officehead"] == 1) ? 'success' : (($row["officehead"] == -1) ? 'danger' : 'light')) ?>"><?php echo (($row["officehead"] == 1) ? 'APPROVED' : (($row["officehead"] == -1) ? 'REJECTED' : 'PENDING')) ?></th>
            <td class="bg-<?php echo (($row["admin_3"] == 1) ? 'success' : (($row["admin_3"] == -1) ? 'danger' : 'light')) ?>"><?php echo (($row["admin_3"] == 1) ? 'APPROVED' : (($row["admin_3"] == -1) ? 'REJECTED' : 'PENDING')) ?></th>
            <td class="bg-<?php echo (($row["admin_2"] == 1) ? 'success' : (($row["admin_2"] == -1) ? 'danger' : 'light')) ?>"><?php echo (($row["admin_2"] == 1) ? 'APPROVED' : (($row["admin_2"] == -1) ? 'REJECTED' : 'PENDING')) ?></th>
            <td class="bg-<?php echo (($row["admin_1"] == 1) ? 'success' : (($row["admin_1"] == -1) ? 'danger' : 'light')) ?>">
              <?php echo (($row["admin_1"] == 1) ? 'APPROVED' : (($row["admin_1"] == -1) ? 'REJECTED' : 'PENDING')) ?></th>
          </tr>
        <?php } ?>
      </tbody>
    </table>


    <thead>
    </thead>
    </table>

  </div>

</body>

</html>