<?php
if(!defined('ROOT')) define('ROOT', $_SERVER['DOCUMENT_ROOT']);

require ROOT.'/inc/connect.php'; //Set connection

session_start();
if(isset($_SESSION['user_login'])){
    $username_db=$_SESSION['user_username'];
    header("Location:/".$username_db);
    exit();
} else if(isset($_COOKIE['user_login'])){
    $cookieAuth=$_COOKIE['user_login'];
    $checkcookieholder=mysqli_query($con, "select * FROM users WHERE rememberme='".$cookieAuth."' LIMIT 1");
    if(mysqli_num_rows($checkcookieholder) > 0){
        $checkcookieholder=mysqli_fetch_array($checkcookieholder);
        $_SESSION['user_login']=$checkcookieholder['email'];
        $_SESSION['user_uid']=$checkcookieholder['uid'];
        $username_db=$_SESSION['user_username']=$checkcookieholder['user_name'];
        $_SESSION['start_timestamp']=$checkcookieholder['lastlogin'];
        $_SESSION['last_timestamp']=$checkcookieholder['lastlogin'];
        header("Location:/".$username_db);
        exit();
    } else setcookie("user_login", "", time()-7600, "/", ".thebhaad.com");
}
if(isset($_SESSION['redirected_from']))
    unset($_SESSION['redirected_from']);

if(strpos(htmlspecialchars($_SERVER['REQUEST_URI']), 'index.php')){
    header("Location:/");
    exit();
}
?>
<!DOCTYPE html>
    <html>
        <head>
            <title>theBhaad.com - The online repository</title>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="/ce3b9fef_3ed388765c.css">
            <link href='http://fonts.googleapis.com/css?family=Gloria+Hallelujah|Handlee' rel='stylesheet' type='text/css'>
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1" />
            <script src="/js/jquery-1.11.1.min.js"></script>
            <script src="/0775d1bfe_51bf5a742c_bb78f0a6a781f.js"></script>
        </head>
        <body class="indexPage">
            <div class="logIndex_fp" id="main_wrapper">
                <header id="SignUp_page_logo">
                    <div class="NPinlHe NPLWrap">
                        <a href="./"><b>theBhaad.com!</b></a>
                        <span id="tagline">the Online Repository.</span></a>
                    </div>
                    <div class="NPinlHe uploadSignNP"><a class="oChHomePAnc upNPAnc" href="/">Search or Upload</a></div>
                </header>
                <div id="content_wrapper">
                    <?php include ROOT.'/inc/forms.php';?> 
                </div>
            </div><!--End of main content-->
            <?php include ROOT.'/inc/features.php';?>
            <footer>
                <?php include ROOT.'/inc/footer.php';?>
            </footer>
        </div>
    </body>
</html>