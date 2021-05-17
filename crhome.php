<!DOCTYPE html>
<html>
    <head>
        <title>Courier Management</title>
        <link rel = "stylesheet" type = "text/css" href = "style.css">
    </head>

    <?php
    include('conn.php');
    session_start();
    if(!isset($_SESSION['cruse'])) {
        header("Location: logout.php?type=1");
    }
    $user = $_SESSION['cruse'];

    $sql1 = "SELECT * FROM COURIER WHERE C_CODE='$user'";
    $res1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC);
    $name = $row1['C_NAME'];
    $pass = $row1['C_PASS'];

    if(strcmp($pass, 'pass') == 0) {
      header("Location: crsetpass.php");
    }

    $sql2 = "SELECT * FROM PACKAGE WHERE C_CODE='$user' AND STATUS != 'Delivered'";
    $result2 = mysqli_query($con, $sql2);
    $count1 = mysqli_num_rows($result2);

    $sql3 = "SELECT * FROM PACKAGE WHERE C_CODE='$user' AND STATUS = 'Delivered'";
    $result3 = mysqli_query($con, $sql3);
    $count2 = mysqli_num_rows($result3);
    ?>
    <body>
        <div class="navbar">
          <div class="dropdown">
            <button class="dropbtn">&#9776;
            </button>
            <div class="dropdown-content">
              <a href="#">Update account details</a>
              <a href="logout.php?type=1">Logout</a>
            </div>
          </div>
          <span class="navbtn"><?php echo $name?></span>
          <a href="logout.php?type=1" style="float: right"><span class="navbtn">Logout</span></a>
        </div>
        <div class="sidebar">
            <a href="crhome.php" style="color: grey">View Packages</a>
            <a href="#">Your Account</a>
        </div>

        <div class="d2">
            All Packages:<br><br>
            <div class="d3">
              <?php 
              if($count1 == 0) {
                echo "You have no packages to deliver";
              }
              else {
                echo "<table class='table'><tr class='thead'><th>P_Code</th><th>Receiver Name</th><th>Address</th><th>City</th><th>Pin</th><th>Phone</th></tr>";
                
                while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                  $pid = $row['P_CODE'];
                  echo "<tr>";
                  echo "<td><a href='crviewp.php?pid=$pid'>" . $row['P_CODE'] . "</a></td>";
                  echo "<td><a href='crviewp.php?pid=$pid'>" . $row['TO_NAME'] . "</a></td>";
                  echo "<td><a href='crviewp.php?pid=$pid'>" . $row['TO_ADDRESS'] . "</a></td>";
                  echo "<td><a href='crviewp.php?pid=$pid'>" . $row['TO_CITY'] . "</a></td>";
                  echo "<td><a href='crviewp.php?pid=$pid'>" . $row['TO_PIN'] . "</a></td>";
                  echo "<td><a href='crviewp.php?pid=$pid'>" . $row['TO_PHONE'] . "</a></td>";
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
              if($count2 == 0) {
                echo "No packages";
              }
              else {
                echo "<table class='table'><tr class='thead'><th>P_Code</th><th>Receiver Name</th><th>Address</th><th>City</th><th>Pin</th><th>Phone</th><th>Delivery Date</tr>";
                
                while($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                  $pid = $row['P_CODE'];
                  echo "<tr>";
                  echo "<td><a href='crviewp.php?pid=$pid'>" . $row['P_CODE'] . "</a></td>";
                  echo "<td><a href='crviewp.php?pid=$pid'>" . $row['TO_NAME'] . "</a></td>";
                  echo "<td><a href='crviewp.php?pid=$pid'>" . $row['TO_ADDRESS'] . "</a></td>";
                  echo "<td><a href='crviewp.php?pid=$pid'>" . $row['TO_CITY'] . "</a></td>";
                  echo "<td><a href='crviewp.php?pid=$pid'>" . $row['TO_PIN'] . "</a></td>";
                  echo "<td><a href='crviewp.php?pid=$pid'>" . $row['TO_PHONE'] . "</a></td>";
                  $date = date('d-m-Y', strtotime($row['D_DATE']));
                  echo "<td><a href='cviewop.php?pid=$pid'>$date</a></td>";
                  echo "</tr>";
                }
                
                echo "</table>";
              }
              ?>
            </div>
        </div>
    </body>

</html>
