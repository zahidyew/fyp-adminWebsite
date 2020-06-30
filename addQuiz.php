<?php
session_start();

// if loggedIn var is not set, then the admin has not logged in
if (!isset($_SESSION['loggedIn'])) {
   header("Location: index.php");
}
$username = $_SESSION['username'];
?>

<!doctype html>
<html class="fixed sidebar-left-collapsed">

<head>

   <!-- Basic -->
   <meta charset="UTF-8">

   <title>Admin Website | Add New Quiz</title>
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
               <h2>Add New Quiz</h2>
            </header>
            <div class="row">
               <div class="col-lg-12">
                  <section class="panel">
                     <div class="col-sm-10 col-sm-offset-1 panel-body">
                        <form>
                           <section class="panel-featured">
                              <header class="panel-heading">
                                 <h2 class="panel-title">Add New Quiz</h2>
                              </header>
                              <div class="panel-body">
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label">Quiz Name <span class="required"></span></label>
                                    <div class="col-sm-6">
                                       <input type="text" name="quizName" id="quizName" class="form-control" required>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label">Number of Questions <span class="required"></span></label>
                                    <div class="col-sm-2">
                                       <input type="number" name="numOfQues" id="numOfQues" min="1" class="form-control" required>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label">Time Limit <span class="required"></span></label>
                                    <div class="col-sm-2">
                                       <input type="number" name="timeLimit" id="timeLimit" min="1" class="form-control" placeholder="in minutes" required>
                                    </div>
                                 </div>
                              </div>
                              <footer class="panel-footer" id="quizFooter">
                                 <div class="row">
                                    <div class="col-sm-12 text-right">
                                       <button class="btn btn-default" type="button" name="reset" id="reset">Reset</button><span> |</span>
                                       <button class="btn btn-primary" type="button" name="submit" id="submit">Submit</button>
                                    </div>
                                 </div>
                              </footer>
                           </section>
                        </form>
                     </div>
                  </section>
               </div>
            </div><br>

            <div class="row" id="quesSection">
               <div class="col-lg-12 qForm" style="display: none;">
                  <section class="panel">
                     <div class="col-sm-10 col-sm-offset-1 panel-body">
                        <form>
                           <section class="panel-featured panel-featured-info">
                              <header class="panel-heading">
                                 <h2 class="panel-title">Question</h2>
                                 <p class="panel-subtitle">For question with only 2 or 3 choices, please leave Choice C and/or Choice D empty.</p>
                              </header>
                              <div class="panel-body">
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label">Question <span class="required"></span></label>
                                    <div class="col-sm-8">
                                       <textarea name="question" class="form-control question" cols="80" rows="3" required></textarea>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label">Choice A <span class="required"></span></label>
                                    <div class="col-sm-6">
                                       <input type="text" name="choice1" class="form-control choice1" required>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label">Choice B <span class="required"></span></label>
                                    <div class="col-sm-6">
                                       <input type="text" name="choice2" class="form-control choice2" required>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label">Choice C <span class="required"></span></label>
                                    <div class="col-sm-6">
                                       <input type="text" name="choice3" class="form-control choice3">
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label">Choice D <span class="required"></span></label>
                                    <div class="col-sm-6">
                                       <input type="text" name="choice4" class="form-control choice4">
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label">Answer <span class="required"></span></label>
                                    <div class="col-sm-2">
                                       <input type="text" name="answer" class="form-control answer" placeholder="e.g., B" required>
                                    </div>
                                 </div>
                              </div>
                           </section>
                        </form>
                     </div>
                  </section>
               </div>
            </div>
         </section>

         <!-- make the footer appear with the buttons, give it an ID -->
         <footer class="panel-footer" style="display: none;" id="submitFooter">
            <div class="row">
               <div class="col-sm-11 text-right">
                  <button class="btn btn-primary" type="button" id="submit2">Submit</button>
               </div>
            </div>
         </footer>
      </div>
   </section>

   <script>
      const quizNameElem = document.getElementById("quizName");
      const numOfQuesElem = document.getElementById("numOfQues");
      const timeLimitElem = document.getElementById("timeLimit");
      const submitBtn = document.getElementById("submit");
      const resetBtn = document.getElementById("reset");
      const quizFooter = document.getElementById("quizFooter");

      const questionElem = document.getElementsByClassName("form-control question");
      const choice1Elem = document.getElementsByClassName("form-control choice1");
      const choice2Elem = document.getElementsByClassName("form-control choice2");
      const choice3Elem = document.getElementsByClassName("form-control choice3");
      const choice4Elem = document.getElementsByClassName("form-control choice4");
      const answerElem = document.getElementsByClassName("form-control answer");
      const submitBtn2 = document.getElementById("submit2");

      const submitFooter = document.getElementById("submitFooter");
      //const resetBtn2 = document.getElementById("reset2");

      var quizId;

      resetBtn.addEventListener("click", () => {
         quizNameElem.value = "";
         numOfQuesElem.value = "";
         timeLimitElem.value = "";
      });

      submitBtn.addEventListener("click", () => {
         // send a fetch request to a php file to process the input for quiz then, display the quest forms
         const quizData = getQuizFormValues();

         if (quizData === false) {
            alert("Please fill out all the fields.")
         } else {
            fetch('./quiz.php', {
                  method: 'POST',
                  headers: {
                     'Content-Type': 'application/json',
                  },
                  body: JSON.stringify(quizData)
               })
               .then((response) => response.json())
               .then((data) => {
                  quizId = data;
                  //console.log('Success:', data);
                  // here show the ques form
                  for (let i = 1; i <= quizData.ques; i++) {
                     createQuesForm();
                  }
                  submitFooter.style.display = "block";
                  //resetBtn2.style.display = "inline";   
               })
               .catch((error) => {
                  console.error('Error:', error);
               });
         }
      });

      function getQuizFormValues() {
         const quizName = quizNameElem.value;
         const numOfQues = numOfQuesElem.value;
         const timeLimit = timeLimitElem.value;

         // check if any required fields are empty. If yes, return false & alert user & dont send fetch request.
         if (quizName === "" || numOfQues === "" || timeLimit === "") {
            return false;
         } else {
            const quizData = {
               name: quizName,
               ques: numOfQues,
               time: timeLimit
            };
            //submitBtn.style.display = "none";
            //resetBtn.style.display = "none";
            quizNameElem.disabled = true;
            numOfQuesElem.disabled = true;
            timeLimitElem.disabled = true;
            quizFooter.style.display = "none";

            return quizData;
         }
      }

      function createQuesForm() {
         const element = document.getElementById("quesSection");
         const qForm = document.getElementsByClassName("col-lg-12 qForm");
         const cloneForm = qForm[0].cloneNode(true);

         cloneForm.style.display = "block";
         element.appendChild(cloneForm);
      }

      submitBtn2.addEventListener("click", () => {
         // console.log(questionsData);
         const questionsData = getQuesFormValue();

         if (questionsData === false) {
            alert("Please fill out all the fields.")
         } else {
            fetch('./question.php', {
                  method: 'POST',
                  headers: {
                     'Content-Type': 'application/json',
                  },
                  body: JSON.stringify(questionsData)
               })
               .then((response) => response.json())
               .then((data) => {
                  console.log('Success:', data);
                  alert("Success.");
                  location.replace("./homepage.php");
               })
               .catch((error) => {
                  console.error('Error:', error);
               });
         }
      });

      function getQuesFormValue() {
         const numOfQues = numOfQuesElem.value;
         let questionArray = [];
         let choice1Array = [];
         let choice2Array = [];
         let choice3Array = [];
         let choice4Array = [];
         let answerArray = [];

         // starts at index 1 as the "real 1st, i.e. [0]" is hidden by default.
         for (let i = 1; i <= numOfQues; i++) {
            // check if any required fields are empty. If yes, return false & alert user & dont send fetch request.
            if (questionElem[i].value === "" || choice1Elem[i].value === "" || choice2Elem[i].value === "" || answerElem[i].value === "") {
               return false;
            } else {
               if (i == 1) {
                  questionArray += questionElem[i].value;
                  choice1Array += choice1Elem[i].value;
                  choice2Array += choice2Elem[i].value;
                  choice3Array += choice3Elem[i].value;
                  choice4Array += choice4Elem[i].value;
                  answerArray += answerElem[i].value;
               } else {
                  questionArray += ";" + questionElem[i].value;
                  choice1Array += ";" + choice1Elem[i].value;
                  choice2Array += ";" + choice2Elem[i].value;
                  choice3Array += ";" + choice3Elem[i].value;
                  choice4Array += ";" + choice4Elem[i].value;
                  answerArray += ";" + answerElem[i].value;
               }
            }
         }

         const questionsData = {
            questions: questionArray,
            choiceA: choice1Array,
            choiceB: choice2Array,
            choiceC: choice3Array,
            choiceD: choice4Array,
            answers: answerArray,
            quizId: quizId,
            numOfQues: numOfQues
         };
         return questionsData;
      }
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