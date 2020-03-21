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
$id = $_GET['id'];
$quiz = $_GET['quiz'];
$num = 1;

$getValue = "$id,$quiz";

$query = 'SELECT * FROM question 
            WHERE quizId = :quizId';
$stmt = $db->prepare($query);
$stmt->bindParam(':quizId', $id);
$stmt->execute();
?>

<!doctype html>
<html class="fixed sidebar-left-collapsed">

<head>

   <!-- Basic -->
   <meta charset="UTF-8">

   <title>Admin Website | View Questions</title>
   <meta name="keywords" content="HTML5 Admin Template" />
   <meta name="description" content="JSOFT Admin - Responsive HTML5 Template">
   <meta name="author" content="JSOFT.net">

   <!-- Mobile Metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

   <!-- Web Fonts  -->
   <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

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
               <h2>View Questions</h2>
            </header>
            <div class="panel-body">
               <h2><i class="fa fa-cube"></i> <?php echo $quiz; ?></h2>
               <div class="row">
                  <div class="col-sm-11 text-right">
                     <button id="delete" type="button" class="btn btn-danger">Delete <i class="fa fa-trash-o"></i></button><span> |</span>
                     <button id="viewScore" type="button" class="btn btn-primary">View Score <i class="fa fa-graduation-cap"></i></button>

                     <!-- <form action="./quizScore.php" method="GET">
                        <button type="submit" value="<?php echo $getValue ?>" name="viewScore" class="btn btn-primary">View Score <i class="fa fa-graduation-cap"></i></button>
                     </form> -->
                  </div>
               </div><br>

               <?php
               while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  echo '<section class="col-sm-10 col-sm-offset-1 panel-featured">';
                  echo '<div class="quesBlock">';
                  echo '<h5>' . $num . '. ' . $row['ques'] . '</h5>';
                  echo '<p class="choices"> A. ' . $row['choiceA'] . '</p>';
                  echo '<p class="choices"> B. ' . $row['choiceB'] . '</p>';
                  echo '<p class="choices"> C. ' . $row['choiceC'] . '</p>';
                  echo '<p class="choices"> D. ' . $row['choiceD'] . '</p>';
                  echo '<p class="text-dark answer"> Answer: ' . $row['answer'] . '</p>';

                  echo '<form action="./editQuesPage.php" method="GET">';
                  echo '<div class="row">';
                  echo '<div class="col-sm-12 text-right">';
                  echo '<button type="submit" value="' . $row['id'] . '" name="editQues" id="editQues" class="btn btn-info">Edit <i class="fa  fa-edit"></i></button>';
                  echo '</div>';
                  echo '</div>';
                  echo '</form>';
                  echo '</div><br>';
                  echo '</section>';
                  $num++;
               }
               ?>
            </div>
         </section>
      </div>
   </section>

   <script>
      const viewScoreBtn = document.getElementById("viewScore");
      const deleteBtn = document.getElementById("delete");

      const quizId = <?php echo $id; ?>;
      const quizName = "<?php echo $quiz; ?>";

      viewScoreBtn.addEventListener("click", () => {
         window.location = "./quizScore.php?id=" + quizId + "&quiz=" + quizName;
      })

      deleteBtn.addEventListener("click", () => {
         let confirmBox = confirm("Are you sure?\nThis will delete all the records associated with this quiz including the quiz scores and questions.")

         if (confirmBox == true) {
            window.location = "./delete.php?id=" + quizId;
         } else {
            
         }
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
</body>

</html>