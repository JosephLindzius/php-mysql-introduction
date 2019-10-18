<?php
require "auth.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="./profile.php">Individual Profiles<span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="register.php">Add New Student<span class="sr-only">(current)</span></a>
            </div>
        </div>
    </nav>
</header>
<body>
<div class="container">
    <div class="row">
        <form class="form-group col-12" action="register.php" method="post">
            <div class="form-group m-5">
                <label for="first_name">First Name <input class="form-control" type="text" name="first_name" value="<?php if (!empty($_SESSION['first_name'])) {echo $_SESSION['first_name'];}?>"></label>
                <label for="last_name">Last Name <input class="form-control" type="text" name="last_name" value="<?php if (!empty($_SESSION['last_name'])) {echo $_SESSION['last_name'];}?>"></label>
                <label for="username">Username <input class="form-control" type="text" name="username" value="<?php if (!empty($_SESSION['username'])) {echo $_SESSION['username'];}?>"></label>
            </div>
            <div class="form-group m-5">
                <label for="linkedin">LinkedIn <input class="form-control" type="text" name="linkedin" value="<?php if (!empty($_SESSION['linkedin'])) {echo $_SESSION['linkedin'];}?>"></label>
                <label for="github">Github <input class="form-control" type="text" name="github" value="<?php if (!empty($_SESSION['github'])) {echo $_SESSION['github'];}?>"></label>
                <label for="email">Email <input class="form-control" type="text" name="email" value="<?php if (!empty($_SESSION['email'])) {echo $_SESSION['email'];}?>"><?php echo "<span class='alert-danger'>";
                    echo  $emailErr;
                    echo "</span>"; ?></label>
            </div>
            <div class="form-group m-5">
                <label for="preferred_language">Preferred Language
                    <select class="form-control" name="preferred_language">
                        <option value="en">English</option>
                        <option value="nl">Nederlands</option>
                        <option value="fr">French</option>
                    </select>
                </label>
                <label for="avatar">Avatar <input class="form-control" type="text" name="avatar" value="<?php if (!empty($_SESSION['avatar'])) {echo $_SESSION['avatar'];}?>"></label>
                <label for="video">Video <input class="form-control" type="text" name="video" value="<?php if (!empty($_SESSION['video'])) {echo $_SESSION['video'];}?>"></label>
            </div>
            <div class="form-group m-5">
                <label for="quote">Quote <input class="form-control" type="text" name="quote" value="<?php if (!empty($_SESSION['quote'])) {echo $_SESSION['quote'];}?>"></label>
                <label for="quote_author">Quote Author <input class="form-control" type="text" name="quote_author" value="<?php if (!empty($_SESSION['quote'])) {echo $_SESSION['quote'];}?>"></label>
            </div>
            <div class="form-group m-5">
                <label for="password">Password:
                    <input class="form-control" name="password" type="password" >
                </label>
                <label for="password">Confirm Password:
                    <input class="form-control" name="passwordConfirm" type="password" >
                </label>
            </div>
            <div class="form-group">
                <input class="form-control btn btn-primary" type="submit">
            </div>
        </form>
    </div>


</div>

</body>
</html>

