<!DOCTYPE html>
<html>
    <head>
        <title>Courier Management</title>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">   
       <link href="style.css" rel="stylesheet">
        
    </head>
    

    <?php
    include('conn.php');
    session_start();
    if((!isset($_SESSION['use'])) || (!isset($_SESSION['data']))) {
        header("Location: logout.php?type=0");
    }
    $user = $_SESSION['use'];
    $data = $_SESSION['data'];

    $sql1 = "SELECT * FROM CUSTOMER WHERE CS_CODE='$user'";
    $res1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC);
    $name = $row1['CS_NAME'];
    $err="";
    $sql="";


    $cost = 50 * $data[6];

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $pymt = $_POST['pymt'];

        if($data[8] == "") {
            $sql = "INSERT INTO `PACKAGE` (`P_CODE`, `TO_NAME`, `TO_ADDRESS`, `TO_CITY`, `TO_PIN`, `TO_PHONE`, `P_CONTENTS`, `P_WEIGHT`, `P_COST`, `PYMT_STATUS`, `D_DATE`, `C_CODE`, `R_EMAIL`, `RC_CODE`, `CS_CODE`, `COMMENTS`, `STATUS`) VALUES (NULL, '$data[0]', '$data[2]', '$data[3]', '$data[4]', '$data[9]', '$data[5]', '$data[6]', '$cost', '$pymt', '2029-12-31', NULL, '$data[1]', NULL, '$user', '$data[7]', 'Processing Request')";
        }
        else {
            $sql = "INSERT INTO `PACKAGE` (`P_CODE`, `TO_NAME`, `TO_ADDRESS`, `TO_CITY`, `TO_PIN`, `TO_PHONE`, `P_CONTENTS`, `P_WEIGHT`, `P_COST`, `PYMT_STATUS`, `D_DATE`, `C_CODE`, `R_EMAIL`, `RC_CODE`, `CS_CODE`, `COMMENTS`, `STATUS`) VALUES (NULL, '$data[0]', '$data[2]', '$data[3]', '$data[4]', '$data[9]', '$data[5]', '$data[6]', '$cost', '$pymt', '2029-12-31', NULL, '$data[1]', '$data[8]', '$user', '$data[7]', 'Processing Request')";
        }
        if(mysqli_query($con, $sql)) {
            header("Location: chome.php?type=1");
        }
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
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
              <a class="nav-link" aria-current="page" href="chome.php">
                Track Packages</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="cviewdp.php">
                Delivered Packages</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="cpack.php">
                Send Package</a>
            </li>
          </ul>

          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="logout.php?type=0">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="24" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                  <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                </svg>
                Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>  <br><br>

    <div class="container" id="send">
        <div class="row justify-content-md-center">
            <div class="col-md-6 p-5 border rounded border-3   bg-light">
                <h1 class="text-center">Send Package</h1><br><br>
            Amount = Rs <?php echo $cost; ?><br><br><br>
            <form name="f2" id="spfrm" action="<?php
            echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

                <label for="pymt">Payment Method:<br></label>

                <select name="pymt" id="pymt" required>
                    <option value=""></option>
                    <option value="Cash">Cash</option>
                    <option value="Credit Card">Credit Card</option>
                </select><br><br>
                <?php echo "<div class='err'>$err<br></div>";?>
                <input type="submit" class="btn btn-primary float-end" value="Place Order"/><br><br><br>
                <input type="button" class="btn btn-primary float-end" value="&#8592 Back" onclick="goBack()"/>
            </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script></body>
</html>