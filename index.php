<?php

require "auth.php";
if ($_SESSION["loggedin"] == null) {
    $url = "/login.php";
    header("location: ". $url);
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Profile Index</title>
    <style>
        .text-large {
            font-size: 150%;
        }
    </style>
</head>
<body>
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
<div class="container">
    <h2 class="header text-center">Profiles</h2>
    <?php foreach ($data AS $item): ?>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                </tr>
            </thead>
            <tr>
                <th class="text-capitalize font-weight-bold text-large"><a href="profile.php?user=<?php echo $item['id']?>"><?php echo $item["first_name"]; ?></a></th>
                <th class="text-capitalize font-weight-bold text-large"><a href="profile.php?user=<?php echo $item['id']?>"><?php echo $item["last_name"]; ?></a></th>
            </tr>
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Email Address</th>
                    <th scope="col">Preferred Language</th>
                </tr>
            </thead>
            <tr>
                <th class="font-weight-bold text-large"><?php echo $item["email"]; ?></th>
                <th class="font-weight-bold text-large"><?php echo $item["preferred_language"]; ?></th>
            </tr>
            <thead class="thead-dark">
                <tr>
                    <th scope="col">GitHub Page</th>
                </tr>
            </thead>
            <tr>
                <th><a class="font-weight-bold" href="<?php echo $item["github"]; ?>">Link to Github Profile</a></th>
            </tr>
        </table>
        <hr>
    <?php endforeach; ?>
</div>
</body>
</html>
