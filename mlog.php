<!doctype html>
<html>
<head>
    <title>Courier Management</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">   <link href="style.css" rel="stylesheet">

   
</head>
<?php
session_start();
if(isset($_SESSION['muse'])) {
    header("Location: logout.php?type=2");
}

include('conn.php');
$login = "";
$email = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $sql = "SELECT M_CODE, M_EMAIL, M_PASS FROM MANAGER WHERE M_EMAIL='$email' AND M_PASS='$pass'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    $user = $row['M_CODE'];

    if ($count == 1) {
        $_SESSION['muse'] = $user;
        echo '<script type="text/javascript"> window.open("mhome.php","_self");</script>';
        exit;
    }
    else {
        $login =  "Username or Password is invalid";
    }
}
?>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="24" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
            <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
          </svg>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index.html">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Staff Login
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="crlog.php">Courier Login</a></li>
                <li><a class="dropdown-item" href="mlog.php">Manager Login</a></li>
                <li><a class="dropdown-item" href="alog.php">Admin Login</a></li>
              </ul>
              
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="track.php">Track Package</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="contact.php">Contact Us</a>
            </li>
          </ul>
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="reg.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="24" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                </svg>
                Sign Up</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="clog.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="24" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                  <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                </svg>
                Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <br><br><br>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-5 p-5 border rounded border-3 bg-light">
                <h1 class="text-center">Manager Login</h1><br>
            <form name="f1" action="<?php
            echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                Email:<br><input type="email" name="email" id="email" value="<?php echo $email;?>"/><br><br>
                Password:<br><input type="password" name="pass" id="pass"/><br><br>
                <input type="submit" class="btn btn-primary float-end" name="Login" value="Login"/><br>
            </form>
            <br>
            <?php
            if($login != "") {
                echo '<div class="text-danger">';
                echo $login;
                echo '</div>';
            }
            else {
                echo '<br>';
            }?>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script></body>
