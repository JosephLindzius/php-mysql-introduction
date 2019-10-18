<?php

require "connection.php";

whatIsHappening();

if ($_SERVER["SERVER_NAME"].'index.php') {
    $query = 'SELECT * FROM students';
    $data = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
}

if ($_SERVER['SERVER_NAME']."profile.php") {

    //todo check login status for access
    $query = "SELECT * FROM students WHERE id = $_GET[user]";
    $data = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC)[0];


}

if ($_SERVER['SERVER_NAME']."login.php") {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $username = $_POST["username"];
        var_dump($username);
        $password = $_POST["password"];
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "SELECT username FROM students WHERE username=:username";
        $usernameDB = selectWHere($pdo, $query,'username', $_POST['username']);
        $query = "SELECT password FROM students WHERE username=:username";
        $passwordDB = selectWHere($pdo, $query,'username', $_POST['password']);
        var_dump($username);
        var_dump($usernameDB);
        var_dump($hashPassword);
        var_dump($passwordDB);
    }


   // header("Location: ./index.php");
   // exit;
}

if ($_SERVER['SERVER_NAME']."register.php") {
    $emailErr = "";
    $checker = false;
    $passwordMatch = false;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $required = array("first_name", "last_name", "username", "linkedin", "github", "email", "preferred_language", "avatar", "video", "quote", "quote_author");


        foreach($required as $field) {
            if (empty($_POST[$field])) {
                $error = true;
            } else {
                $_SESSION[$field] = $_POST[$field];
            }
            if (htmlspecialchars( "$_POST[$field]")) {
                $charErr = "$_POST[$field] has used special characters";
            }
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "$_POST[email] is NOT a valid email address";
        }

        $error = false;
        if ($error) {
            echo "<span class='alert-danger'>All fields are required.</span><br>";
        } else {
            $checker = true;
        }

        if ($_POST['password'] === $_POST['passwordConfirm']) {
            $passwordMatch = true;
        } else {
            echo "<span class='alert-danger'>Password fields do not match!</span><br>";
        }

    }


    if ($_SERVER['REQUEST_METHOD'] == "POST" && $checker == true && $passwordMatch == true) {

        $sql = "INSERT INTO students (first_name, last_name, username, linkedin, github, email, preferred_language, avatar, video, quote, quote_author, password) VALUES (:first_name, :last_name, :username, :linkedin, :github, :email, :preferred_language, :avatar, :video, :quote, :quote_author, :password)";

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
            $password = $_POST["password"];
            $password = password_hash($password, PASSWORD_DEFAULT);

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
            $stmt->bindParam(':password', $password);

            if($stmt->execute()) {
                $query = "SELECT id FROM students WHERE username=:username";

                $userID = selectWHere($pdo, $query,'username', $_POST['username']);
                unset($_POST);
                $url = $_SERVER['HTTP_ORIGIN']."/profile.php?user=". $userID['id'];
                header("location: ". $url);
                exit;
            }

        }

    }
}

?>