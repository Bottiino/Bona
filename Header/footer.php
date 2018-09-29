<?php
require 'Database/database.php';

        echo'
            <footer>
		<div class="container">
			<div class="row">

				<div class="col-lg-4 col-md-6">
					<div class="footer-section">

						<a class="logo" href="#"><img src="images/logo.png" alt="Logo Image"></a>
						<p class="copyright">Bona @ 2017. All rights reserved.</p>
						<p class="copyright">Designed by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
						<ul class="icons">
							<li><a href="https://www.facebook.com/colorlib"><i class="ion-social-facebook-outline"></i></a></li>
							<li><a href="https://twitter.com/colorlib"><i class="ion-social-twitter-outline"></i></a></li>
							<li><a href="https://www.instagram.com/colorlib/?hl=ens"><i class="ion-social-instagram-outline"></i></a></li>
							<li><a href="https://www.pinterest.ie/pin/8092474311305182/"><i class="ion-social-pinterest-outline"></i></a></li>
						</ul>

					</div><!-- footer-section -->
				</div><!-- col-lg-4 col-md-6 -->

				<div class="col-lg-4 col-md-6">
                                    <div class="footer-section">
                                    <h4 class="title"><b>Users</b></h4>
                                        <ul>';
                                            $getRandomUser = "SELECT UPPER(username) FROM users ORDER BY RAND() LIMIT 3";
                                            $statement = $db->prepare($getRandomUser);
                                            $statement->execute();
                                            $users = $statement->fetchAll();
                                            $statement->closeCursor();
                                                                                       
                                            foreach ($users as $user) : 

                                            echo'<li><a href="#" class="user">' . $user[0] . '</a></li></br>';

                                            endforeach;

                                   echo'</ul>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4 col-md-6">
					<div class="footer-section">

						<h4 class="title"><b>SUBSCRIBE</b></h4>
						<div class="input-area">
							<form id=subscribe>
								<input class="email-input" type="email" name="email" placeholder="Enter your email">
								<button class="submit-btn" type="submit" name="submit"><i class="icon ion-ios-email-outline"></i></button>
							</form>
						</div>

					</div><!-- footer-section -->
				</div><!-- col-lg-4 col-md-6 -->
			</div><!-- row -->
		</div><!-- container -->
            </footer>';
?>