<?php
session_start();
include_once './config/Database.php';

/* add this 3 lines and session_start to every page to prevent people simply 
      accessing page without logging in.*/
// if loggedIn var is not set, then the admin has not logged in
if (!isset($_SESSION['loggedIn'])) {
   header("Location: index.php");
}

$username = $_SESSION['username'];

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
$table = 'quiz';

$query = 'SELECT * FROM ' . $table;
$stmt = $db->prepare($query);
$stmt->execute();
?>

<!doctype html>
<html class="fixed sidebar-left-collapsed">

<head>

   <!-- Basic -->
   <meta charset="UTF-8">

   <title>Aquatic Animals | Admin Website</title>
   <meta name="keywords" content="HTML5 Admin Template" />
   <meta name="description" content="JSOFT Admin - Responsive HTML5 Template">
   <meta name="author" content="JSOFT.net">

   <!-- Mobile Metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

   <!-- Web Fonts  -->
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

   <!-- Vendor CSS -->
   <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
   <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
   <link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
   <link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

   <!-- Specific Page Vendor CSS -->
   <link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
   <link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
   <link rel="stylesheet" href="assets/vendor/morris/morris.css" />

   <!-- Theme CSS -->
   <link rel="stylesheet" href="assets/stylesheets/theme.css" />

   <!-- Skin CSS -->
   <link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

   <!-- Theme Custom CSS -->
   <link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

   <!-- Head Libs -->
   <script src="assets/vendor/modernizr/modernizr.js"></script>

   <!-- Favicon -->
   <link rel="shortcut icon" href="./assets/images/favicon.ico" type="image/x-icon">
   <link rel="icon" href="./assets/images/favicon.ico" type="image/x-icon">

</head>

<body>
   <section class="body">

      <!-- start: header -->
      <header class="header">
         <div class="logo-container">
            <a href="./homepage.php" class="logo">
               <p>Admin Website</p>
               <!-- <img src="assets/images/logo.png" height="35" alt="JSOFT Admin" /> -->
            </a>
            <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
               <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
         </div>

         <!-- start: search & user box -->
         <div class="header-right">
            <span class="separator"></span>

            <div id="userbox" class="userbox">
               <a href="#" data-toggle="dropdown">
                  <figure class="profile-picture">
                     <img src="assets/images/admin.png" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
                  </figure>
                  <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@JSOFT.com">
                     <span class="name"><?php echo $username; ?></span>
                     <span class="role">administrator</span>
                  </div>

                  <i class="fa custom-caret"></i>
               </a>

               <div class="dropdown-menu">
                  <ul class="list-unstyled">
                     <li class="divider"></li>
                     <li>
                        <a role="menuitem" tabindex="-1" href="./logout.php" id="logout"><i class="fa fa-power-off"></i> Logout</a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <!-- end: search & user box -->
      </header>
      <!-- end: header -->

      <div class="inner-wrapper">
         <!-- start: sidebar -->
         <aside id="sidebar-left" class="sidebar-left">

            <div class="sidebar-header">
               <div class="sidebar-title">
                  Navigation
               </div>
               <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                  <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
               </div>
            </div>

            <div class="nano">
               <div class="nano-content">
                  <nav id="menu" class="nav-main" role="navigation">
                     <ul class="nav nav-main">
                        <li class="nav-active">
                           <a href="./homepage.php">
                              <i class="fa fa-home" aria-hidden="true"></i>
                              <span>Homepage</span>
                           </a>
                        </li>

                        <li class="nav-active">
                           <a href="./addQuiz.php">
                              <i class="fa fa-plus" aria-hidden="true"></i>
                              <span>Add New Quiz</span>
                           </a>
                        </li>
                  </nav>
               </div>
            </div>
         </aside>
         <!-- end: sidebar -->

         <section role="main" class="content-body">
            <header class="page-header">
               <h2>Admin Homepage</h2>
            </header>
            <div class="panel-body">
               <h2>Quizzes</h2>
               <div class="row">
                  <div class="col-sm-12 text-right">
                     <button id="addQuiz" class="btn btn-primary">Add New Quiz <i class="fa fa-plus"></i></button>
                  </div>
               </div><br>
               <table class="table table-bordered table-striped mb-none" id="datatable-default">
                  <thead>
                     <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>View</th>
                        <th>Edit</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     // listing all the quizzes in database
                     $num = 1;
                     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td>' . $num . '</td>';
                        echo '<td><a href="./viewQuestions.php?id=' . $row['id'] . '&quiz=' . $row['name'] . '&ques=' . $row['numOfQues'] .'">' . $row['name'] . '</a></td>';
                        echo '<td>' . $row['date'] . '</td>';
                        echo '<td><a href="./quizScore.php?id=' . $row['id'] . '&quiz=' . $row['name'] . '&ques=' . $row['numOfQues'] .'">View Score</a></td>';
                        echo '<td><a href="./editQuizPage.php?id=' . $row['id'] .'">Edit <i class="fa fa-edit"></i></a></td>';
                        echo '</tr>';
                        $num++;
                     }
                     ?>
                  </tbody>
               </table>
            </div>
            <!-- start: page -->
            <!-- end: page -->
         </section>
      </div>
   </section>

   <script>
      const addQuizBtn = document.getElementById("addQuiz").addEventListener("click", () => {
         window.location = "./addQuiz.php";
      });;
   </script>

   <!-- Vendor -->
   <script src="assets/vendor/jquery/jquery.js"></script>
   <script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
   <script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
   <script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
   <script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
   <script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

   <!-- Specific Page Vendor -->
   <script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
   <script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
   <script src="assets/vendor/jquery-appear/jquery.appear.js"></script>
   <script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
   <script src="assets/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>
   <script src="assets/vendor/flot/jquery.flot.js"></script>
   <script src="assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
   <script src="assets/vendor/flot/jquery.flot.pie.js"></script>
   <script src="assets/vendor/flot/jquery.flot.categories.js"></script>
   <script src="assets/vendor/flot/jquery.flot.resize.js"></script>
   <script src="assets/vendor/jquery-sparkline/jquery.sparkline.js"></script>
   <script src="assets/vendor/raphael/raphael.js"></script>
   <script src="assets/vendor/morris/morris.js"></script>
   <script src="assets/vendor/gauge/gauge.js"></script>
   <script src="assets/vendor/snap-svg/snap.svg.js"></script>
   <script src="assets/vendor/liquid-meter/liquid.meter.js"></script>
   <script src="assets/vendor/jqvmap/jquery.vmap.js"></script>
   <script src="assets/vendor/jqvmap/data/jquery.vmap.sampledata.js"></script>
   <script src="assets/vendor/jqvmap/maps/jquery.vmap.world.js"></script>
   <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js"></script>
   <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js"></script>
   <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js"></script>
   <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js"></script>
   <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>
   <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js"></script>

   <!-- Theme Base, Components and Settings -->
   <script src="assets/javascripts/theme.js"></script>

   <!-- Theme Custom -->
   <script src="assets/javascripts/theme.custom.js"></script>

   <!-- Theme Initialization Files -->
   <script src="assets/javascripts/theme.init.js"></script>


   <!-- Examples -->
   <script src="assets/javascripts/dashboard/examples.dashboard.js"></script>

   <!-- For Table Pagination -->
   <!-- <script src="assets/vendor/select2/select2.js"></script>
   <script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
   <script src="assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
   <script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
   <script src="assets/javascripts/tables/examples.datatables.default.js"></script>
   <script src="assets/javascripts/tables/examples.datatables.row.with.details.js"></script>
   <script src="assets/javascripts/tables/examples.datatables.tabletools.js"></script> -->
</body>

</html>