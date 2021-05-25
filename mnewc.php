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
        header("Location: logout.php?type=2");
    }
    $user = $_SESSION['muse'];

    $sql1 = "SELECT * FROM MANAGER WHERE M_CODE='$user'";
    $res1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC);
    $name = $row1['M_NAME'];
    $bcode = $row1['B_CODE'];

    $cname = "";
    $email = "";
    $phone = "";
    $err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $cname = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        if((trim($cname) == "") || (trim($email) == "") || (trim($phone) == "")) {
            $err = "Fill in all fields";
        }
        else if(preg_match("/^[a-zA-Z ]*$/", $cname) == 0) {
            $err = "Enter valid name";
        }
        else if(preg_match('/[0-9]{10}/', $phone) == 0) {
            $err = "Enter valid phone number";
        }
        else {
            $sqlc = "SELECT C_EMAIL AS EMAIL
                    FROM COURIER 
                    WHERE C_EMAIL = '$email'
                    UNION
                    SELECT M_EMAIL AS EMAIL
                    FROM MANAGER
                    WHERE M_EMAIL = '$email'";
            $resc = mysqli_query($con, $sqlc);
            $count = mysqli_num_rows($resc);
            if($count != 0) {
                $err = "Email is already in use";
            }
        }   

        if($err == "") {
            $sqli = "INSERT INTO `COURIER` (`C_CODE`, `C_NAME`, `C_PHONE`, `C_EMAIL`, `B_CODE`, `C_PASS`, `P_COUNT`, `D_COUNT`) VALUES (NULL, '$cname', '$phone', '$email', '$bcode', 'pass', '0', '0')";
            if(mysqli_query($con, $sqli)) {
                header("Location: mhome.php?type=1");
            }
            else {
                echo "Error: " . $sqli . "<br>" . mysqli_error($con);
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
              <a class="nav-link" aria-current="page" href="mhome.php">
                View Couriers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="massign.php">
                View Packages</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="mnewc.php">
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
              <h1>Add new Courier</h1>
              <form name="f1" id="spfrm" action="<?php
                echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id="regfrm">
                <table cellpadding="10px">
                  <tr>
                    <td>
                      Name:<br>
                      <input type="text" name="name" maxlength="20" value="<?php echo $cname; ?>" required>
                    </td>
                    </tr>
                    <tr>
                    <td>
                      Email:<br>
                      <input type="email" name="email" maxlength="20" value="<?php echo $email; ?>" required>
                      </td>
                      </tr>
                      <tr>
                    <td>
                      Phone:<br>
                      <input type="text" name="phone" maxlength="10" value="<?php echo $phone; ?>" required></td>
                </tr>
                </table>
                <?php
                        echo "<div class='err'>";
                        echo $err;
                        echo "</div><br>";
                        ?>
                        <br>
                <input type="submit" class="btn btn-primary float-end" value="Next &#8594"/>
                </form>
          </div>
        </div>
      </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script></body>
        </html>
