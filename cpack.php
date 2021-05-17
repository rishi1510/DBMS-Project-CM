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

    $sql1 = "SELECT CS_NAME, CS_EMAIL FROM CUSTOMER WHERE CS_CODE='$user'";
    $res1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC);
    $name = $row1['CS_NAME'];
    $userMail = $row1['CS_EMAIL'];
    $tname = "";
    $email = "";
    $phone = "";
    $address = "";
    $city ="";
    $pin = "";
    $type = "";
    $weight = "";
    $comment = "";
    $err1="";
    $err2="";
    $emptyErr="";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $tname = $_POST['tname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $city = $_POST['branch'];
        $pin = $_POST['pin'];
        $type = $_POST['type'];
        $weight = $_POST['weight'];
        $comment = $_POST['comment'];

        if((trim($tname) == "") || (trim($email) == "") || (trim($address) == "") || (trim($city) == "") || (trim($pin) == "") || (trim($type) == "") || (trim($weight) == "")) {
          $emptyErr = "Please fill in all fields";
        }
        $sql2 = "SELECT CS_CODE FROM CUSTOMER WHERE CS_EMAIL='$email'";
        $res2 = mysqli_query($con, $sql2);
        $row2 = mysqli_fetch_array($res2, MYSQLI_ASSOC);
        $count = mysqli_num_rows($res2);
        if($count == 0) {
           $rcode = "";
        }
        else {
          $rcode = $row2['CS_CODE'];
        }
        

        $nameVal = "/^[a-zA-Z ]*$/";

        if(strcmp($userMail, $email) == 0) {
          $err1 = "You cannot send a package to yourself";
        }
        else if(preg_match($nameVal, $tname) == 0) {
            $err1 = "Enter valid name";
        }
        else if(preg_match('/[0-9]{10}/', $phone) == 0) {
            $err1 = "Enter valid phone number";
        }

        if(preg_match('/[0-9]{6}/', $pin) == 0) {
          $err2 = "Enter valid pin";
        }

        if(($emptyErr == "") && ($err1 == "") && ($err2 == "")) {
          $data = array($tname, $email, $address, $city, $pin, $type, $weight, $comment, $rcode, $phone);

          $_SESSION['data'] = $data;
          header("Location: cpack2.php");
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
            <a href="#">Your Account</a>
            <a href="#">Contact Us</a>
        </div>
        <br><br>
        <div class="frm" id="send">
          <h1>Send Package</h1>
          <form name="f1" id="spfrm" action="<?php
            echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id="regfrm">
            <table cellpadding="10px">
              <tr>
                <td>
                  Name of receiver:<br>
                  <input type="text" name="tname" maxlength="20" value="<?php echo $tname; ?>" required>
                </td>
                <td>
                  Email:<br>
                  <input type="email" name="email" maxlength="20" value="<?php echo $email; ?>" required></td>
                <td>
                  Phone:<br>
                  <input type="text" name="phone" maxlength="10" value="<?php echo $phone; ?>" required></td>
                  <td>
                  <?php
                    echo "<div class='err'><br>";
                    echo $err1;
                    echo "</div>";
                    ?>
                </td>
             </tr>
             <tr>
                <td>Address:<br>
                    <textarea rows=3 style="resize: none" name="address" maxlength="50"><?php echo $address ?></textarea>
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
                <td>Pin:
                <input type="text" name="pin" maxlength="6" size="6" value="<?php echo $pin; ?>" required></td>
             </tr> 
             <tr>
                <td>
                 Package Contents:<br>
                 <textarea rows=3 style="resize: none" name="type" maxlength="50"><?php echo $type ?></textarea>
                </td>
                <td>
                  Package Weight(in kg):<br>
                  <input type="number" name="weight" min="1" max=50 value="<?php echo $weight; ?>" required>
                  </td>
                  </tr> 
                  <tr>
                  <td>Comments(Optional):<br>
                    <textarea rows=3 style="resize: none" name="comment" maxlength="50"><?php echo $comment ?></textarea>
                </td>
            </table>
            <?php
                    echo "<div class='err'>";
                    echo $emptyErr, $err2;
                    echo "</div><br>";
                    ?>
                    <br>
        <input type="submit" class="btn" value="Next &#8594"/>
        </form>
        </div>
    </body>

</html>