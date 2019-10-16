<?php
 require "connection.php";

$emailErr = "";
$checker = false;
$passwordMatch = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $required = array("first_name", "last_name", "username", "linkedin", "github", "email", "preferred_language", "avatar", "video", "quote", "quote_author");

    $error = false;
    foreach($required as $field) {
        if (empty($_POST[$field])) {
            $error = true;
        }
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "$_POST[email] is NOT a valid email address";
    }

    if ($error) {
        echo "<span class='alert-danger'>All fields are required.</span><br>";
    } else {
        $checker = true;
    }
        $password = $_POST['password'];
        $passwordConfirm = $_POST['passwordConfirm'];


    if (password_verify($password, $passwordConfirm) === true) {
        echo 'true';
        $passwordMatch = true;
    } else {
        echo "<span class='alert-danger'>Password fields do not match!</span><br>";
    }

}


if ($_SERVER['REQUEST_METHOD'] == "POST" && $checker == true && $passwordMatch == true) {

$sql = "INSERT INTO students (first_name, last_name, username, linkedin, github, email, preferred_language, avatar, video, quote, quote_author) VALUES (:first_name, :last_name, :username, :linkedin, :github, :email, :preferred_language, :avatar, :video, :quote, :quote_author)";

    if ($pdo->prepare($sql)) {
        echo 'I work<br>';
        $stmt = $pdo->prepare($sql);

    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $username = $_POST["username"];
    $linkedin = $_POST["linkedin"];
    $github = $_POST["github"];
    $email = $_POST["email"];
    $preferredLanguage = $_POST["preferred_language"];
    $avatar = $_POST["avatar"];
    $video = $_POST["video"];
    $quote = $_POST["quote"];
    $quote_author = $_POST["quote_author"];



        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':linkedin', $linkedin);
        $stmt->bindParam(':github', $github);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':preferred_language',$preferredLanguage);
        $stmt->bindParam(':avatar', $avatar);
        $stmt->bindParam(':video', $video);
        $stmt->bindParam(':quote', $quote);
        $stmt->bindParam(':quote_author', $quote_author);

        if($stmt->execute()) {
           unset($_POST);
           header("Location: ".$_SERVER['REQUEST_URI']);
            exit;
        }

    }

}

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
<body class="container">
<div class="row">
    <form class="form-group col-12" action="register.php" method="post">
        <div class="form-group m-5">
            <label for="first_name">First Name <input class="form-control" type="text" name="first_name"></label>
            <label for="last_name">Last Name <input class="form-control" type="text" name="last_name"></label>
            <label for="username">Username <input class="form-control" type="text" name="username"></label>
        </div>
        <div class="form-group m-5">
            <label for="linkedin">LinkedIn <input class="form-control" type="text" name="linkedin"></label>
            <label for="github">Github <input class="form-control" type="text" name="github"></label>
            <label for="email">Email <input class="form-control" type="text" name="email"><?php echo "<span class='alert-danger'>";
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
            <label for="avatar">Avatar <input class="form-control" type="text" name="avatar"></label>
            <label for="video">Video <input class="form-control" type="text" name="video"></label>
        </div>
        <div class="form-group m-5">
            <label for="quote">Quote <input class="form-control" type="text" name="quote"></label>
            <label for="quote_author">Quote Author <input class="form-control" type="text" name="quote_author"></label>
        </div>
        <div class="form-group m-5">
            <label for="password">Password:
                <input class="form-control" name="password" type="text" >
            </label>
            <label for="password">Confirm Password:
                <input class="form-control" name="passwordConfirm" type="text" >
            </label>
        </div>
        <div class="form-group">
            <input class="form-control btn btn-primary" type="submit">
        </div>
    </form>
</div>

</body>
</html>

