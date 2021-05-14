<!doctype html>
<html>
<head>
    <title>Courier Management</title>
    <link rel = "stylesheet" type = "text/css" href = "style.css">

</head>
<?php
session_start();
if(isset($_SESSION['use'])) {
    header("Location: logout.php");
}

include('conn.php');
$login = "";
$email = "";
$username="";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $pass = $_POST['pass'];

    $sql = "SELECT M_CODE, M_USER, M_PASS FROM MANAGER WHERE M_USER='$username' AND M_PASS='$pass'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    $user = $row['M_CODE'];

    if ($count == 1) {
        $_SESSION['use'] = $user;
        echo '<script type="text/javascript"> window.open("index.html","_self");</script>';
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
            <a href="clog.php">Customer Login</a>
            <a href="crlog.php">Courier Login</a>
            <a href="mlog.php" style="color: grey">Manager Login</a>
            <a href="#">Contact Us</a>
    </div>

    <div class="frm">
        <h1>Manager Login</h1>
    <form name="f1" action="<?php
    echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        Username:<br><input type="text" name="username" id="username" value="<?php echo $username;?>"/><br><br>
        Password:<br><input type="password" name="pass" id="pass"/><br><br>
        <input type="submit" class="btn" name="Login" value="Login"/>
    </form>
    <br>
    <?php
    if($login != "") {
        echo '<div class="err">';
        echo $login;
        echo '</div>';
    }
    else {
        echo '<br>';
    }?>
</div>
</body>
