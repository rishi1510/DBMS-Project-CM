<!DOCTYPE html>
<html>
    <head>
        <title>Courier Management</title>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">  
        <link href="style.css" rel="stylesheet">
    </head>

    <?php
    include('conn.php');
    session_start();
    if(!isset($_SESSION['muse'])) {
        header("Location: logout.php?type=2");
    }
    $user = $_SESSION['muse'];

    $sql1 = "SELECT M_NAME FROM MANAGER WHERE M_CODE='$user'";
    $res1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC);
    $name = $row1['M_NAME'];

    $sql2 = "SELECT * FROM PACKAGE 
             WHERE TO_CITY = (SELECT B_CITY FROM BRANCH
                              WHERE B_CODE = (SELECT B_CODE FROM MANAGER
                                              WHERE M_CODE = '$user'))
             AND STATUS = 'Processing Request'";
    $result2 = mysqli_query($con, $sql2);
    $count1 = mysqli_num_rows($result2);

    $sql3 = "SELECT * FROM PACKAGE 
             WHERE TO_CITY = (SELECT B_CITY FROM BRANCH
                              WHERE B_CODE = (SELECT B_CODE FROM MANAGER
                                              WHERE M_CODE = '$user'))
             AND STATUS = 'Courier Assigned'";
    $result3 = mysqli_query($con, $sql3);
    $count2 = mysqli_num_rows($result3);   
    
    $sql4 = "SELECT * FROM PACKAGE 
             WHERE TO_CITY = (SELECT B_CITY FROM BRANCH
                              WHERE B_CODE = (SELECT B_CODE FROM MANAGER
                                              WHERE M_CODE = '$user'))
             AND STATUS = 'Delivered'";
    $result4 = mysqli_query($con, $sql4);
    $count3 = mysqli_num_rows($result4);   

    ?>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="24" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
            <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
          </svg>
          <?php echo $name; ?>
        </a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="mhome.php">
                View Couriers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="massign.php">
                View Packages</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="mnewc.php">
                New Courier</a>
            </li>
          </ul>

          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="logout.php?type=2">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="24" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                  <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                </svg>
                Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav><br><br>

        <div class="container border border-3 rounded-3 p-5 bg-light">
            <h1>Unassigned Packages:</h1><br><br>
              <?php 
              if($count1 == 0) {
                echo "No packages to assign";
              }
              else {
                echo "<table class='table table-hover text-center'><tr><th>P_Code</th><th>Receiver Name</th><th>Address</th><th>City</th><th>Pin</th><th>Phone</th></tr>";
                
                while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                  $pid = $row['P_CODE'];
                  echo "<tr>";
                  echo "<td><a href='mviewp.php?pid=$pid'>" . $row['P_CODE'] . "</a></td>";
                  echo "<td><a href='mviewp.php?pid=$pid'>" . $row['TO_NAME'] . "</a></td>";
                  echo "<td><a href='mviewp.php?pid=$pid'>" . $row['TO_ADDRESS'] . "</a></td>";
                  echo "<td><a href='mviewp.php?pid=$pid'>" . $row['TO_CITY'] . "</a></td>";
                  echo "<td><a href='mviewp.php?pid=$pid'>" . $row['TO_PIN'] . "</a></td>";
                  echo "<td><a href='mviewp.php?pid=$pid'>" . $row['TO_PHONE'] . "</a></td>";
                  echo "</tr>";
                }
                
                echo "</table>";
              }
              ?>
            </div>
              <br><br>

              <div class="container border border-3 rounded-3 p-5 bg-light">
            <h1>Assigned Packages:</h1><br><br>
              <?php 
              if($count2 == 0) {
                echo "No packages";
              }
              else {
                echo "<table class='table table-hover text-center'><tr><th>P_Code</th><th>Receiver Name</th><th>Address</th><th>City</th><th>Pin</th><th>Phone</th><th>C_Code</tr>";
                
                while($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                  $pid = $row['P_CODE'];
                  echo "<tr>";
                  echo "<td><a href='mviewp.php?pid=$pid'>" . $row['P_CODE'] . "</a></td>";
                  echo "<td><a href='mviewp.php?pid=$pid'>" . $row['TO_NAME'] . "</a></td>";
                  echo "<td><a href='mviewp.php?pid=$pid'>" . $row['TO_ADDRESS'] . "</a></td>";
                  echo "<td><a href='mviewp.php?pid=$pid'>" . $row['TO_CITY'] . "</a></td>";
                  echo "<td><a href='mviewp.php?pid=$pid'>" . $row['TO_PIN'] . "</a></td>";
                  echo "<td><a href='mviewp.php?pid=$pid'>" . $row['TO_PHONE'] . "</a></td>";
                  echo "<td><a href='mviewp.php?pid=$pid'>" . $row['C_CODE'] . "</a></td>";
                  echo "</tr>";
                }
                
                echo "</table>";
              }
              ?>
            </div>
            <br><br>
            <div class="container border border-3 rounded-3 p-5 bg-light">
            <h1>Delivered Packages:</h1><br><br>
              <?php 
              if($count3 == 0) {
                echo "No packages";
              }
              else {
                echo "<table class='table table-hover text-center'><tr><th>P_Code</th><th>Receiver Name</th><th>Address</th><th>City</th><th>Pin</th><th>Phone</th><th>C_Code</tr>";
                
                while($row = mysqli_fetch_array($result4, MYSQLI_ASSOC)) {
                  $pid = $row['P_CODE'];
                  echo "<tr>";
                  echo "<td><a href='mviewp.php?pid=$pid'>" . $row['P_CODE'] . "</a></td>";
                  echo "<td><a href='mviewp.php?pid=$pid'>" . $row['TO_NAME'] . "</a></td>";
                  echo "<td><a href='mviewp.php?pid=$pid'>" . $row['TO_ADDRESS'] . "</a></td>";
                  echo "<td><a href='mviewp.php?pid=$pid'>" . $row['TO_CITY'] . "</a></td>";
                  echo "<td><a href='mviewp.php?pid=$pid'>" . $row['TO_PIN'] . "</a></td>";
                  echo "<td><a href='mviewp.php?pid=$pid'>" . $row['TO_PHONE'] . "</a></td>";
                  echo "<td><a href='mviewp.php?pid=$pid'>" . $row['C_CODE'] . "</a></td>";
                  echo "</tr>";
                }
                
                echo "</table>";
              }
              ?>
            </div><br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script></body>

</html>
