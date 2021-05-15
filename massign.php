<!DOCTYPE html>
<html>
    <head>
        <title>Courier Management</title>
        <link rel = "stylesheet" type = "text/css" href = "style.css">
    </head>

    <?php
    include('conn.php');
    session_start();
    if(!isset($_SESSION['use'])) {
        header("Location: logout.php");
    }
    $user = $_SESSION['use'];

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
    <div class="navbar">
          <div class="dropdown">
            <button class="dropbtn">&#9776;
            </button>
            <div class="dropdown-content">
              <a href="#">Update account details</a>
              <a href="logout.php">Logout</a>
            </div>
          </div>
          <span class="navbtn"><?php echo $name?></span>
          <a href="logout.php" style="float: right"><span class="navbtn">Logout</span></a>
        </div>
        <div class="sidebar">
            <a href="mhome.php">View Couriers</a>
            <a href="massign.php"  style="color: grey">View Packages</a>
            <a href="#">Add New Courier</a>
            <a href="#">Your Account</a>
        </div>

        <div class="d2">
            Unassigned Packages:<br><br>
            <div class="d3">
              <?php 
              if($count1 == 0) {
                echo "No packages to assign";
              }
              else {
                echo "<table class='table'><tr class='thead'><th>P_Code</th><th>Receiver Name</th><th>Address</th><th>City</th><th>Pin</th><th>Phone</th></tr>";
                
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
            Assigned Packages:<br><br>
            <div class="d3">
              <?php 
              if($count2 == 0) {
                echo "No packages";
              }
              else {
                echo "<table class='table'><tr class='thead'><th>P_Code</th><th>Receiver Name</th><th>Address</th><th>City</th><th>Pin</th><th>Phone</th><th>C_Code</tr>";
                
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
            Delivered Packages:<br><br>
            <div class="d3">
              <?php 
              if($count3 == 0) {
                echo "No packages";
              }
              else {
                echo "<table class='table'><tr class='thead'><th>P_Code</th><th>Receiver Name</th><th>Address</th><th>City</th><th>Pin</th><th>Phone</th><th>C_Code</tr>";
                
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
            </div>
        </div>
    </body>

</html>
