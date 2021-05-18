<!DOCTYPE html>
<html>
    <head>
        <title>Courier Management</title>
        <link rel = "stylesheet" type = "text/css" href = "style.css">
        <script>
            function goBack() {
                window.open("cpack.php","_self");
            }
            </script>
    </head>

    <?php
    include('conn.php');
    session_start();
    if((!isset($_SESSION['use'])) || (!isset($_SESSION['data']))) {
        header("Location: logout.php?type=0");
    }
    $user = $_SESSION['use'];
    $data = $_SESSION['data'];

    $sql1 = "SELECT * FROM CUSTOMER WHERE CS_CODE='$user'";
    $res1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC);
    $name = $row1['CS_NAME'];
    $err="";
    $sql="";


    $cost = 50 * $data[6];

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $pymt = $_POST['pymt'];

        if($data[8] == "") {
            $sql = "INSERT INTO `PACKAGE` (`P_CODE`, `TO_NAME`, `TO_ADDRESS`, `TO_CITY`, `TO_PIN`, `TO_PHONE`, `P_CONTENTS`, `P_WEIGHT`, `P_COST`, `PYMT_STATUS`, `D_DATE`, `C_CODE`, `R_EMAIL`, `RC_CODE`, `CS_CODE`, `COMMENTS`, `STATUS`) VALUES (NULL, '$data[0]', '$data[2]', '$data[3]', '$data[4]', '$data[9]', '$data[5]', '$data[6]', '$cost', '$pymt', '2029-12-31', NULL, '$data[1]', NULL, '$user', '$data[7]', 'Processing Request')";
        }
        else {
            $sql = "INSERT INTO `PACKAGE` (`P_CODE`, `TO_NAME`, `TO_ADDRESS`, `TO_CITY`, `TO_PIN`, `TO_PHONE`, `P_CONTENTS`, `P_WEIGHT`, `P_COST`, `PYMT_STATUS`, `D_DATE`, `C_CODE`, `R_EMAIL`, `RC_CODE`, `CS_CODE`, `COMMENTS`, `STATUS`) VALUES (NULL, '$data[0]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[9]', '$data[6]', '$cost', '$pymt', '2029-12-31', NULL, '$data[1]', '$data[8]', '$user', '$data[7]', 'Processing Request')";
        }
        if(mysqli_query($con, $sql)) {
            header("Location: sendsuccess.php");
        }
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }

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
            <a href="chome.php">Track Packages</a>
            <a href="cpack.php"  style="color: grey">Send Package</a>
            <a href="cviewdp.php">View Delivered Packages</a>
            <a href="#">Your Account</a>
            <a href="#">Contact Us</a>
        </div>
        <div class="frm">
            Amount = Rs <?php echo $cost; ?><br><br><br>
            <form name="f2" id="spfrm" action="<?php
            echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

                <label for="pymt">Payment Method:<br></label>

                <select name="pymt" id="pymt" required>
                    <option value=""></option>
                    <option value="Cash">Cash</option>
                    <option value="Credit Card">Credit Card</option>
                </select><br><br><br><br>
                <?php echo "<div class='err'>$err<br></div>";?>
                <input type="submit" class="btn" value="Place Order"/><br><br>
                <input type="button" class="btn" value="&#8592 Back" onclick="goBack()"/>
            </form>

            <?php echo $sql; ?>
    </body>
</html>