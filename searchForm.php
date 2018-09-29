<?php
    include_once 'Database/session.php';
    require 'Database/database.php';
    include 'Database/functions.php';
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
        <link href="layout-1/css/styles.css" rel="stylesheet">
	<link href="layout-1/css/responsive.css" rel="stylesheet">
</head>
<body >
    <?php
        include 'Header/header.php';
    ?>

    <div class="slider display-table center-text">
            <h1 class="title display-table-cell"><b>Search</b></h1>
    </div><!-- slider -->

    <section class="comment-section center-text">
        <div class="container">
            <div class="row">

                <div class="col-lg-2 col-md-0"></div>

                <div class="col-lg-8 col-md-12">

                    <div class="comment-form">

                        <form id="searchForm">

                            <div class="row">

                                <div class="col-sm-6">
                                        <input type="text" aria-required="true" name="username" class="form-control"
                                                placeholder="Enter a username">
                                </div>
                                <div class="col-sm-6">
                                        <input type="text" aria-required="true" name="tag" class="form-control"
                                                placeholder="Enter a tag">
                                </div>
                                <div class="col-sm-6">
                                        <input type="text" aria-required="true" name="keyword" class="form-control"
                                                placeholder="Enter a keyword">
                                </div>
                                <div class="col-sm-12">
                                        <button class="submit-btn" type="submit" name="submit" id="form-submit"><b>Search</b></button>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>        
    </section>
    
    <section class="blog-area section">
        <div class="container">
            <div id="postContainer"></div>
        </div><!-- container -->
    </section><!-- section -->
 
    <?php
        errorBox(''); 
        include 'Header/footer.php' ;
    ?>
    
    
</body>
</html>
<script src="common-js/jquery-3.1.1.min.js"></script>
    <script src="common-js/tether.min.js"></script>
    <script src="common-js/bootstrap.js"></script>
    <script src="common-js/scripts.js"></script>
    <script src="Ajax/jquery.min.js" type="text/javascript"></script>
    <script src="Ajax/getInfo.js" type="text/javascript"></script>
    <script>
        $(function () {
            var username = '<?php echo($_GET["username"]); ?>';
            var tag = '<?php echo($_GET["tag"]); ?>';
            var keyword = '<?php echo($_GET["keyword"]); ?>';
            
            if (username !== '' || tag !== '' || keyword !== ''){
                $('input[name=username]').val(username);
                $('input[name=tag]').val(tag);
                $('input[name=keyword]').val(keyword);
                
                var formData = {
                    username : username,
                    tag : tag,
                    keyword : keyword
                };   
                SearchByValues(formData);            
            }
        });
    </script>