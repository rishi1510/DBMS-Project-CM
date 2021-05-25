<!DOCTYPE html>
<html>
    <head>
        <title>Courier Management</title>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">   <link href="style.css" rel="stylesheet">
    </head>

    <?php
    include('conn.php');
    session_start();
    if(!isset($_SESSION['ause'])) {
        header("Location: logout.php?type=3");
    }
    $user = $_SESSION['ause'];

    $emptyErr = "";
    $err1 = "";
    $err2 = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $pin = $_POST['pin'];

        if((trim($name) == "") || (trim($address) == "") || (trim($city) == "") || (trim($pin) == "")) {
          $emptyErr = "Fill in all fields";
        }
        
        $nameVal = "/^[a-zA-Z ]*$/";

        if(preg_match($nameVal, $name) == 0) {
            $err1 = "Enter valid name";
        }
        else if(preg_match('/[0-9]{10}/', $phone) == 0) {
            $err1 = "Enter valid phone number";
        }

        $sql2 = "SELECT * FROM BRANCH WHERE B_CITY='$city'";
        $res2 = mysqli_query($con, $sql2);
        $row2 = mysqli_fetch_array($res2, MYSQLI_ASSOC);
        $count = mysqli_num_rows($res2);
        if($count != 0) {
           $err2 = "There is already a branch in this city";
        }
        else if(preg_match('/[0-9]{6}/', $pin) == 0) {
          $err2 = "Enter valid pin";
        }

        if(($emptyErr == "") && ($err1 == "") && ($err2 == "")) {
            $sql = "INSERT INTO `BRANCH` (`B_CODE`, `B_NAME`, `B_ADDRESS`, `B_CITY`, `B_PIN`, `B_PHONE`, `M_CODE`) VALUES (NULL, '$name', '$address', '$city', '$pin', '$phone', NULL)";
            if(mysqli_query($con, $sql)) {
                header("Location: ahome.php?type=1");
            }
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
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
          Admin
        </a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="ahome.php">
                View Branches</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="anewb.php">
                Add Branch</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="aviewm.php">
                View Managers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="anewm.php">
                Add Manager</a>
            </li>
          </ul>

          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="logout.php?type=3">
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

    <div class="container" id="send">
        <div class="row justify-content-md-center">
            <div class="col-md-auto p-5 border rounded border-3   bg-light">
              <h1 class="text-center">Add Branch</h1>
              <form name="f1" id="spfrm" action="<?php
                echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id="regfrm">
                <table cellpadding="10px">
                  <tr>
                    <td>
                      Branch Name:<br>
                      <input type="text" name="name" maxlength="20" value="<?php echo $name; ?>" required>
                    </td><td>
                      Phone:<br>
                      <input type="text" name="phone" maxlength="10" value="<?php echo $phone; ?>" required></td>
                      </tr>
                      <tr>
                      <?php
                        echo "<div class='text-danger'><br>";
                        echo $err1;
                        echo "</div>";
                        ?>
                </tr>
                <tr>
                    <td>Address:<br>
                        <textarea rows=3 style="resize: none" name="address" maxlength="50"><?php echo $address ?></textarea>
                    </td></tr><tr>
                    <td>City:<br>
                    <input type="text" name="city" maxlength="20" value="<?php echo $city; ?>" required>
                    </td>
                    <td>Pin:
                    <input type="text" name="pin" maxlength="6" size="6" value="<?php echo $pin; ?>" required></td>
                </tr> 
                </table>
                <?php
                        echo "<div class='text-danger'>";
                        echo $emptyErr . '<br>' . $err2;
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
