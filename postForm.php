<?php 
    include 'database/database.php';
    include_once 'database/session.php';
    include_once 'database/validate.php';
    include 'database/functions.php';
    
    $error = filter_input(INPUT_GET, 'error');
    
    checkLoggedInPhp();
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>TITLE</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">

	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">

	<!-- Stylesheets -->
	<link href="common-css/bootstrap.css" rel="stylesheet">
	<link href="common-css/ionicons.css" rel="stylesheet">        
        <link href="single-post-2/css/styles.css" rel="stylesheet">
	<link href="single-post-2/css/responsive.css" rel="stylesheet">
	<link href="blank-static/css/styles.css" rel="stylesheet">
	<link href="blank-static/css/responsive.css" rel="stylesheet">
</head>
<body >
    <?php
        include 'Header/header.php';
    ?>

    <div class="slider display-table center-text">
            <h1 class="title display-table-cell"><b>Create Post</b></h1>
    </div><!-- slider -->

    <section class="comment-section center-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-0"></div>
                <div class="col-lg-8 col-md-12">
                    <div class="comment-form">
                        <form id="postForm">
                            <div class="row">
                                <div class="col-sm-6">
                                        <input type="text" aria-required="true" name="postTopic" pattern="[A-Za-z ]{1,250}" title="No numbers allowed!" class="form-control capital"
                                                placeholder="Enter your topic" required>
                                </div>
                                <div class="col-sm-6">
                                        <input type="text" aria-required="true" name="postTitle" class="form-control capital"
                                                placeholder="Enter your title" required>
                                </div>
                                <div class="col-sm-6">
                                        <input type="text" aria-required="true" name="postText" class="form-control capital"
                                                placeholder="Enter your text" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <h5>Want Feedback?</h5>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">                                    
                                    <label>Yes</label>
                                    <input type="radio" aria-required="true" name="feedback" class="form-control"
                                            value="1" required>
                                </div>
                                <div class="col-sm-6"> 
                                    <label>No</label>
                                        <input type="radio" aria-required="true" name="feedback" class="form-control"
                                                value="0" required>
                                </div>
                                <div class="col-sm-12">
                                        <button class="submit-btn" type="submit" name="submit" id="form-submit"><b>SUBMIT</b></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>        
    </section>  

    <?php
        errorBox($error); 
        include 'Header/footer.php' ;
    ?>
    
    <script src="common-js/jquery-3.1.1.min.js"></script>
    <script src="common-js/tether.min.js"></script>
    <script src="common-js/bootstrap.js"></script>
    <script src="common-js/scripts.js"></script>
    <script src="Ajax/jquery.min.js" type="text/javascript"></script>
    <script src="Ajax/getInfo.js" type="text/javascript"></script>
</body>
</html>
