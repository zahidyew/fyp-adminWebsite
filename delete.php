<?php
session_start();
include_once './config/Database.php';

// if loggedIn var is not set, then the admin has not logged in
if (!isset($_SESSION['loggedIn'])) {
   header("Location: index.php");
}

$username = $_SESSION['username'];

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

$quizId = $_GET['id'];
$flag = false;

$query = 'DELETE FROM quizrecords 
            WHERE quizId = :quizId';

$stmt = $db->prepare($query);
$stmt->bindParam(':quizId', $quizId);

if ($stmt->execute()) {
   $query2 = 'DELETE FROM question 
               WHERE quizId = :quizId';

   $stmt2 = $db->prepare($query2);
   $stmt2->bindParam(':quizId', $quizId);

   if ($stmt2->execute()) {
      $query3 = 'DELETE FROM quiz 
                  WHERE id = :quizId';

      $stmt3 = $db->prepare($query3);
      $stmt3->bindParam(':quizId', $quizId);

      if ($stmt3->execute()) {
         $flag = true;
      }
   }
}

if ($flag == true) {
   $msg = "Successfully deleted.";
} else {
   $msg = "Error. Unable to delete the records.";
}
?>

<!doctype html>
<html class="fixed sidebar-left-collapsed">

<head>
   <!-- Basic -->
   <meta charset="UTF-8">

   <title>Admin Website</title>
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
            </header>
            <div class="panel-body">
               <p class="text-center text-dark"><?php echo $msg; ?></p>
               <div class="row">
                  <div class="text-center">
                     <button class="btn btn-lg btn-primary" type="button" id="okBtn">OK</button>
                  </div>
               </div>
            </div>
            <!-- start: page -->
            <!-- end: page -->
         </section>
      </div>
   </section>

   <script>
      const okBtn = document.getElementById("okBtn").addEventListener("click", () => {
         window.location = "./homepage.php";
      })
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

   <!-- Theme Base, Components and Settings -->
   <script src="assets/javascripts/theme.js"></script>

   <!-- Theme Custom -->
   <script src="assets/javascripts/theme.custom.js"></script>

   <!-- Theme Initialization Files -->
   <script src="assets/javascripts/theme.init.js"></script>
</body>
</html>