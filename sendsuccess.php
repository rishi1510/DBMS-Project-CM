<!DOCTYPE html>
<html>
    <head>
        <title>Courier Management</title>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">   <link href="style.css" rel="stylesheet">
    </head>

    <?php
    include('conn.php');
    session_start();
    if(!isset($_SESSION['use'])) {
        header("Location: logout.php?type=0");
    }
    $user = $_SESSION['use'];

    $sql1 = "SELECT CS_NAME FROM CUSTOMER WHERE CS_CODE='$user'";
    $res1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC);
    $name = $row1['CS_NAME'];
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
            <a href="cpack.php">Send Package</a>
            <a href="#">Your Account</a>
            <a href="#">Contact Us</a>
        </div>

        <div class="d2">
            Order Placed successfully
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script></body>

</html>
