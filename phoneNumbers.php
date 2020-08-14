<?php
//start session
session_start();

//database connection
include_once './includes/connection.php';
include_once './includes/cgDashboard.php';

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
            <link href="css/chat.css" rel="stylesheet">

            <link href="css/style.css" rel="stylesheet">


<script type="text/javascript" src="js/loader.js"></script>

<?php
include_once './includes/chartStudent.php';
include_once './includes/chartYearly.php';
?>

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
                                        <img class="img-profile rounded-circle" src="css/image/ccdiLogo.png">
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
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
                            if (isset($_SESSION['registerStudent'])) {
                            ?>
                                <div id="alert-timer" class="alert alert-info text-center">
                                    <?php echo $_SESSION['registerStudent']; ?>
                                </div>
                            <?php
                                unset($_SESSION['registerStudent']);
                            }
                            ?>
     <div class="container">

         <!-- Outer Row -->
         <div class="row justify-content-center">

             <div class="col-xl-10 col-lg-12 col-md-9">

                 <div class="card o-hidden border-0 shadow-lg my-5">
                     <div class="card-body p-0">
                         <!-- Nested Row within Card Body -->
<div class="row" >
<div class="col-lg-12" style="margin-top: 10px; margin-left:5px">
<p>
  <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Update Status</button>
  <a class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#updateStatusModal">Select Category</a>
  <button style="margin-left:500px" class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">Instructions</button>
</p>


<div class="collapse" id="collapseExample2">
    <div class="card card-body">
<p>
<h4>Instructions:</h4>
</p>
<p>
<h5>HOW TO SEND A MESSAGE:</h5>
</p>
<p>
Step 1: Select the template you're going to use by clicking the right template in the drop-down button below. After that, click "COPY" button to copy the text template automatically at the same time, all the phone numbers that should receive the message will all display above.
</p>
<p>
Step 2: Click the circle with " + " sign which will bring you to a blank message box. And then click "Ctrl+V" to paste the message template.
</p>
<p>
Step 3: Copy all the numbers displayed above by clicking the "COPY" button next to it then select the blank box above your message and click "Ctrl+V" to paste all the phone numbers.
</p>
<p>
Step 4: Send.
</p>
<p>
<h5>HOW TO SEND MESSAGE BY CATEGORY:</h5>
</p>
<p>
Step 1: Click "Select Category" button above. Select only 1 category. Example: School - SSU.
</p>
<p>
Step 2: Repeat the instructions above from step 1 to step 4 .
</p>
<p>
<h5>HOW TO UPDATE STATUS:</h5>
</p>
<p>
Step 1: Click "UPDATE STATUS" button, and search student
</p>
<p>
Step 2: Click the check-box beside the students data
</p>
<p>
Step 3: Select the status by clicking the blank drop-down button below the table.
</p>
<p>

Step 4: Click the "UPDATE" button.
</p>

    </div>
</div>








<div class="collapse" id="collapseExample">
  <div class="card card-body">
        <form action="./includes/questionInfo.php" method="POST">
            <div class="container-fluid" id="patientTable">
                    <div class="row">
                        <div class="col-md-12 border border-info">
                            <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $sql = "SELECT * FROM user where userLevel=3 AND status!='Enrolled' AND status!='No Response' AND status!='Not Interested' ORDER BY id desc";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id = $row['id'];
                                            $municipality = $row['municipality'];
                                            $phoneNumber = $row['phoneNumber'];
                                            $status = $row['status'];
                                            $course = $row['course'];
                                            $lastSchoolAttended = $row['lastSchoolAttended'];


                                            $sql2 = "SELECT * FROM user where id = '$id'";
                                            $result2 = mysqli_query($conn, $sql2);

                                            if (mysqli_num_rows($result2) > 0) {
                                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    $lastName = $row2['lastName'];
                                                    $firstName = $row2['firstName'];
                                                    $middleName = $row2['middleName'];
                                                    $month = $row2['month'];
                                                    $year = $row2['year'];
                                                }
                                            }

                                            echo '
                                                <tr>
                                                    <td>' . $lastName . ', ' . $firstName . ' ' . $middleName . '</td>
                                                    <td>' . $phoneNumber . '</td>
                                                    <td>' . $status . '</td>
      												<td><input class="form-control" type="checkbox" name="phoneText[]" value="'.$phoneNumber.'"></td>  
                                                </tr>
                                                ';
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>                            <!-- End Dash Board Row -->
    <div class="row">

        <div class="col-lg-6">
            Select Status:
            <select style="margin-top:10px" name="statusList" class="form-control" id="dropDownSchool">
            <option value=""></option>
            <option value='Interested'>Interested</option>
            <option value='Not Interested'>Not Interested</option>
            <option value='No Response'>No Response</option>
            <option value='Enrolled'>Enrolled</option>
            </select>
        </div>
        <div class="col-lg-6">
            <div class="modal-footer">
            <button type="submit" name="btnUpdateStatus" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>


</div>
</div>
                         <div class="row">
                             <!-- <div class="col-lg-3 d-none d-lg-block ">
                                 
                             </div> -->
                             <div class="col-lg-12">
                                 <div class="p-5">
                                     <div class="text-center">
                            <?php
                            if (isset($_SESSION['message'])) {
                            ?>
                                <div id="alert-timer" class="alert alert-info text-center">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php
                                unset($_SESSION['message']);
                            }
                            ?>

                            <?php
                            if (isset($_SESSION['error_message'])) {
                            ?>
                                <div id="alert-timer" class="alert alert-danger text-center">
                                    <?php echo $_SESSION['error_message']; ?>
                                </div>
                            <?php
                                unset($_SESSION['error_message']);
                            }
                            ?>
                                         <h1 class="h4 text-gray-900 mb-2">List of Contact Number:</h1>
                                         <!-- Query to get all the phone numbers -->
                                         <?php
                                            if (isset($_GET['selectedTemplate'])) {
                                                $templateSelected = $_GET['selectedTemplate'];


                                                if($templateSelected=="Template1"){

                                                // Get Date and Time
                                                date_default_timezone_set("Asia/Manila");
                                                //Test Trigger if Working
                                                // $currentDate = '2020-02-21 00:00:00';
                                                $getCurrentDate = date("Y-m-d");
                                                $currentDate = $getCurrentDate . ' ' . '00:00:00';
                                                if (isset($_GET['school'])) {
                                                    $school = $_GET['school'];
                                                }
                                                if (isset($_GET['municipality'])) {
                                                    $municipality = $_GET['municipality'];
                                                }
                                                if (isset($_GET['course'])) {
                                                    $course = $_GET['course'];
                                                }

                                                if(!empty($school) && !empty($municipality) && !empty($course)){
                                                    $sql = "SELECT * FROM user where userLevel=3 AND textStatus=0 AND textedDate!='$getCurrentDate' AND status !='Enrolled' AND status !='Interested' AND lastSchoolAttended='$school' AND municipality='$municipality' AND course='$course' ORDER BY id desc";
                                                } else if(empty($school) && empty($municipality) && empty($course)){
                                                    $sql = "SELECT * FROM user where userLevel=3 AND textStatus=0 AND textedDate!='$getCurrentDate' AND status !='Enrolled' AND status !='Interested' ORDER BY id desc";
                                                } else if(!empty($school) && !empty($municipality)){
                                                    $sql = "SELECT * FROM user where userLevel=3 AND textStatus=0 AND textedDate!='$getCurrentDate' AND status !='Enrolled' AND status !='Interested' AND lastSchoolAttended='$school' AND municipality='$municipality' ORDER BY id desc";
                                                } else if(!empty($school) && !empty($course)){
                                                    $sql = "SELECT * FROM user where userLevel=3 AND textStatus=0 AND textedDate!='$getCurrentDate' AND status !='Enrolled' AND status !='Interested' AND lastSchoolAttended='$school' AND course='$course' ORDER BY id desc";
                                                } else if(!empty($municipality) && !empty($course)){
                                                    $sql = "SELECT * FROM user where userLevel=3 AND textStatus=0 AND textedDate!='$getCurrentDate' AND status !='Enrolled' AND status !='Interested' AND municipality='$municipality' AND course='$course' ORDER BY id desc";
                                                } else if(!empty($school)){
                                                    $sql = "SELECT * FROM user where userLevel=3 AND textStatus=0 AND textedDate!='$getCurrentDate' AND status !='Enrolled' AND status !='Interested' AND lastSchoolAttended='$school' ORDER BY id desc";
                                                } else if (!empty($municipality)){
                                                    $sql = "SELECT * FROM user where userLevel=3 AND textStatus=0 AND textedDate!='$getCurrentDate' AND status !='Enrolled' AND status !='Interested' AND municipality='$municipality' ORDER BY id desc";
                                                } else if (!empty($course)){
                                                    $sql = "SELECT * FROM user where userLevel=3 AND textStatus=0 AND textedDate!='$getCurrentDate' AND status !='Enrolled' AND status !='Interested' AND course='$course' ORDER BY id desc";
                                                }
                                                $result = mysqli_query($conn, $sql);

                                                if (mysqli_num_rows($result) > 0) {
                                                    echo '<h4>List to Text: </h4> '; 
                                                    $phoneNumbers = "";
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                            $id = $row['id'];
                                                            $textStatus = $row['textStatus'];
                                                            $phoneNumbers .= $row["phoneNumber"].",";
                                                            
                                                    }

                                                    echo '
                                                    <input type="text" value="'.$phoneNumbers.'" id="listOfPhoneNumbers">
                                                    <button onclick="copyPhoneNumbers()" class="btn btn-success ">Copy</button>
                                                     <form method="post" action="./includes/texted.php?municipality='.$_GET['municipality'].'&course='.$_GET['course'].'&school='.$_GET['school'].'">
                                                         <button class="btn btn-info " name="numberTexted1"
                                                             type="submit">Texted</button>
                                                     </form>
                                                    ';
                                                } else {
                                                    echo "0 results";
                                                }

                                                }else if($templateSelected=="Template2"){
                                                // Get Date and Time
                                                date_default_timezone_set("Asia/Manila");
                                                //Test Trigger if Working
                                                // $currentDate = '2020-02-21 00:00:00';
                                                $getCurrentDate = date("Y-m-d");
                                                $currentDate = $getCurrentDate . ' ' . '00:00:00';
                                                if (isset($_GET['school'])) {
                                                    $school = $_GET['school'];
                                                }
                                                if (isset($_GET['municipality'])) {
                                                    $municipality = $_GET['municipality'];
                                                }
                                                if (isset($_GET['course'])) {
                                                    $course = $_GET['course'];
                                                }

                                                if(!empty($school) && !empty($municipality) && !empty($course)){
                                                    $sql = "SELECT * FROM user where userLevel=3 AND textStatus=1 AND textedDate!='$getCurrentDate' AND status !='Enrolled' AND status !='Interested' AND lastSchoolAttended='$school' AND municipality='$municipality' AND course='$course' ORDER BY id desc";
                                                } else if(empty($school) && empty($municipality) && empty($course)){
                                                    $sql = "SELECT * FROM user where userLevel=3 AND textStatus=1 AND textedDate!='$getCurrentDate' AND status !='Enrolled' AND status !='Interested' ORDER BY id desc";
                                                } else if(!empty($school) && !empty($municipality)){
                                                    $sql = "SELECT * FROM user where userLevel=3 AND textStatus=1 AND textedDate!='$getCurrentDate' AND status !='Enrolled' AND status !='Interested' AND lastSchoolAttended='$school' AND municipality='$municipality' ORDER BY id desc";
                                                } else if(!empty($school) && !empty($course)){
                                                    $sql = "SELECT * FROM user where userLevel=3 AND textStatus=1 AND textedDate!='$getCurrentDate' AND status !='Enrolled' AND status !='Interested' AND lastSchoolAttended='$school' AND course='$course' ORDER BY id desc";
                                                } else if(!empty($municipality) && !empty($course)){
                                                    $sql = "SELECT * FROM user where userLevel=3 AND textStatus=1 AND textedDate!='$getCurrentDate' AND status !='Enrolled' AND status !='Interested' AND municipality='$municipality' AND course='$course' ORDER BY id desc";
                                                } else if(!empty($school)){
                                                    $sql = "SELECT * FROM user where userLevel=3 AND textStatus=1 AND textedDate!='$getCurrentDate' AND status !='Enrolled' AND status !='Interested' AND lastSchoolAttended='$school' ORDER BY id desc";
                                                } else if (!empty($municipality)){
                                                    $sql = "SELECT * FROM user where userLevel=3 AND textStatus=1 AND textedDate!='$getCurrentDate' AND status !='Enrolled' AND status !='Interested' AND municipality='$municipality' ORDER BY id desc";
                                                } else if (!empty($course)){
                                                    $sql = "SELECT * FROM user where userLevel=3 AND textStatus=1 AND textedDate!='$getCurrentDate' AND status !='Enrolled' AND status !='Interested' AND course='$course' ORDER BY id desc";
                                                }
                                                $result = mysqli_query($conn, $sql);

                                                if (mysqli_num_rows($result) > 0) {
                                                    echo '<h4>List to Text: </h4> '; 
                                                    $phoneNumbers = "";
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                            $id = $row['id'];
                                                            $textStatus = $row['textStatus'];
                                                            $phoneNumbers .= $row["phoneNumber"].",";
                                                            
                                                    }

                                                    echo '
                                                    <input type="text" value="'.$phoneNumbers.'" id="listOfPhoneNumbers">
                                                    <button onclick="copyPhoneNumbers()" class="btn btn-success ">Copy</button>
                                                     <form method="post" action="./includes/texted.php?municipality='.$_GET['municipality'].'&course='.$_GET['course'].'&school='.$_GET['school'].'">
                                                         <button class="btn btn-info " name="numberTexted2"
                                                             type="submit">Texted</button>
                                                     </form>
                                                    ';
                                                } else {
                                                    echo "0 results";
                                                }

                                                }else if($templateSelected=="Template3"){
                                                // Get Date and Time
                                                date_default_timezone_set("Asia/Manila");
                                                //Test Trigger if Working
                                                // $currentDate = '2020-02-21 00:00:00';
                                                $getCurrentDate = date("Y-m-d");
                                                $currentDate = $getCurrentDate . ' ' . '00:00:00';
                                                if (isset($_GET['school'])) {
                                                    $school = $_GET['school'];
                                                }
                                                if (isset($_GET['municipality'])) {
                                                    $municipality = $_GET['municipality'];
                                                }
                                                if (isset($_GET['course'])) {
                                                    $course = $_GET['course'];
                                                }

                                                if(!empty($school) && !empty($municipality) && !empty($course)){
                                                    $sql = "SELECT * FROM user where userLevel=3 AND textStatus=2 AND textedDate!='$getCurrentDate' AND status !='Enrolled' AND status !='Interested' AND lastSchoolAttended='$school' AND municipality='$municipality' AND course='$course' ORDER BY id desc";
                                                } else if(empty($school) && empty($municipality) && empty($course)){
                                                    $sql = "SELECT * FROM user where userLevel=3 AND textStatus=2 AND textedDate!='$getCurrentDate' AND status !='Enrolled' AND status !='Interested' ORDER BY id desc";
                                                } else if(!empty($school) && !empty($municipality)){
                                                    $sql = "SELECT * FROM user where userLevel=3 AND textStatus=2 AND textedDate!='$getCurrentDate' AND status !='Enrolled' AND status !='Interested' AND lastSchoolAttended='$school' AND municipality='$municipality' ORDER BY id desc";
                                                } else if(!empty($school) && !empty($course)){
                                                    $sql = "SELECT * FROM user where userLevel=3 AND textStatus=2 AND textedDate!='$getCurrentDate' AND status !='Enrolled' AND status !='Interested' AND lastSchoolAttended='$school' AND course='$course' ORDER BY id desc";
                                                } else if(!empty($municipality) && !empty($course)){
                                                    $sql = "SELECT * FROM user where userLevel=3 AND textStatus=2 AND textedDate!='$getCurrentDate' AND status !='Enrolled' AND status !='Interested' AND municipality='$municipality' AND course='$course' ORDER BY id desc";
                                                } else if(!empty($school)){
                                                    $sql = "SELECT * FROM user where userLevel=3 AND textStatus=2 AND textedDate!='$getCurrentDate' AND status !='Enrolled' AND status !='Interested' AND lastSchoolAttended='$school' ORDER BY id desc";
                                                } else if (!empty($municipality)){
                                                    $sql = "SELECT * FROM user where userLevel=3 AND textStatus=2 AND textedDate!='$getCurrentDate' AND status !='Enrolled' AND status !='Interested' AND municipality='$municipality' ORDER BY id desc";
                                                } else if (!empty($course)){
                                                    $sql = "SELECT * FROM user where userLevel=3 AND textStatus=2 AND textedDate!='$getCurrentDate' AND status !='Enrolled' AND status !='Interested' AND course='$course' ORDER BY id desc";
                                                }
                                                $result = mysqli_query($conn, $sql);

                                                if (mysqli_num_rows($result) > 0) {
                                                    echo '<h3>List to Text: </h3> '; 
                                                    $phoneNumbers = "";
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                            $id = $row['id'];
                                                            $textStatus = $row['textStatus'];
                                                            $phoneNumbers .= $row["phoneNumber"].",";
                                                    }
                                                    echo '
                                                    <input type="text" value="'.$phoneNumbers.'" id="listOfPhoneNumbers">
                                                    <button onclick="copyPhoneNumbers()" class="btn btn-success ">Copy</button>
                                                     <form method="post" action="./includes/texted.php?municipality='.$_GET['municipality'].'&course='.$_GET['course'].'&school='.$_GET['school'].'">
                                                         <button class="btn btn-info " name="numberTexted3"
                                                             type="submit">Texted</button>
                                                     </form>
                                                    ';
                                                } else {
                                                    echo "0 results";
                                                }

                                                }

                                            }
                                            ?>
                                     </div>
                                      <iframe src="https://pulsesms.app/" width="800px" height="600px" frameborder="0" class="mt-2"></iframe>
                                     <hr>
                                     <div class="row">
                                         <div class="col-lg-6 p-2">
                                             <div class="text-center">
                                                 <form method="GET" action="phoneNumbers.php">
                                                    <select onchange="templateClick()" name="selectedTemplate" value="" class="form-control" id="selectedTemplate">
                                                    <option value="">Select Template</option>
                                                    <option value=""></option>
                                                    <option value="Template1">Template 1</option>
                                                    <option value="Template2">Template 2</option>
                                                    <option value="Template3">Template 3</option>
                                                    </select>
                                                    <input type="hidden" name="school" value="<?php echo $_GET['school'] ?>">
                                                    <input type="hidden" name="municipality" value="<?php echo $_GET['municipality'] ?>">
                                                    <input type="hidden" name="course" value="<?php echo $_GET['course'] ?>">
                                                    <input type="hidden" name="id" value="1">
                                             </div>
                                         </div>
                                         <div class="col-lg-6 p-2">
                                             <button class="btn btn-success " name="templateBtn"
                                                 type="submit">Copy</button>
                                         </div>
                                     </div>
                                         </form>
                             </div>
                         </div>
                     </div>
                 </div>

             </div>

<?php //include_once('./modals/updateStatusModal.php') ?>
<?php include_once('./modals/textCategory.php') ?>

         </div>

<textarea style="opacity: .01;" id="template1" name="" cols="30" rows="5">
CCDI ADVISORY:
Congrats in your graduation! Secure your future, enroll now at CCDI Sorsogon!
</textarea>
<textarea style="opacity: .01;" id="template2" name="" cols="30" rows="5">
CCDI ADVISORY:
Enrollment starts today, until July 31, 2020 only. Please avoid the rush, enroll now!
</textarea>
<textarea style="opacity: .01;" id="template3" name="" cols="30" rows="5">
CCDI ADVISORY:
Enrollment is still going on! What are you waiting for? take the entrance exam an enroll now!
</textarea>

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

			<script src="js/jquery.dataTables.min.js"></script>
			<script src="js/dataTables.bootstrap4.min.js"></script>

			<script type="text/javascript">

                                    setTimeout(function(){
                                        $('#alert-timer').fadeOut('slow');
                                    },3000);

				$(document).ready(function() {
					// Javascript method's body can be found in assets/js/demos.js
					demo.initDashboardPageCharts();

					// demo.showNotification("Goodshit!");
				});

			 $(document).ready(function() {
			 $('#example').DataTable();
			 });
function templateClick(){
  var selectedTemplate = document.getElementById("selectedTemplate");
  if(selectedTemplate.value === "Template1"){
    template1();
  }else if(selectedTemplate.value === "Template2"){
    template2();
  }else if(selectedTemplate.value === "Template3"){
    template3();
  }
}

function template1() {
  /* Get the text field */
  var copyText = document.getElementById("template1");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  //alert("Copied the text: " + copyText.value);
}
function template2() {
  /* Get the text field */
  var copyText = document.getElementById("template2");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  //alert("Copied the text: " + copyText.value);
}
function template3() {
  /* Get the text field */
  var copyText = document.getElementById("template3");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  //alert("Copied the text: " + copyText.value);
}

function copyPhoneNumbers() {
  /* Get the text field */
  var copyText = document.getElementById("listOfPhoneNumbers");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
}
			</script>
        </body>

        </html>

<?php
    } else {
        $url = "./index.php";
        $url = str_replace(PHP_EOL, '', $url);
        header("Location: $url");
    }
} else {
    $url = "./index.php";
    $url = str_replace(PHP_EOL, '', $url);
    header("Location: $url");
}
mysqli_close($conn);
?>
