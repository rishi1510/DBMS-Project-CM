!DOCTYPE html>
<html>
    <head>
        <title>Courier Management</title>
        <link rel = "stylesheet" type = "text/css" href = "style.css">

        <script>
           function goBack() {
                window.open("chome.php","_self");
            }
        </script>
    </head>

    <?php
    include('conn.php');
    session_start();
    if(!isset($_SESSION['use'])) {
        header("Location: logout.php");
    }
    $user = $_SESSION['use'];

    $sql1 = "SELECT CS_NAME FROM CUSTOMER WHERE CS_CODE='$user'";
    $res1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC);
    $name = $row1['CS_NAME'];

    $code = $_GET['pid'];
    $sql = "SELECT * FROM PACKAGE WHERE P_CODE = '$code'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $scode = $row['CS_CODE'];

    $sql2 = "SELECT CS_NAME FROM CUSTOMER WHERE CS_CODE = '$scode'";
    $result2 = mysqli_query($con, $sql2);
    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
    $sname = $row2['CS_NAME'];
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
          <input type="button" class="navbtn" value="&#8592" onclick="goBack()"/>
          <span class="navbtn"><?php echo $name?></span>
          <a href="logout.php" style="float: right"><span class="navbtn">Logout</span></a>
        </div>
        <div class="sidebar">
            <a href="chome.php" style="color: grey">Track Packages</a>
            <a href="cpack.php">Send Package</a>
            <a href="#">Your Account</a>
            <a href="#">Contact Us </a>
        </div>
        <div class="d2">
        Package details:<br><br>
          <div class="d3">
              <table class="table2" cellspacing="20px">
              <tr>
              <th>Package Code:</th>
              <td><?php echo $row['P_CODE'];?></td>
              </tr>
              <tr>
              <th>From:</th>
              <td><?php echo $sname;?></td>
              </tr>
              <tr>
              <th>Contents:</th>
              <td><?php echo $row['P_CONTENTS'];?></td>
              </tr>
              <tr>
              <th>Weight:</th>
              <td><?php echo $row['P_WEIGHT'];?> kg</td>
              </tr>
              <tr>
              <th>Delivery Date:</th>
              <td><?php 
              $date = "  -  ";
              if($row['C_CODE']) {
                  $date = date('d-m-Y', strtotime($row['D_DATE']));
              }
              echo $date;
              ?></td>
              </tr>
              <tr>
              <th>Comments:</th>
              <td><?php echo $row['COMMENTS'];?></td>
              </tr>
              <tr>
              <th>Status:</th>
              <td><?php echo $row['STATUS'];?></td>
              </tr>
              </table>
              </div>
        </div>
    </body>

</html>
