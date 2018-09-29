<?php
    include_once 'Database/session.php';
    require 'Database/database.php';
    include 'Database/functions.php';
    
    $error = filter_input(INPUT_GET, 'error');
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
	<link href="layout-1/css/styles.css" rel="stylesheet">
	<link href="layout-1/css/responsive.css" rel="stylesheet">
</head>
<body>

	<?Php 
            include 'Header/header.php';
        ?>

	<div class="slider"></div><!-- slider -->

	<section class="blog-area section">
		<div class="container">

			<div class="row">
                            
                            <?php                
                                $allPosts = getPosts();
                                foreach ($allPosts as $post) : 
                                $text = makeLink($post['postText']);
                                $commentCount = getCommentCount($post['postID']);
                            ?>

                            <div class="col-lg-4 col-md-6">
                                <div class="card h-100">
                                    <div class="single-post post-style-1">
                                        <div class="blog-image">
                                            <img src="bg/<?Php echo $post['imageNum'] ?>.jpg" alt="Blog Image" />
                                        </div>
                                        <a id="avatar" class="avatar" href="postInfo.php?postID=<?php echo $post['postID'] ?>">
                                            <img id="avatar" src="Avatars/<?php echo $post['userID'] . ".png";?>" alt="Profile Image">
                                        </a>
                                        <div class="blog-info">
                                            <h4 class="title">
                                                <a id="avatar" href="postInfo.php?postID=<?php echo $post['postID'] ?>">
                                                    <b>
                                                        <?php echo $post['postTitle'] ?>
                                                    </b>
                                                </a>
                                            </h4>
                                            <form class="likeForm">
                                                <input type="hidden" name="postID" value="<?Php echo $post['postID'] ?>">                                                
                                                <ul class="post-footer">
                                                    <li><a href="#" class="like"><i class="ion-heart"></i><?php echo $post['upvote'] ?></a></li>
                                                    <?Php 
                                                        if($post['feedback'] == 1)
                                                        {
                                                            echo '<li><a href="postInfo.php?postID=' . $post['postID'] . '#anchor"><i class="ion-chatbubble"></i>' . $commentCount . '</a></li>';
                                                        }
                                                        else
                                                        {
                                                            echo '<li><a href="postInfo.php?postID=' . $post['postID'] . '"><i class="ion-android-lock"></i></a></li>';
                                                        }
                                                    ?>
                                                    <li><a href="#" class="dislike"><i class="ion-heart-broken"></i><?php echo $post['downvote'] ?></a></li>
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php endforeach; ?>

			</div><!-- row -->

		</div><!-- container -->
	</section><!-- section -->

	<?php
            errorBox($error); 
            include 'Header/footer.php' ;
        ?>

	<!-- SCIPTS -->
	<script src="common-js/jquery-3.1.1.min.js"></script>
	<script src="common-js/tether.min.js"></script>
	<script src="common-js/bootstrap.js"></script>
	<script src="common-js/scripts.js"></script>
        <script src="Ajax/getInfo.js"></script>
</body>
</html>
