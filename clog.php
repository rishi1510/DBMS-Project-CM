<!doctype html>
<html>
<head>
    <title>Courier Management</title>
    <link rel = "stylesheet" type = "text/css" href = "style.css">

</head>
<?php
session_start();
if(isset($_SESSION['use'])) {
    header("Location: logout.php?type=0");
}

include('conn.php');
$login = "";
$email = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $sql = "SELECT CS_CODE, CS_EMAIL, CS_PASSWORD FROM CUSTOMER WHERE CS_EMAIL='$email' AND CS_PASSWORD='$pass'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    $user = $row['CS_CODE'];

    if ($count == 1) {
        $_SESSION['use'] = $user;
        echo '<script type="text/javascript"> window.open("chome.php","_self");</script>';
        exit;
    }
    else {
        $login =  "Username or Password is invalid";
    }
}
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
            <a href="clog.php" style="color: grey">Customer Login</a>
            <a href="crlog.php">Courier Login</a>
            <a href="mlog.php">Manager Login</a>
            <a href="contact.php">Contact Us</a>
    </div>
    <div class="frm">
        <h1>Login</h1>
         <form name="f1" action="<?php
            echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
              Email:<br><input type="email" name="email" id="email" value="<?php echo $email;?>"/><br><br>
             Password:<br><input type="password" name="pass" id="pass"/><br><br><br>
        <input type="submit" class="btn" name="Login" value="Login"/>
         </form>
        <br>
        <?php
            echo '<div class="err">';
            echo $login;
            echo '</div><br>';
        ?>
        <br>
        <a href="reg.php">Don't have an account? Sign up here</a>
    </div>
</body>
