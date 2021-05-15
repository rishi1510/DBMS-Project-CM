<!DOCTYPE html>
<html>
    <head>
        <title>Courier Management</title>
        <link rel = "stylesheet" type = "text/css" href = "style.css">

        <script>
           function goBack() {
                window.open("massign.php","_self");
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

    $sql1 = "SELECT M_NAME FROM MANAGER WHERE M_CODE='$user'";
    $res1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC);
    $name = $row1['M_NAME'];
    $code = $_GET['pid'];
    
    $sub = 0;

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $cr_code = $_POST['cr_code'];
        $sqlu = "UPDATE PACKAGE SET STATUS = 'Courier Assigned', D_DATE = CURRENT_DATE()+5, C_CODE = '$cr_code' WHERE P_CODE = '$code'";
        if(!mysqli_query($con, $sqlu)) { 
            echo "Error: " . $sqlu . "<br>" . mysqli_error($con);
        }
        else {
            $sqldp = "UPDATE COURIER SET P_COUNT = P_COUNT + 1 WHERE C_CODE = '$cr_code'";
            if(!mysqli_query($con, $sqldp)) { 
                echo "Error: " . $sqldp . "<br>" . mysqli_error($con);
            }
        }
        $sub = 1;
    }

    $sql = "SELECT * FROM PACKAGE WHERE P_CODE = '$code'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $status = $row['STATUS'];

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
            <a href="mhome.php">View Couriers</a>
            <a href="massign.php"  style="color: grey">View Packages</a>
            <a href="#">Add New Courier</a>
            <a href="#">Your Account</a>
        </div>

        <div class="d2">
        Package details:
        <?php 
            if((strcmp($status, 'Processing Request') == 0) && ($sub == 0)) {
                echo "<form method='POST' style='font-size:20px'>";
                echo "<br><br><label for='cr_code'>Assign Courier:  </label>";
                echo "<select name='cr_code' id='cr_code' required><option value=''></option>";
                $sqlc = "SELECT * FROM COURIER 
                        WHERE B_CODE = (SELECT B_CODE FROM MANAGER WHERE M_CODE = '$user')";
                $resc = mysqli_query($con, $sqlc);
                while($crow = mysqli_fetch_array($resc, MYSQLI_ASSOC)) {
                    echo "<option value='". $crow['C_CODE']. "'>". $crow['C_CODE']. " - " . $crow['C_NAME'] ."</option>";
                }
                echo "</select>";
                echo "<input type='submit' class='btn' style='margin-left:10%' value='Assign'/>";
                echo "</form>";
            }
        ?>
          <div class="d3">
              <table class="table2" cellspacing="20px">
              <tr>
              <th>Package Code:</th>
              <td><?php echo $row['P_CODE'];?></td>
              </tr>
              <tr>
              <th>Courier Code:</th>
              <td><?php echo $row['C_CODE'];?></td>
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