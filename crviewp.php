!DOCTYPE html>
<html>
    <head>
        <title>Courier Management</title>
        <link rel = "stylesheet" type = "text/css" href = "style.css">

        <script>
           function goBack() {
                window.open("crhome.php","_self");
            }
        </script>
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
    $code = $_GET['pid'];
    $sub = 0;

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $sqlu = "UPDATE PACKAGE SET STATUS = 'Delivered', D_DATE = CURRENT_DATE WHERE P_CODE = '$code'";
        if(!mysqli_query($con, $sqlu)) { 
            echo "Error: " . $sqlu . "<br>" . mysqli_error($con);
        }
        else {
            $sqldp = "UPDATE COURIER SET P_COUNT = P_COUNT - 1 WHERE C_CODE = '$user'";
            if(!mysqli_query($con, $sqldp)) { 
                echo "Error: " . $sqldp . "<br>" . mysqli_error($con);
            }
        }
        $sub = 1;
    }

    $sql = "SELECT * FROM PACKAGE WHERE P_CODE = '$code'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
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
          <input type="button" class="navbtn" value="&#8592" onclick="goBack()"/>
          <span class="navbtn"><?php echo $name?></span>
          <a href="logout.php?type=1" style="float: right"><span class="navbtn">Logout</span></a>
        </div>
        <div class="sidebar">
            <a href="crhome.php" style="color: grey">View Packages</a>
            <a href="#">Your Account</a>
        </div>
        <div class="d2">
        Package details:
        <?php
        if(($sub == 0) && (strcmp($row['STATUS'], 'Delivered') != 0)) {
            echo '<form method="POST">';
            echo '<input type="submit" class="btn2" value="Mark As Delivered"/>';
            echo '</form>';
        }
        ?>
          <div class="d3">
              <table class="table2" cellspacing="20px">
              <tr>
              <th>Package Code:</th>
              <td><?php echo $row['P_CODE'];?></td>
              </tr>
              <tr>
              <th>To:</th>
              <td><?php echo $row['TO_NAME'];?></td>
              </tr>
              <tr>
              <th>Address:</th>
              <td><?php echo $row['TO_ADDRESS'];?></td>
              </tr>
              <tr>
              <th>City:</th>
              <td><?php echo $row['TO_CITY'];?></td>
              </tr>
              <tr>
              <th>Pin code:</th>
              <td><?php echo $row['TO_PIN'];?></td>
              </tr>
              <tr>
              <th>Phone Number:</th>
              <td><?php echo $row['TO_PHONE'];?></td>
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
              <th>Status:</th>
              <td><?php echo $row['STATUS'];?></td>
              </tr>
              <tr>
              <th>Comments:</th>
              <td><?php echo $row['COMMENTS'];?></td>
              </tr>
              </table>
              </div>
        </div>
    </body>

</html>