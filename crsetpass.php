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

    $err = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter and one lower case letter";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
    
        $space = preg_match('/\s/', $pass1);
        $number = preg_match('/[0-9]/', $pass1);
        $uppercase = preg_match('/[A-Z]/', $pass1);
        $lowercase = preg_match('/[a-z]/', $pass1);

        if(strlen($pass1) < 8 || !$number || !$uppercase || !$lowercase || $space) {
            $err = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter and one lower case letter";
        } 
        else if(strcmp($pass1, $pass2) != 0){
            $err = "Passwords do not match";
        }
        else {
            $sql = "UPDATE COURIER SET C_PASS = '$pass1' WHERE C_CODE = '$user'";
            if(!mysqli_query($con, $sql)) { 
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
            else {
                header("Location: crhome.php");
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

        <div class="frm">
        <h1>Set Password</h1>
            <form name="f1" action="<?php
            echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                Password:<br><input type="password" name="pass1" id="pass1" required/><br><br>
                Re-enter Password:<br><input type="password" name="pass2" id="pass2" required/><br><br>
                <input type="submit" class="btn" name="Submit" value="Submit"/>
            </form>
            <br>
            <?php
                echo '<div class="err">';
                echo $err;
                echo '</div>';
            ?>
        </div>
    </body>

</html>
