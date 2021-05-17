<!DOCTYPE html>
<html>
    <head>
        <title>Courier Management</title>
        <link rel = "stylesheet" type = "text/css" href = "style.css">
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

    $sql = "SELECT * FROM COURIER 
            WHERE B_CODE = (SELECT B_CODE FROM MANAGER
                            WHERE M_CODE = '$user')";

    $result = mysqli_query($con, $sql);
    ?>
    <body>
        <div class="navbar">
          <div class="dropdown">
            <button class="dropbtn">&#9776;
            </button>
            <div class="dropdown-content">
              <a href="#">Update account details</a>
              <a href="logout.php?type=2">Logout</a>
            </div>
          </div>
          <span class="navbtn"><?php echo $name?></span>
          <a href="logout.php?type=2" style="float: right"><span class="navbtn">Logout</span></a>
        </div>
        <div class="sidebar">
            <a href="mhome.php" style="color: grey">View Couriers</a>
            <a href="massign.php">View Packages</a>
            <a href="mnewc.php">Add New Courier</a>
            <a href="#">Your Account</a>
        </div>

        <div class="d2">
            All Couriers:<br><br>
            <div class="d3">
                <?php 
                     echo "<table class='table'><tr class='thead'><th>C_Code</th><th>Courier Name</th><th>Phone</th><th>Number of Packages</th></tr>";
                
                     while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                       $cid = $row['C_CODE'];
                       echo "<tr>";
                       echo "<td>" . $row['C_CODE'] . "</td>";
                       echo "<td>" . $row['C_NAME'] . "</td>";
                       echo "<td>" . $row['C_PHONE'] . "</td>";
                       echo "<td>" . $row['P_COUNT'] . "</td>";
                       echo "</tr>";
                     }
                     echo "</table>";
                ?>
            </div>
        </div>
    </body>

</html>
