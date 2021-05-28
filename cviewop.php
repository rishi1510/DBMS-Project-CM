<!DOCTYPE html>
<html>
    <head>
        <title>Courier Management</title>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">   
       <link href="style.css" rel="stylesheet">

        <script>
           function goBack() {
                window.open("chome.php","_self");
            }
        </script>
    </head>

    <?php
    include('conn.php');
    session_start();
    if(!isset($_SESSION['use'])) {
        header("Location: logout.php?type=1");
    }

    $user = $_SESSION['use'];

    $sql1 = "SELECT * FROM CUSTOMER WHERE CS_CODE='$user'";
    $res1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC);
    $name = $row1['CS_NAME'];


    $code = $_GET['pid'];
    $sql = "SELECT * FROM PACKAGE WHERE P_CODE = '$code'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if($_SERVER["REQUEST_METHOD"] == "POST") {
      $sqlu = "DELETE FROM PACKAGE WHERE P_CODE = '$code'";
      if(!mysqli_query($con, $sqlu)) { 
          echo "Error: " . $sqlu . "<br>" . mysqli_error($con);
      }
      header("Location: chome.php?type=2");
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
              <a class="nav-link " aria-current="page" href="cpack.php">
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
        
        <div class="container border shadow-lg rounded-3 p-5 bg-light">
        <h1>Package details:</h1><br>
          <table class="table" >
          <tr>
          <th>Package Code:</th>
          <td><?php echo $row['P_CODE'];?></td>
          </tr>
          <tr>
          <th>To:</th>
          <td><?php echo $row['TO_NAME'];?></td>
          </tr>
          <tr>
          <th>Address:</th>
          <td><?php echo $row['TO_ADDRESS'];?></td>
          </tr>
          <tr>
          <th>City:</th>
          <td><?php echo $row['TO_CITY'];?></td>
          </tr>
          <tr>
          <th>Pin code:</th>
          <td><?php echo $row['TO_PIN'];?></td>
          </tr>
          <tr>
          <th>Phone Number:</th>
          <td><?php echo $row['TO_PHONE'];?></td>
          </tr>
          <tr>
          <th>Contents:</th>
          <td><?php echo $row['P_CONTENTS'];?></td>
          </tr>
          <tr>
          <th>Weight:</th>
          <td><?php echo $row['P_WEIGHT'];?> kg</td>
          </tr>
          <tr>
          <th>Amount:</th>
          <td>Rs <?php echo $row['P_COST'];?></td>
          </tr>
          <tr>
          <th>Delivery Date:</th>
          <td><?php 
          $date = "  -  ";
          if($row['C_CODE']) {
              $date = date('d-m-Y', strtotime($row['D_DATE']));
          }
          echo $date;
          ?></td>
          </tr>
          <tr>
          <th>Comments:</th>
          <td><?php echo $row['COMMENTS'];?></td>
          </tr>
          <tr>
          <th>Status:</th>
          <td><?php echo $row['STATUS'];?></td>
          </tr>
          </table>
          <br>
          <?php
            if(strcmp($row['STATUS'], 'Delivered') != 0) {
                echo '<form method="POST">';
                echo '<input type="submit" class="btn btn-primary float-end" value="Cancel Delivery"/>';
                echo '</form><br>';
            }
          ?>
        </div><br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script></body>

</html>
