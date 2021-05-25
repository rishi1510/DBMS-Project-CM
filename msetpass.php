<!DOCTYPE html>
<html>
    <head>
        <title>Courier Management</title>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">   <link href="style.css" rel="stylesheet">
    </head>

    <?php
    include('conn.php');
    session_start();
    if(!isset($_SESSION['muse'])) {
        header("Location: logout.php?type=1");
    }
    $user = $_SESSION['muse'];

    $sql1 = "SELECT * FROM MANAGER WHERE M_CODE='$user'";
    $res1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC);
    $name = $row1['M_NAME'];

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
            $sql = "UPDATE MANAGER SET M_PASS = '$pass1' WHERE M_CODE = '$user'";
            if(!mysqli_query($con, $sql)) { 
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
            else {
                header("Location: mhome.php?type=4");
            }
        }
    }
    ?>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="24" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
            <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
          </svg>
          <?php echo $name; ?>
        </a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="mhome.php">
                View Couriers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="massign.php">
                View Packages</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="mnewc.php">
                New Courier</a>
            </li>
          </ul>

          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="logout.php?type=2">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="24" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                  <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                </svg>
                Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav><br><br>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-5 p-5 border rounded border-3 bg-light">       
                <h1>Set Password</h1><br>
                    <form name="f1" action="<?php
                    echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                        Password:<br><input type="password" name="pass1" id="pass1" required/><br><br>
                        Re-enter Password:<br><input type="password" name="pass2" id="pass2" required/><br><br>
                        <input type="submit" class="btn btn-primary float-end" name="Submit" value="Submit"/><br>
                    </form>
                    <br>
                    <?php
                        echo '<div class="err">';
                        echo $err;
                        echo '</div>';
                    ?>
                </div>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script></body>

</html>
