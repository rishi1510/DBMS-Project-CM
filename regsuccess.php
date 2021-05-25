<!DOCTYPE html>
<html>
<head>
    <title>Courier Management</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">   <link href="style.css" rel="stylesheet">

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
      <a href="contact.php" ><span class="navbtn">Contact Us</span></a>
      <a href="reg.php" style="float: right"><span class="navbtn">Sign Up</span></a>
    </div>
    <div class="sidebar">
            <a href="clog.php">Customer Login</a>
            <a href="crlog.php">Courier Login</a>
            <a href="#">Manager Login</a>
    </div>

    <div class="frm">
    <h2>Registered successfully</h2><br><br>
    <a href="clog.php" style="float: right" class="btn">Login</a>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script></body>
</html>
