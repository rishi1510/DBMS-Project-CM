<!doctype html>
<html>
<head>
    <title>Courier Management</title>
    <link rel = "stylesheet" type = "text/css" href = "style.css">

    <?php 
    session_start();
    if(isset($_SESSION['use'])) {
        header("Location: logout.php?type=1");
    }

    include('conn.php');
    $pass1err = "";
    $pass2err = "";
    $phoneerr = "";
    $nameerr = "";
    $emailerr = "";
    $emptyerr = "";
    $name = "";
    $phone = "";
    $city = "";
    $address = "";
    $pin = "";
    $email = "";
    $pass1 = "";
    $pass2 = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['cname'];
        $phone = $_POST['phone'];
        $city = $_POST['branch'];
        $address = $_POST['address'];
        $pin = $_POST['pin'];
        $email = $_POST['email'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        
        if((trim($name) == "") || (trim($phone) == "") || (trim($address) == "") || ($city == "") || (trim($email) == "") || (trim($pass1) == "") || (trim($pass2) == "") || (trim($pin) == "")) {
            $emptyerr = "Please fill in all fields";
        }
        else {
            $phonePattern = "/[0-9]{10}/i";
            if(preg_match($phonePattern, $phone) == 0) {
                $phoneerr = "Enter valid phone number";
            } 
            
            $space = preg_match('/\s/', $pass1);
            $number = preg_match('/[0-9]/', $pass1);
            $uppercase = preg_match('/[A-Z]/', $pass1);
            $lowercase = preg_match('/[a-z]/', $pass1);

            if(strlen($pass1) < 8 || !$number || !$uppercase || !$lowercase || $space) {
                $pass1err = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter and one lower case letter";
            } 
            else if(strcmp($pass1, $pass2) != 0){
                $pass2err = "Passwords do not match";
            }

            $nameVal = "/^[a-zA-Z ]*$/";
            if(preg_match($nameVal, $name) == 0) {
                $nameerr = "Enter valid name";
            }

            if(preg_match('/[0-9]{6}/', $pin) == 0) {
                $emptyerr = "Enter valid pin";
            }

            $sqle = "SELECT * FROM CUSTOMER WHERE CS_EMAIL = '$email'";
            $rese = mysqli_query($con, $sqle);
            $count = mysqli_num_rows($rese);

            if($count > 0) {
                $emailerr = "Email is already in use";
            } 

        }
        if(($emptyerr == "") && ($pass1err == "") && ($pass2err == "") && ($phoneerr == "") && ($nameerr == "") && ($emailerr == "")) {
            $sql = "INSERT INTO `CUSTOMER` (`CS_CODE`, `CS_NAME`, `CS_PHONE`, `CS_ADDRESS`, `CS_CITY`, `CS_PIN`, `CS_EMAIL`, `CS_PASSWORD`) VALUES (NULL, '$name', '$phone', '$address', '$city', '$pin',  '$email', '$pass1')";
            if(mysqli_query($con, $sql)) {
                header("Location: regsuccess.php");
            }
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        }
    }

    ?>

</head>
<body>
    <div class="navbar">
        <a href="index.html"><span class="navbtn">Home</span></a>
      <div class="dropdown">
        <button class="dropbtn">&#9776;
        </button>
        <div class="dropdown-content">
          <a href="clog.php">Customer Login</a>
          <a href="crlog.php">Courier Login</a>
          <a href="mlog.php">Manager Login</a>
          <a href="alog.php">Admin Login</a>
        </div>
      </div>
      <a href="reg.php" style="float: right"><span class="navbtn">Sign Up</span></a>
    </div>

    <div class="sidebar">
            <a href="clog.php">Customer Login</a>
            <a href="crlog.php">Courier Login</a>
            <a href="mlog.php">Manager Login</a>
            <a href="#">Contact Us</a>
    </div>
    <br><br>
    <div class="frm" id="signup">
        <h1>Sign Up</h1>
         <form name="f1" action="<?php
            echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id="regfrm">
            <table cellpadding="10px">
            <tr>
                <td> Name:<br>
                <input type="text" name="cname" maxlength="20" value="<?php echo $name?>" required><br></td>
                <td>Phone:<br>
                <input type="text" name="phone" maxlength="10" value="<?php echo $phone?>" required>
                <?php
                    echo "<div class='err'>";
                    echo $phoneerr;
                    echo "</div>";
                    ?>
            </td>
            </tr>
            <tr>
                <td>Address:<br>
                    <textarea rows=3 style="resize: none" name="address" maxlength="50" required><?php echo $address;?></textarea>
                </td>
                <td>
                <label for="branch">City:</label>

                    <select name="branch" id="branch" required>
                        <option value=""></option>
                    <?php 
                    $sqlb = "SELECT B_CITY FROM BRANCH";
                    $resb = mysqli_query($con, $sqlb);
                    while($brow = mysqli_fetch_array($resb, MYSQLI_ASSOC)) {
                    echo "<option value='". $brow['B_CITY']. "'>". $brow['B_CITY']. "</option>";
                    }
                    ?>
                    </select>
                </td>
                <td>
                Pin:
                <input type="text" name="pin" maxlength="6" size="6" value="<?php echo $pin; ?>" required></td>
            </tr>
            <tr>
                <td>
                Email: <br>
                    <input type="email" name="email" id="email" placeholder="person@example.com" maxlength="20" value="<?php echo $email?>" required>
                       <?php
                        echo "<div class='err'>";
                        echo $emailerr;
                        echo "</div>";
                        ?>

               </td>
            </tr>
            <tr>
                <td>
                <br>Password:<br>
                <input type="password" name="pass1" id="pass1" maxlength="20" required/></td><td><br>
                <?php
                    echo "<div class='err'>";
                    echo $pass1err;
                    echo "</div>";
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                Reenter Password:<br>
                <input type="password" name="pass2" id="pass2" maxlength="20" required/></td><td><br>
                <?php
                    echo "<div class='err'>";
                    echo $pass2err;
                    echo "</div>";
                    ?>
                </td>
            </tr>
            </table>
            <?php
                    echo "<div class='err'>";
                    echo $emptyerr;
                    echo "</div><br>";

                    echo "<div class='err'>";
                    echo $nameerr;
                    echo "</div><br>";

                    ?>
        <input type="submit" class="btn" value="Sign Up"/>
         </form>
        <br>
        <a href="clog.php">Already have an account? Login here</a>
    </div>
</body>
