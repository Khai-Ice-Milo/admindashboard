<?php
require('db.php');
//single login

    

session_start();
    if (isset($_POST['login'])){
        $eMail = $_POST['aEmail'];
        $uPassword = $_POST['aPassword'];

        $sql = "SELECT * FROM admins WHERE aEmail = '$eMail' AND aPassword = '$uPassword'";
        $result = mysqli_query($conn,$sql);

            if ($result->num_rows > 0) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION['aName'] = $row['aName'];
                $_SESSION['a_id'] = $row['a_id'];
        
                $userType = $row['aType'];
                if ($userType === 'SuperAdmin'){
                    echo "<script>alert('Welcome Super Admin');
                    window.location.href='supadminpage.php';
                </script>";
                } else {
                    echo "<script>alert('Login Successful');
                    window.location.href='adminpage.php';
                    </script>";    
                }
        }else{
            echo "<script>alert('Email or Password is wrong!');
            window.location.href='dashboard.php';
            </script>";
        }
    }

    // SEARCH SECTION
    // (B) PROCESS SEARCH WHEN FORM SUBMITTED
if (isset($_POST['search'])) {
    // (B1) SEARCH FOR USERS
    require "2-search.php";
  
    // (B2) DISPLAY RESULTS
    if (count($results) > 0) {
      foreach ($results as $r) {
        printf("<div>%s - %s</div>", $r['name'], $r['email']);
      }
    } else { echo "No results found"; }
  }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GM HR DASH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <!--offcanvas trigger-->
              <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon" data-bs-target="#offcanvasExample"></span>
              </button>
            <!--Offcanvas trigger-->
          <a class="navbar-brand fw-bold text-uppercase me-auto" href="#">HR Dashboard</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            <form class="d-flex ms-auto">
                <div class="input-group my-3 my-lg-0">
                    <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2" >
                    <button class="btn btn-primary" type="button" name="search" id="button-addon2"><i class="bi bi-search"></i></button>
                  </div>
            </form>
            <ul class="navbar-nav mb-2 mb-lg-0">
              
              
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-fill"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
                </li>
              </ul>
          </div>
        </div>
      </nav>
    
      
      
      <div class="offcanvas offcanvas-start sidebar-nav bg-dark text-white" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
       
        <div class="offcanvas-body p-0">
          <nav class="navbar-dark">
              <ul class="navbar-nav">
                <li>
                    <div class="text-muted small fw-bold text-uppercase px-3">CORE</div>
                </li>
                <li>
                    <a href="#" class="nav-link px-3 active">
                        <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="my-4">
                    <hr class="dropdown-divider ">
                </li>
                <li>
                    <div class="text-muted small fw-bold text-uppercase px-3">Interface</div>
                </li>

                <li>
                    <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <span class="me-2"><i class="bi bi-layout-split"></i></span>
                        <span>Layouts</span>
                        <span class="right-icon ms-auto"><i class="bi bi-chevron-down"></i></span>

                      </a>
                      <div class="collapse" id="collapseExample">
                        <div>
                          <ul class="navbar-nav ps-3">
                            <li>
                              <a href="#" class="nav-link px-3">
                                <span class="me-2"><i class="bi bi-layout-split"></i></span>
                                <span>Nested Link</span>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                </li>
              </ul>
          </nav>
        </div>
      </div>
      <!--Main-->
      <main class="mt-5 pt-3">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 fw-bold fs-3">Dispatcher Applying List</div>
          </div><br>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">Data Tables</div>
              <div class="card-body">
                <div class="table-reponsive">
                  <table
                    id="example"
                    class="table table-striped data-table"
                    style="width: 100%"
                  >
                    <thead>
                      <tr>
                        <th>Full Name</th>
                        <th>Position Applied</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>IC Color</th>
                        <th>IC Number</th>
                        <!-- DISTRICT ADD HERE -->
                        <th>Date Applied</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php
        include_once('db.php');
        $query = $conn->query("SELECT * FROM users ORDER by u_id");
        while($row = mysqli_fetch_array($query)){
            echo "<tr>";
            echo "<td style='display:none;'>".$row['u_id']."</td>";
            echo "<td>".$row['uName']."</td>";
            echo "<td>".$row['uPosApplied']."</td>";
            echo "<td>".$row['uEmail']."</td>";
            echo "<td>".$row['uPNum']."</td>";
            echo "<td>".$row['uColor']."</td>";
            echo "<td>".$row['uICNum']."</td>";
            echo "<td>".$row['uAppliedTime']."</td>";
            echo "<td><a><button>View</button></a></td>";
            echo "</tr>";
        }
        ?>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="main.js"></script>
</body>
</html>