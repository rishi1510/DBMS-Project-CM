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

    $code = $_GET['bid'];

    $sql = "SELECT * FROM BRANCH WHERE B_CODE = '$code'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $sql1 = "SELECT * FROM MANAGER WHERE B_CODE = '$code'";
    $result1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);

    $sql2 = "SELECT COUNT(*) AS COUNTC, SUM(P_COUNT) AS SUMP FROM COURIER WHERE B_CODE = '$code'";
    $result2 = mysqli_query($con, $sql2);
    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

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
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="24" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                </svg>
                </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="ahome.php">
                View Branches</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="anewb.php">
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

    <div class="container border border-3 rounded-3 p-5 bg-light">
        <h1>Branch details:</h1><br>
              <table class="table" cellspacing="20px">
              <tr>
              <th>Branch Code:</th>
              <td><?php echo $row['B_CODE'];?></td>
              </tr>
              <tr>
              <th>Name:</th>
              <td><?php echo $row['B_NAME'];?></td>
              </tr>
              <tr>
              <th>Address:</th>
              <td><?php echo $row['B_ADDRESS'];?></td>
              </tr>
              <tr>
              <th>City:</th>
              <td><?php echo $row['B_CITY'];?></td>
              </tr>
              <tr>
              <th>Pin:</th>
              <td><?php echo $row['B_PIN'];?></td>
              </tr>
              <tr>
              <th>Manager:</th>
              <td><?php echo $row1['M_NAME'];?></td>
              </tr>
              <tr>
              <th>Number of Couriers:</th>
              <td><?php echo $row2['COUNTC'];?></td>
              </tr>
              <tr>
              <th>Number of Active Packages:</th>
              <td><?php echo $row2['SUMP'];?></td>
              </tr>
              </table><br>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script></body>

</html>