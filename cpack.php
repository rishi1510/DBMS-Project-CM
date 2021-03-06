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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="cacc.php">
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
    </nav>  
        <br><br>
        <div class="container" id="send">
        <div class="row justify-content-md-center">
            <div class="col-md-auto p-5 border rounded    bg-light shadow-lg">
              <h1 class="text-center">Send Package</h1>
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
                      <?php
                        echo "<div class='text-danger'><br>";
                        echo $err1;
                        echo "</div>";
                        ?>
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
                    <input type="text" name="pin" maxlength="6" size="8" value="<?php echo $pin; ?>" required></td>
                </tr> 
                <tr>
                    <td>
                    Package Contents:<br>
                    <textarea rows=3 style="resize: none" name="type" maxlength="50"><?php echo $type ?></textarea>
                    </td>
                    <td>
                      Package Weight(in kg):
                      <input type="number" name="weight" min="1" max=50 value="<?php echo $weight; ?>" required>
                      </td>
                      </tr> 
                      <tr>
                      <td>Comments(Optional):<br>
                        <textarea rows=3 style="resize: none" name="comment" maxlength="50"><?php echo $comment ?></textarea>
                    </td>
                </table>
                <?php
                        echo "<div class='text-danger'>";
                        echo $emptyErr, $err2;
                        echo "</div><br>";
                        ?>
                        <br>
            <input type="submit" class="btn btn-primary float-end" value="Next &#8594"/>
            </form>
              </div>
            </div>
        </div><br><br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script></body>

</html>