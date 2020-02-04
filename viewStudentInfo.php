<?php
//start session
session_start();

//database connection
include_once './includes/connection.php';
?>

<?php
if ($_SESSION['userLevel'] == 0) {
    if (isset($_SESSION['loggedin'])) {
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>

            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">

            <title>CGS - CCDI</title>

            <!-- Custom fonts for this template-->
            <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
            <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

            <!-- Custom styles for this template-->
            <link href="css/sb-admin-2.min.css" rel="stylesheet">
            <link href="css/style.css" rel="stylesheet">

        </head>

        <body id="page-top">

            <!-- Page Wrapper -->
            <div id="wrapper">

                <!-- Sidebar -->
                <?php include_once('./sidebar.php') ?>

                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">

                    <!-- Main Content -->
                    <div id="content">

                        <!-- Topbar -->
                        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                            <!-- Topbar Navbar -->
                            <ul class="navbar-nav ml-auto">

                                <div class="topbar-divider d-none d-sm-block"></div>

                                <!-- Nav Item - User Information -->
                                <li class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['firstName']; ?></span>
                                        <img class="img-profile rounded-circle" src="https://www.ccdi-sorsogon.net/wp-content/uploads/2018/04/cropped-ccdilogo.png">
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Profile
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Settings
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Activity Log
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="./includes/logout.php">
                                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Logout
                                        </a>
                                    </div>
                                </li>

                            </ul>

                        </nav>
                        <!-- End of Topbar -->

                        <!-- Begin Page Content -->
                        <div class="container-fluid">

                            <?php
                            include_once './includes/connection.php';
                            $id = $_GET['id'];
                            $username = $_GET['username'];
                            $studentID = $_GET['studentId'];

                            if ($_GET['search'] == 1 && $studentID != '') {
                                $gStudentInfo = "SELECT * FROM user WHERE username='$username'";
                                $rStudentInfo = mysqli_query($conn, $gStudentInfo);

                                if (mysqli_num_rows($rStudentInfo) > 0) {
                                    while ($rowStudentInfo = mysqli_fetch_assoc($rStudentInfo)) {
                                        // $lastName = $rowStudentInfo["lastName"];
                                        $firstName = $rowStudentInfo["firstName"];
                                        // $lastName = $rowStudentInfo["lastName"];
                                        // $lastName = $rowStudentInfo["lastName"];
                                        // $lastName = $rowStudentInfo["lastName"];
                                        // $lastName = $rowStudentInfo["lastName"];
                                        // $lastName = $rowStudentInfo["lastName"];
                                        // $lastName = $rowStudentInfo["lastName"];
                                    }
                                } else {
                                    $firstName = 'No Result';
                                }
                                mysqli_close($conn);

                                echo '
                                <form action="">
                                    <div class="row">
                                        <div class="card shadow mb-4">
                                            <div class="card-header py-3">
                                                <h6 class="m-0 font-weight-bold text-primary">Basic Card Example</h6>
                                            </div>
                                        <div class="card-body">
                                            ' .  $firstName  . '
                                        </div>
                                        </div>
                                    </div>
                                </form>
                                ';
                            }

                            // SELECT ALL
                            else if ($_GET['studentId'] == '') {
                                $gStudentInfo = "SELECT * FROM user order by id desc";
                                $rStudentInfo = mysqli_query($conn, $gStudentInfo);

                                if (mysqli_num_rows($rStudentInfo) > 0) {
                                    while ($rowStudentInfo = mysqli_fetch_assoc($rStudentInfo)) {

                                        $firstName = $rowStudentInfo["firstName"];
                                        $lastName = $rowStudentInfo["lastName"];

                                        echo '
                                        <form action="">
                                            <div class="row">
                                                <div class="card shadow mb-4">
                                                    <div class="card-header py-3">
                                                        <h6 class="m-0 font-weight-bold text-primary">Basic Card Example</h6>
                                                    </div>
                                                <div class="card-body">
                                                    ' .  $firstName  . ' <br>
                                                    ' . $lastName . '
                                                </div>
                                                </div>
                                            </div>
                                        </form>
                                        ';
                                    }
                                } else {
                                    $firstName = 'No Result';
                                }
                                mysqli_close($conn);
                            }
                            // END OF SELECT ALL
                            ?>

                            <div class="container studentInfoContainer">
                                <div class="row">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Student Information</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="usr">Username:</label>
                                                        <input disabled type="text" class="form-control" id="usr">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="usr">Password:</label>
                                                        <input type="text" class="form-control" id="usr">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="usr">Suggested Course:</label>
                                                    <select id="usr" class="browser-default custom-select">
                                                        <option selected></option>
                                                        <option value="Computer Science">CS</option>
                                                        <option value="Information Technology">IT</option>
                                                        <option value="Accosiciate in Computer Technology">ACT</option>
                                                        <option value="BSIS">BSIS</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="usr">Score:</label>
                                                        <input disabled type="text" class="form-control" id="usr">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End of Row -->
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="usr">Lastname:</label>
                                                        <input type="text" class="form-control" id="usr">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="usr">Firstname:</label>
                                                        <input type="text" class="form-control" id="usr">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="usr">Middlename:</label>
                                                        <input type="text" class="form-control" id="usr">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="usr">Phone Number:</label>
                                                        <input type="number" class="form-control" id="usr">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End of Row -->
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="usr">Address:</label>
                                                        <input type="text" class="form-control" id="usr">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="usr">Status:</label>
                                                    <select id="usr" class="browser-default custom-select">
                                                        <option selected></option>
                                                        <option value="Enrolled">Taked Exam</option>
                                                        <option value="Enrolled">Enrolled</option>
                                                        <option value="Undecided">Undecided</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="usr">Date of Examination:</label>
                                                        <input type="text" class="form-control" id="usr">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End of Row -->
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <label for="usr">Last School Attended:</label>
                                                    <select id="usr" class="browser-default custom-select">
                                                        <option></option>
                                                        <option>SNHS</option>
                                                        <option>Aemillianum College Inc.</option>
                                                        <option>TLC</option>
                                                        <option>SMLCS</option>
                                                        <option>SSU</option>
                                                        <option>Annunciation College</option>
                                                        <option>Others</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="usr">Course:</label>
                                                    <select id="usr" class="browser-default custom-select">
                                                        <option></option>
                                                        <option>Information Technology</option>
                                                        <option>Computer Science</option>
                                                        <option>ACT</option>
                                                        <option>IS</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3">
                                                    <button name="studentInfoUpdate" class="btn btn-success cgStudentUpdate" type="submit">Update</button>
                                                </div>
                                                <div class="col-lg-3">
                                                    <button name="studentInfoPrint" class="btn btn-info cgStudentUpdate" type="submit">Print</button>
                                                </div>
                                            </div>
                                            <!-- End of Row -->
                                        </div>
                                        <!-- End of Card Body -->
                                    </div>
                                </div>
                            </div>



                        </div>
                        <!-- /.container-fluid -->

                    </div>
                    <!-- End of Main Content -->

                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Copyright &copy; Your Website 2019</span>
                            </div>
                        </div>
                    </footer>
                    <!-- End of Footer -->

                </div>
                <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Bootstrap core JavaScript-->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="vendor/chart.js/Chart.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="js/demo/chart-area-demo.js"></script>
            <script src="js/demo/chart-pie-demo.js"></script>

        </body>

        </html>

<?php
    } else {
        header('location: ./login.php');
    }
} else {
    header('location: ./login.php');
}
?>