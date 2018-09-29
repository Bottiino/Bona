<?php     
    echo'
        <header>
            <div class="container-fluid position-relative no-side-padding">
                <a href="index.php" class="logo"><img src="images/logo.png" alt="Logo Image"></a>
                <div class="menu-nav-icon" data-nav-menu="#main-menu">
                    <i class="ion-navicon"></i>
                </div>
                <ul class="main-menu visible-on-click" id="main-menu">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="postForm.php">Post</a></li>
                        <li><a href="searchForm.php">Search</a></li>
                </ul>';

    if(empty($_SESSION['userID']))
    {echo
                '<ul id="headerRight" class="main-menu visible-on-click" id="main-menu">
                        <li><a href="loginForm.php">Login</a></li>
                        <li><a href="registerForm.php">Register</a></li>
                </ul>                        
            </div>
        </header>';
    }
    else
    {
        $headerUserInfo = getUserInfoByID($_SESSION['userID']);
        echo
                '<ul id="headerRight" class="main-menu visible-on-click" id="main-menu">
                        <li><a class="context-menu">'. $headerUserInfo['username'] .'</a></li>
                        <li><a href="Processing/logout.php">Logout</a></li>
                </ul>                       
            </div>
        </header>';
    }
?>