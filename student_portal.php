<?php
/**
 * ===========================================
 * home page for student or STUDENT PORTAl
 * ===========================================
 * 
 */
session_start();

//check if the user islogin or not
    if (isset($_SESSION['user_id']) && $_SESSION['user_id']!=NULL) { 
        if($_SESSION['reset_status']== 0) { 
          redirect('user_accounts/student_password_reset.php');
        }
        
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="image/rsz_12logo.png">

    <title>GIMS Student Portal</title>

    <!-- Bootstrap core CSS -->
    <link href="http://v4-alpha.getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://v4-alpha.getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>

    <!-- Custom styles for this template -->
    <link href="http://v4-alpha.getbootstrap.com/examples/carousel/carousel.css" rel="stylesheet">
        <style>
          

        </style>
  
  </head>
  <body>

    <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse ">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">Student Portal</a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Results</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Events</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <!-- <button class="btn btn-outline-success my-2 my-sm-0">Search</button> -->
      <a href="user_accounts/student_logout.php" class="btn btn-outline-danger my-2 my-sm-0"> LOGOUT  </a>
    </form>
  </div>
</nav>


    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1" class=""></li>
        <li data-target="#myCarousel" data-slide-to="2" class=""></li>
        <li data-target="#myCarousel" data-slide-to="3" class=""></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
          <img class="first-slide" src="image/bg1.jpg" alt="First slide">
          <!-- <div class="container">
            <div class="carousel-caption text-left">
              <h1>Example headline.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
            </div>
          </div> -->
        </div>
        <div class="carousel-item">
          <img class="second-slide carousel-image" src="image/bg2.jpg" alt="Second slide" >
          <!-- <div class="container">
            <div class="carousel-caption">
              <h1>Another example headline.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
            </div>
          </div> -->
        </div>
        <div class="carousel-item">
          <img class="third-slide" src="image/bg3.jpg" alt="Third slide">
          <!-- <div class="container">
            <div class="carousel-caption text-right">
              <h1>One more for good measure.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
            </div>
          </div> -->
        </div>
        <div class="carousel-item">
          <img class="third-slide" src="image/bg4.jpg" alt="Third slide">
          <!-- <div class="container">
            <div class="carousel-caption text-right">
              <h1>One more for good measure.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
            </div>
          </div> -->
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- Three columns of text below the carousel
      <div class="row">
        <div class="col-lg-4">
          <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
          <h2>Heading</h2>
          <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
          <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
        </div><! /.col-lg-4
        <div class="col-lg-4">
          <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
          <h2>Heading</h2>
          <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
          <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
        </div>< /.col-lg-4
        <div class="col-lg-4">
          <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
          <h2>Heading</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
        </div><! /.col-lg-4
      </div><! /.row -->


      <!-- START THE FEATURETTES -->

      <!-- <hr class="featurette-divider"> -->

      <div class="row featurette">
      <div class="col-md-1" ></div>
      <div class="col-md-4">
          <img class="featurette-image img-fluid center-block" style="width:350px;" alt="500x500" src="image/Picture 032.jpg" data-holder-rendered="">
        </div>
        <div class="col-md-6">
          <h1 class=" text-right ">Dr. Aamir Nabi Rana<br> <sub>Director general <br>(GIMS)</sub></h1>
            <hr>
            <h2 class="text-center" >Chairman's Commitment to Diversity and Inclusion</h2>
          <p class="lead text-justify">
            The mission of GIMS to 
            "inspire, prepare and empower students to succeed in a changing world". <br>
            Our shared vision is to be recognized as 
            " a national leader in transforming lives through an innovative , rigous
             and compassionate approach to education".
          </p>
        </div>
        
      </div>

      <hr>
        
        <div class="row" >
            <div class="col-md-1 col-sm-0" >
                
            </div>
            <div class="col-md-3 col-sm-6" >
                <div class="card">
                    <div class="card-header text-capitalize ">
                        TEACHER EVALUATION
                    </div>
                    <div class="card-block">
                        <h4 class="card-title text-center text-info ">Note!</h4>
                        <p class="card-text">
                            Its totaly Anonymous and Secret.
                            So feel free to give 100% true feedback.
                        </p>
                        <a href="student_teacher_course_evaluation/teacher_course_evaluation.php" class="btn btn-primary">Evaluate</a>
                    </div>
                </div> 
            </div>
            <div class="col-md-3 col-sm-6" >
                    <div class="card">
                        <div class="card-header text-capitalize">
                            COURSE EVALUATION
                        </div>
                        <div class="card-block">
                            <h4 class="card-title text-center text-info ">Note!</h4>
                            <p class="card-text">
                                Its totaly Anonymous and Secret.
                                So feel free to give 100% true feedback.
                            </p>
                            <a href="course_evaluation/course_evaluation.php" class="btn btn-primary">Evaluate</a>
                        </div>
                    </div> 

            </div>
            <div class="col-md-3 col-sm-6" >
                <div class="card">
                    <div class="card-header text-capitalize">
                        RESULTS
                    </div>
                    <div class="card-block">
                        <h4 class="card-title text-center text-info ">Previous Exam Records</h4>
                        <p class="card-text">Best luck For Future Exams<br><br></p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
             </div>
            <!-- <div class="col-1" ></div> -->
        </div>
      
      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->


      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>© 2014 GIMS, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
      </footer>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="http://v4-alpha.getbootstrap.com/assets/js/vendor/jquery.min.js"></script>')</script>
    <script src="http://v4-alpha.getbootstrap.com/dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="http://v4-alpha.getbootstrap.com/assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://v4-alpha.getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>

    <svg xmlns="http://www.w3.org/2000/svg"
      width="500"
      height="500"
      viewBox="0 0 500 500"
      preserveAspectRatio="none"
      style="
        display: none;
        visibility: hidden;
        position: absolute;
        top: -100%;
        left: -100%;
      "
    >
      <defs>
        <style type="text/css"></style>
      </defs>
      <text
        x="0"
        y="25"
        style="
          font-weight:bold;
          font-size:25pt;
          font-family:Arial, Helvetica, Open Sans, sans-serif
        "
      >
        500x500
      </text>
    </svg>
  </body>
</html>
<?php
} else {
  redirect("student_login.php");
}
function redirect($url) { //deffining the redirect function
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
  }

?>