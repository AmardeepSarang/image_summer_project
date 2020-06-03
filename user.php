<?php
session_start();
include_once 'include/config.php';

//get user (temp just set it)
$user = 111;


// Connect to MySQL
$db = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

// Error checking
if (!$db) {
    print "<p>Error - Could not connect to MySQL</p>";
    exit;
}
$error = mysqli_connect_error();

if ($error != null) {
    $output = "<p>Unable to connet to database</p>" . $error;
    exit($output);
}

function getImgUploaded($db, $user){
    //prints out the # images uploaded by the user
    $query="SELECT COUNT(*) as count FROM `image` WHERE uploaded_by=$user";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    echo $row["count"];
}

function getImgEdited($db, $user){
    //prints out the # images edited by the user
    $query="SELECT COUNT(*) as count FROM `image` WHERE edited_by=$user";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    echo $row["count"];
}
function getImgLiked($db, $user){
    //prints out the # images liked by the user
    $query="SELECT COUNT(*) as count FROM likes WHERE user_id=$user";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    echo $row["count"];
}

function getLikeOnUpload($db, $user){
    //prints out the # images liked by the user
    $query="SELECT COUNT(*) as count FROM image, likes WHERE image.Img_id=likes.img_id AND image.uploaded_by=$user";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    echo $row["count"];
}

function getLikeOnEdited($db, $user){
    //prints out the # images liked by the user
    $query="SELECT COUNT(*) as count FROM image, likes WHERE image.Img_id=likes.img_id AND image.edited_by=$user";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    echo $row["count"];
}

?>
<!DOCTYPE html>
<html lan="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User profile</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/57c4c79ee8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
</head>

<body>

    <!--
        main nav bar
    -->
    <nav class="main-nav">
        <div class="logo">
            <img src="images/logo.png">

        </div>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <div class="post-bt">
            <a href="#"><i class="fas fa-plus"></i>&nbsp Post new image</a>
        </div>
        <ul class="nav-links">
            <li><a href="#"><i class="fas fa-th"></i>&nbsp Gallery</a></li>
            <li><a href="#"><i class="fas fa-house-user"></i>&nbsp My dashboard</a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i>&nbsp Sign out</a></li>
            <li><a href="#"><i class="fas fa-question-circle"></i>&nbsp About</a></li>
        </ul>
    </nav>
    
    <!--
        Full screen image div
    -->
    <div class="gal-full-view">
        <button class="fullscreen-close-bt"><i class="far fa-times-circle"></i></button>
        <img src="">
    </div>
    
    <!--
        Start of page content
    -->
    <div class="user-heading user-welcome">
    <h1>Welcome, Amardeep! Take a look at what you have been up to on Exposure</h1>
</div>
    <div class="user-heading">
        <button type="button" data-toggle="collapse" data-target="#stat-fold"><i
                class="fas fa-chevron-circle-down"></i></button>

        <h1>Your Exposure Stats</h1>

    </div>

    <div class="fold-con collapse in" id="stat-fold">
        <div class="user-stats">
            <p>Images Uploaded: <b><?php getImgUploaded($db, $user)?></b></p>
            <p>Images Edited: <b><?php getImgEdited($db, $user)?></b></p>
            <p>Images Liked: <b><?php getImgLiked($db, $user)?></b></p>
            <p>Likes On Images <br>You Uploaded: <b><?php getLikeOnUpload($db, $user)?></b></p>
            <p>Likes On Images <br>You Edited: <b><?php getLikeOnEdited($db, $user)?></b></p>
        </div>
    </div>


    <div class="user-heading">
        <button type="button" data-toggle="collapse" data-target="#like-fold"><i
                class="fas fa-chevron-circle-down"></i></button>

        <h1>Images You Liked</h1>

    </div>

    <div class="fold-con collapse in" id="like-fold">
        <div class="gallery_container">
            <div class="img_box"><img src="/images/img (2).jpg">
                <div class="pic-edit-picker">
                    <span><img class="pic-edit-picked" src="/images/img (2).jpg"></span>
                    <span><img src="/images/img2-edits/img (2)-a.jpg"></span>
                    <span><img src="/images/img2-edits/img (2)-b.jpg"></span>
                    <span><img src="/images/img2-edits/img (2)-c.jpg"></span>
                   
                </div>
                <div class="pic-control-bar">
                    <span><button><i class="fas fa-thumbs-up"></i></button></span>
                    <span><button><i class="fas fa-plus-square"></i></button></span>
                    <span><button class="fullscreen-bt"><i class="fas fa-expand"></i></button></span>
                    <span><button><i class="fas fa-info-circle"></i></button></span>
                    <span><button class="edit-sl-arw-l"><i class="fas fa-arrow-left"></i></button></span>
                    <span><button class="edit-sl-bn"><i class="fas fa-images"></i></button></span>
                    <span><button class="edit-sl-arw-r"><i class="fas fa-arrow-right"></i></button></span>
                </div>
            </div>
            <div class="img_box"><img src="/images/img (10).jpg"></div>
            <div class="img_box"><img src="/images/img (11).jpg"></div>
            <div class="img_box"><img src="/images/img (12).jpg"></div>
            <div class="img_box"><img src="/images/img (13).jpg"></div>
            <div class="img_box"><img src="/images/img (14).jpg"></div>
            <div class="img_box"><img src="/images/img (15).jpg"></div>
            <div class="img_box"><img src="/images/img (16).jpg"></div>
        </div>
    </div>

    <div class="user-heading">
        <button type="button" data-toggle="collapse" data-target="#edit-fold"><i
                class="fas fa-chevron-circle-right"></i></button>

        <h1>Images You Edited</h1>

    </div>

    <div class="fold-con collapse" id="edit-fold">
        <div class="gallery_container">
            <div class="img_box"><img src="/images/img (2).jpg">
                <div class="pic-edit-picker">
                    <span><img class="pic-edit-picked" src="/images/img (2).jpg"></span>
                    <span><img src="/images/img2-edits/img (2)-a.jpg"></span>
                    <span><img src="/images/img2-edits/img (2)-b.jpg"></span>
                    <span><img src="/images/img2-edits/img (2)-c.jpg"></span>
                   
                </div>
                <div class="pic-control-bar">
                    <span><button><i class="fas fa-thumbs-up"></i></button></span>
                    <span><button><i class="fas fa-plus-square"></i></button></span>
                    <span><button class="fullscreen-bt"><i class="fas fa-expand"></i></button></span>
                    <span><button><i class="fas fa-info-circle"></i></button></span>
                    <span><button class="edit-sl-arw-l"><i class="fas fa-arrow-left"></i></button></span>
                    <span><button class="edit-sl-bn"><i class="fas fa-images"></i></button></span>
                    <span><button class="edit-sl-arw-r"><i class="fas fa-arrow-right"></i></button></span>
                </div>
            </div>
            <div class="img_box"><img src="/images/img (14).jpg"></div>
            <div class="img_box"><img src="/images/img (15).jpg"></div>
            <div class="img_box"><img src="/images/img (16).jpg"></div>
        </div>
    </div>

    <div class="user-heading">
        <button type="button" data-toggle="collapse" data-target="#upload-fold"><i
                class="fas fa-chevron-circle-right"></i></button>

        <h1>Images You Uploaded</h1>

    </div>

    <div class="fold-con collapse" id="upload-fold">
        <div class="gallery_container">

            <div class="img_box"><img src="/images/img (2).jpg">
                <div class="pic-edit-picker">
                    <span><img class="pic-edit-picked" src="/images/img (2).jpg"></span>
                    <span><img src="/images/img2-edits/img (2)-a.jpg"></span>
                    <span><img src="/images/img2-edits/img (2)-b.jpg"></span>
                    <span><img src="/images/img2-edits/img (2)-c.jpg"></span>
                   
                </div>
                <div class="pic-control-bar">
                    <span><button><i class="fas fa-thumbs-up"></i></button></span>
                    <span><button><i class="fas fa-plus-square"></i></button></span>
                    <span><button class="fullscreen-bt"><i class="fas fa-expand"></i></button></span>
                    <span><button><i class="fas fa-info-circle"></i></button></span>
                    <span><button class="edit-sl-arw-l"><i class="fas fa-arrow-left"></i></button></span>
                    <span><button class="edit-sl-bn"><i class="fas fa-images"></i></button></span>
                    <span><button class="edit-sl-arw-r"><i class="fas fa-arrow-right"></i></button></span>
                </div>
            </div>
            <div class="img_box"><img src="/images/img (11).jpg"></div>
            <div class="img_box"><img src="/images/img (12).jpg"></div>
        </div>
    </div>

    <script src="js/user.js"></script>
    <script src="js/nav.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/gallery.js"></script>
</body>