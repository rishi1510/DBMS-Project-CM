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
        header("Location: logout.php?type=0");
    }
    $user = $_SESSION['use'];

    $sql1 = "SELECT CS_NAME FROM CUSTOMER WHERE CS_CODE='$user'";
    $res1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC);
    $name = $row1['CS_NAME'];

    $sql2 = "SELECT * FROM PACKAGE WHERE CS_CODE='$user' ORDER BY D_DATE DESC";
    $result2 = mysqli_query($con, $sql2);
    $count1 = mysqli_num_rows($result2);

    $sql3 = "SELECT P_CODE, CUSTOMER.CS_NAME, D_DATE, STATUS FROM PACKAGE 
             INNER JOIN CUSTOMER 
             ON CUSTOMER.CS_CODE = PACKAGE.CS_CODE 
             WHERE RC_CODE = '$user'
             ORDER BY D_DATE DESC";
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
              <a href="logout.php?type=0">Logout</a>
            </div>
          </div>
          <span class="navbtn"><?php echo $name?></span>
          <a href="logout.php?type=0" style="float: right"><span class="navbtn">Logout</span></a>
        </div>
        <div class="sidebar">
            <a href="chome.php" style="color: grey">Track Packages</a>
            <a href="cpack.php">Send Package</a>
            <a href="#">Your Account</a>
            <a href="#">Contact Us</a>
        </div>

        <div class="d2">
            Outgoing packages:<br><br>
            <div class="d3">
              <?php 
              if($count1 == 0) {
                echo "You have no outgoing packages";
              }
              else {
                echo "<table class='table'><tr class='thead'><th>P_Code</th><th>Receiver Name</th><th>Delivery Date</th><th>Status</th></tr>";
                
                while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                  $pid = $row['P_CODE'];
                  echo "<tr>";
                  echo "<td><a href='cviewop.php?pid=$pid'>" . $row['P_CODE'] . "</a></td>";
                  echo "<td><a href='cviewop.php?pid=$pid'>" . $row['TO_NAME'] . "</a></td>";
                  $date = "  -  ";
                  if(isset($row['C_CODE'])) {
                      $date = date('d-m-Y', strtotime($row['D_DATE']));

                  }
                  echo "<td><a href='cviewop.php?pid=$pid'>$date</a></td>";
                  echo "<td><a href='cviewop.php?pid=$pid'>" . $row['STATUS'] . "</a></td>";
                  echo "</tr>";
                }
                
                echo "</table>";
              }
              ?>
            </div>
            <br><br>Incoming Packages<br><br>
            <div class="d3">
              <?php 
              if($count2 == 0) {
                echo "You have no incoming packages";
              }
              else {
                echo "<table class='table'><tr class='thead'><th>P_Code</th><th>Sender Name</th><th>Delivery Date</th><th>Status</th></tr>";
                
                while($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                  $pid = $row['P_CODE'];
                  echo "<tr>";
                  echo "<td><a href='cviewip.php?pid=$pid'>" . $row['P_CODE'] . "</a></td>";
                  echo "<td><a href='cviewip.php?pid=$pid'>" . $row['CS_NAME'] . "</a></td>";
                  $date = "  -  ";
                  if(isset($row['C_CODE'])) {
                      $date = date('d-m-Y', strtotime($row['D_DATE']));

                  }
                  echo "<td><a href='cviewip.php?pid=$pid'>$date</a></td>";
                  echo "<td><a href='cviewip.php?pid=$pid'>" . $row['STATUS'] . "</a></td>";
                  echo "</tr>";
                }
                
                echo "</table>";
              }
              ?>
            </div>
        </div>
    </body>

</html>
