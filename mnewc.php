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

    $sql1 = "SELECT * FROM MANAGER WHERE M_CODE='$user'";
    $res1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC);
    $name = $row1['M_NAME'];
    $bcode = $row1['B_CODE'];

    $cname = "";
    $email = "";
    $phone = "";
    $err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $cname = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        if((trim($cname) == "") || (trim($email) == "") || (trim($phone) == "")) {
            $err = "Fill in all fields";
        }
        else if(preg_match("/^[a-zA-Z ]*$/", $cname) == 0) {
            $err = "Enter valid name";
        }
        else if(preg_match('/[0-9]{10}/', $phone) == 0) {
            $err = "Enter valid phone number";
        }
        else {
            $sqlc = "SELECT C_EMAIL AS EMAIL
                    FROM COURIER 
                    WHERE C_EMAIL = '$email'
                    UNION
                    SELECT M_EMAIL AS EMAIL
                    FROM MANAGER
                    WHERE M_EMAIL = '$email'";
            $resc = mysqli_query($con, $sqlc);
            $count = mysqli_num_rows($resc);
            if($count != 0) {
                $err = "Email is already in use";
            }
        }   

        if($err == "") {
            $sqli = "INSERT INTO `COURIER` (`C_CODE`, `C_NAME`, `C_PHONE`, `C_EMAIL`, `B_CODE`, `C_PASS`, `P_COUNT`) VALUES (NULL, '$cname', '$phone', '$email', '$bcode', 'pass', '0')";
            if(mysqli_query($con, $sqli)) {
                header("Location: mnewcs.php");
            }
            else {
                echo "Error: " . $sqli . "<br>" . mysqli_error($con);
            }
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
              <a href="logout.php?type=2">Logout</a>
            </div>
          </div>
          <span class="navbtn"><?php echo $name?></span>
          <a href="logout.php?type=2" style="float: right"><span class="navbtn">Logout</span></a>
        </div>
        <div class="sidebar">
            <a href="mhome.php">View Couriers</a>
            <a href="massign.php">View Packages</a>
            <a href="mnewc.php"  style="color: grey">Add New Courier</a>
            <a href="#">Your Account</a>
        </div>
        <br><br><br>
        <div class="frm">
          <h1>Add new Courier</h1>
          <form name="f1" id="spfrm" action="<?php
            echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id="regfrm">
            <table cellpadding="10px">
              <tr>
                <td>
                  Name:<br>
                  <input type="text" name="name" maxlength="20" value="<?php echo $cname; ?>" required>
                </td>
                </tr>
                <tr>
                <td>
                  Email:<br>
                  <input type="email" name="email" maxlength="20" value="<?php echo $email; ?>" required>
                  </td>
                  </tr>
                  <tr>
                <td>
                  Phone:<br>
                  <input type="text" name="phone" maxlength="10" value="<?php echo $phone; ?>" required></td>
             </tr>
            </table>
            <?php
                    echo "<div class='err'>";
                    echo $err;
                    echo "</div><br>";
                    ?>
                    <br>
        <input type="submit" class="btn" value="Next &#8594"/>
        </form>
        </div>

        </body>
        </html>
