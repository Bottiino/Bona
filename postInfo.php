<?php
    include 'database/database.php';
    include_once 'database/session.php';
    include_once 'database/validate.php';
    include 'database/functions.php';
    
    $postID = check_input($_GET['postID']);
    
    $postInfo = getPostInfoByID($postID);
    $userInfo = getUserInfoByID($postInfo['userID']);
    $comments = getCommentsForPost($postID);
    $commentCount = getCommentCount($postID);
     
    if($postInfo['feedback'] == 0)
    {
        ?>
            <style>
            #comForm
            {
                display: none;
            }
            </style>
        <?php
    }
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
</head>
<body>
	
    <?php
        include 'Header/header.php' ;
    ?>
    
	<div class="slider">

	</div><!-- slider -->

	<section class="post-area">
		<div class="container">

			<div class="row">

				<div class="col-lg-1 col-md-0"></div>
				<div class="col-lg-10 col-md-12">

					<div class="main-post">

						<div class="post-top-area">

							<h5 class="pre-title"><?php echo $postInfo['postTopic'];?></h5>

							<h3 class="title"><a href="#"><b><?php echo $postInfo['postTitle'];?></b></a></h3>

							<div class="post-info">

								<div class="left-area">
									<a class="avatar" href="#"><img src="Avatars/<?php echo $userInfo['userID'] . ".png";?>" alt="Profile Image"></a>
								</div>

								<div class="middle-area">
									<a class="name" href="#"><b><?php echo $userInfo['username'] ?></b></a>
									<h6 class="date"><?php echo $postInfo['timestamp'] ?></h6>
								</div>

							</div>

							<p class="para"><?php echo makeLink($postInfo['postText']); ?></p>

						</div>

						<div class="post-bottom-area">

							<ul class="tags">
                                                            <?php           
                                                                if(!empty($postInfo['postTags'])){
                                                                    $string = rtrim($postInfo['postTags'], ', ');
                                                                    $tags = explode(',', $string);
                                                                }
                                                                else{
                                                                    $tags = [];
                                                                }
                                                                foreach ($tags as $tag) :                                                                 
                                                            ?>
                                                            
                                                            <li>
                                                                    <a href="#" class="tag" name="<?Php echo $tag ?>"><?Php echo $tag ?></a>
                                                            </li>
                                                                
                                                            <?php endforeach; ?>
							</ul>

							<div class="post-icons-area">
                                                            <form class="likeForm">
								<ul class="post-icons">                                                                    
                                                                    <input type="hidden" name="postID" value="<?Php echo $postID ?>">
                                                                    <li><a href="" class="like"><i class="ion-heart"></i><?php echo $postInfo['upvote'] ?></a></li>
                                                                    <?Php 
                                                                        if($postInfo['feedback'] == 1)
                                                                        {
                                                                            echo '<li><a href="#anchor"><i class="ion-chatbubble"></i>' . $commentCount . '</a></li>';
                                                                        }
                                                                        else
                                                                        {
                                                                            echo '<li><a><i class="ion-android-lock"></i></a></li>';
                                                                        }
                                                                    ?>
                                                                    <li><a href="" class="dislike"><i class="ion-heart-broken"></i><?php echo $postInfo['downvote'] ?></a></li>                                                                    
								</ul>
                                                            </form>

								<ul class="icons">
									<li>SHARE : </li>
									<li><a href="https://en-gb.facebook.com/login/"><i class="ion-social-facebook"></i></a></li>
									<li><a href="https://twitter.com/login?lang=en"><i class="ion-social-twitter"></i></a></li>
									<li><a href="https://www.pinterest.ie/login/"><i class="ion-social-pinterest"></i></a></li>
								</ul>
							</div>

							<div class="post-footer post-info">

								<div class="left-area">
									<a class="avatar" href="#"><img src="Avatars/<?php echo $userInfo['userID'] . ".png";?>" alt="Profile Image"></a>
								</div>

								<div class="middle-area">
									<a class="name" href="#"><b><?php echo $userInfo['username'] ?></b></a>
									<h6 class="date"><?php echo $postInfo['timestamp'] ?></h6>
								</div>

							</div><!-- post-info -->

						</div><!-- post-bottom-area -->

					</div><!-- main-post -->
				</div><!-- col-lg-8 col-md-12 -->
			</div><!-- row -->
		</div><!-- container -->
	</section><!-- post-area -->

        <section id="comForm" class="comment-section center-text">
            <div class="container"><br/>
                <a name='anchor'><h4><b>POST COMMENT</b></h4></a>
                <div class="row">

                    <div class="col-lg-2 col-md-0"></div>

                    <div class="col-lg-8 col-md-12">
                        <div class="comment-form">
                            <form id="commentForm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="hidden" name="postID" value="<?php echo $postID ?>">
                                    </div>
                                    <div class="col-sm-12">
                                        <textarea id="commentText" name="commentText" rows="2" class="text-area-messge form-control capital"
                                                placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea>
                                    </div>
                                    <div class="col-sm-12">
                                        <button class="submit-btn" id="form-submit"><b>POST COMMENT</b></button>									
                                    </div>
                                </div><!-- row -->
                            </form>
                        </div><!-- comment-form -->                                  
                    </div><!-- col-lg-8 col-md-12 -->
                    
                    <?Php 
                        errorBox(''); 
                    ?>
                    
                </div><!-- row -->

            </div><!-- container -->

            <div class="container"><br/>
                <div class="row">

                    <div class="col-lg-2 col-md-0"></div>

                        <div id="comment" class="col-lg-8 col-md-12">

                            <h4><b>COMMENTS(<?php echo getCommentCount($postID); ?>)</b></h4>

                            <?php foreach ($comments as $comment) : ?>
                            <?php
                                $commenterInfo = getUserInfoByID($comment['userID']);
                            ?>

                                <div class="commnets-area text-left">

                                    <div class="comment">

                                        <div class="post-info">

                                            <div class="left-area">
                                                    <a class="avatar" href="#"><img src="Avatars/<?php echo $comment['userID'] . ".png";?>" alt="Profile Image"></a>
                                            </div>

                                            <div class="middle-area">
                                                    <a class="name" href="#"><b><?php echo $commenterInfo['username']; ?></b></a>
                                                    <h6 class="date"><?Php echo $comment['timestamp']?></h6>
                                            </div>

                                        </div>

                                        <p><?php echo makeLink($comment['commentText']); ?></p>

                                    </div>

                                </div><!-- commnets-area -->

                            <?php endforeach; ?>

                    </div><!-- col-lg-8 col-md-12 -->

                </div><!-- row -->

            </div><!-- container -->
                
	</section>

	<?php
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
