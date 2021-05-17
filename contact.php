<!doctype html>
<html>
<head>
    <title>Courier Management</title>
    <link rel = "stylesheet" type = "text/css" href = "style.css">

</head>
<?php
include('conn.php');
?>

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
            <a href="contact.php" style="color: grey">Contact Us</a>
    </div>
    <div class="d2" style="margin-top:25px">
       <h2>Contact Us</h2>
        <div class="d3" style="margin-left:5%">
        <?php
            $sqlb = "SELECT * FROM BRANCH";
            $resb = mysqli_query($con, $sqlb);
            while($row = mysqli_fetch_array($resb)) {
                echo "<h3>" . $row['B_NAME'] . ":</h3>" . $row['B_ADDRESS'] . "<br>" . $row['B_CITY'] . " - " . $row['B_PIN'] . "<br>Phone Number: " . $row['B_PHONE'];
                echo "<br><br><br>";
            }
            ?>
            </div>
    </div>
</body>
